<?php

namespace app\Controllers;

use core\Auth;
use core\Controller;
use core\View;

class AuthController extends Controller
{
    /**
     * Accede a la vista de login
     *
     * @return void
     */
    public function getLogin()
    {
        if (!Auth::check()) {
            View::template('auth/login.html');
        } else {
            return redirect('/users');
        }
    }

    /**
     * Comprueba si el usuario existe en la base de datos
     * e inicia sesión con los datos del usuario
     *
     * @return void
     */
    public function postLogin()
    {
        if (Auth::login($_POST["email"], $_POST["pass"])) {
            return redirect('/users');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Cierra la sesión del usuario
     *
     * @return void
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
