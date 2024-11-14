<?php

namespace App\Controllers;

//os recursos do miniframework

use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {
    public function autenticar(){
        $usuario = Container::getModel('Usuario');

        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', md5($_POST['senha']));

        $usuario->autenticar();

        $retorno = $usuario->autenticar();

        if (!empty($usuario['id']) && !empty($usuario['nome'])) {
            session_start();

            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');

            header('Location: /timeline');

        }else{
           header('Location: /?login=erro');
        }
    }

    public function sair(){
        session_start();
        session_destroy();
        header('Location: /');
    }
}


?>