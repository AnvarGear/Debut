<?php

namespace core;

use core\Routing\Router;

class Kernel
{
    /**
     * Constructor del Kernel. 
     * Se incluirán los archivos globales de la aplicación
     */
    public function __construct() 
    {
        require_once ROOT . 'libs/helpers.php';
        require_once APP . 'routes.php';
    }
    
    /**
     * Arranca la aplicación con la configuración establecida
     * 
     * @return void
     */
    public function run()
    {
        // --------------------------------------------------------------
        // Registro de errores
        // --------------------------------------------------------------
        Handler::register();
        
        // --------------------------------------------------------------
        // Inicio de sesiones
        // --------------------------------------------------------------
        if (! session_id()) {
            @session_start();
        }
        
        // --------------------------------------------------------------
        // Inicio del enrutamiento
        // --------------------------------------------------------------
        $router = new Router();
        $router->run();
    }
}

