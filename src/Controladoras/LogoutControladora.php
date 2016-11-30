<?php

namespace Controladoras;

class LogoutControladora
{
    public function __construct()
    {
    }

    public function terminar()
    {
        // Elimio las variables de sesión y sus valores.
        $_SESSION = array();
        // Eliminamos la cookie del usuario que identifcaba a esa sesión, verifcando "si existía".
        if (ini_get("session.use_cookies") == true) {
            $parametros = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 99999,
                $parametros["path"],
                $parametros["domain"],
                $parametros["secure"],
                $parametros["httponly"]
            );
        }
        // Elimino el archivo de sesión del servidor.
        session_destroy();

        require("../Vistas/login.php");
    }
}
