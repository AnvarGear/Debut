<?php

namespace core\Routing;

class Redirector 
{
    
    /**
     * Permite redireccionar a la ruta indicada usando
     * el propio constructor de la clase
     * 
     * @param string $path
     * @return \core\Routing\Redirector
     */
    public function __construct($path = null, $statusCode = 303)
    {
        if ($path) {
            header('Location: ' . $path, true, $statusCode);
        }
        return $this;
    }
    
    public function route($path, $statusCode = 303)
    {
        header('Location: ' . $path, true, $statusCode);
        return $this;
    }
    
    public function back($statusCode = 302)
    {
        $path = $_SERVER['HTTP_REFERER'];
        return $this->route($path, $statusCode);
    }
    
    public function with($type, $message)
    {
        flash_messages($type, $message);
    }
}