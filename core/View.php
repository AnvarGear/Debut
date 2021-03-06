<?php

namespace core;

use Exception;
use core\Config;
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;
use Twig_Extensions_Extension_Text;

class View
{
    
    public function __construct() {}

    /**
     * Agrega el archivo de la vista
     *
     * @param string $view
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../app/Views/$view"; // Directorio de las vistas

        if (is_readable($file)) {
            require $file;
        } else {
            throw new Exception('La vista $file no ha sido encontrada');
        }
    }

    /**
     * Agrega el archivo de la vista usando el motor de plantillas Twig
     *
     * @param string $template La plantilla
     * @param array $args Array asociativo con los datos que se le pasen a la vista
     *
     * @return void
     */
    public static function make($template, array $args = [])
    {
        $loader = new Twig_Loader_Filesystem(APP . 'Views');
        
        // Archivo de configuración de la aplicación
        $app_config = Config::get('app');
        
        // Configuramos el entorno de twig a partir de la configuración general
        // Establecemos si se usará o no cache para las vistas
        $cache = (!$app_config['debug']) ? ROOT . 'storage/cache' : false;
        
        // Es necesario dar permisos para el modo producción (true debug)
        $twig = new Twig_Environment($loader, array(
            'debug' => $app_config['debug'],
            'cache' => $cache,
        ));
        
        // ----------------------- EXTENSIONES ---------------------------------------
        // Añade extensiones útiles para el motor de plantillas => http://twig.sensiolabs.org/doc/extensions/index.html#extensions-install
        $twig->addExtension(new Twig_Extensions_Extension_Text());
        // Añade extensiones para depurar
        $twig->addExtension(new Twig_Extension_Debug());
        // ---------------------------------------------------------------------------
        
        // Añadimos los datos de la sesión
        // esto nos permite pasar datos temporales a la vista
        $twig->addGlobal('session', $_SESSION);
        
        // Eliminamos los mensajes temporales
        clear_flash_messages();
        
        echo $twig->render($template, $args);
    }
}
