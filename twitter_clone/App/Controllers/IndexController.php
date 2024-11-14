<?php

namespace App\Controllers;

//os recursos do miniframework

use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse() {
		$this->view->usuario = [
			'nome' => '',
			'email' => '',
			'senha' => ''
		];
		$this->view->erroCadastro = false;
		$this->render('inscreverse');
	}

	public function registrar(){
		// get data of form
		$usuario = Container::getModel("Usuario");

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		// success
		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0 ){
			$usuario->salvar();
			$this->render('cadastro');

		// error
		}else{
			$this->view->usuario = [
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha']
			];
			$this->view->erroCadastro = true;
			$this->render('inscreverse');
		}

	}

}


?>