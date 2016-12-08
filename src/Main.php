<?php

use Forge\Application\Menu;

class Main extends \Base {

	public function Bootstrap() {
		$this->setTheme('default');
	}

	public function acl() {
		return array(
			'loginGet' => array('anonymous'),
			'logoutGet' => array('user')
		);
	}

	public function routes() {
		return array(
			'get' => array(
				'/domain/(?<uuid>[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12})' => '/organization/domain/uuid',
			),
			'post' => array(
				'/login' => '/main/login'
			)
		);
	}

	public function menus() {
		$navbar = array('about' => new Menu('About', array(
			'documentation' => new Menu('Documentation', array(), 'https://github.com/phpforge/phpforge/wiki', '_new')
		)));

		$navbarRight = array(
			'account' => new Menu('Account', array(
				'logout' => new Menu('Logout', array(), $this->getBaseUri() . '/logout', '/main/logout'),
			), '#'),
			'login' => new Menu('<span class="glyphicon glyphicon-log-in"></span> Login', array(), $this->getBaseUri() . '/login', '/main/login')
		);

		return array(
			'navbar' => $navbar,
			'navbarRight' => $navbarRight
		);
	}

	public function mainGet() {

	}

	public function loginGet() {

	}

	public function loginPost() {
		$username = $this->getRequest()->getParam('username');
		$password = $this->getRequest()->getParam('password');
		if ($username && $password) {
			if ($username === 'admin' && $password === 'admin') {
				$this->setSession('account', $username);
				$this->username = $username;
				$this->assignRoles();
			} else {
				$this->setTemplate(dirname(__FILE__) . '/Main/Template/unauthorized.get');
			}
		} else {
			$this->setTemplate(dirname(__FILE__) . '/Main/Template/unauthorized.get');
		}
	}


	public function logoutGet() {
		$this->setRoles(array('anonymous'));
		$this->setSession('account', '');
	}

	public function unauthorizedGet() {
		
	}
}