<?php

use Forge\Application\Menu;
use Forge\Application\Module;

class Main extends Module {

	public function Bootstrap() {
		$this->setTheme('default');
	}

	public function routes() {
		return array(
			'get' => array(
				'/domain/(?<uuid>[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12})' => $this->getBaseUri() . '/organization/domain/uuid',
			),
		);
	}

	public function menus() {
		$menu = new Menu('Help', array(
			'module' => new Menu('Module', array(
				'about' => new Menu('About', array(), $this->getBaseUri() . '/module#default'),
				'create' => new Menu('Create', array(), $this->getBaseUri() . '/module#create'),
			), $this->getBaseUri() . '/module', '/main/module'),
			'routing' => new Menu('Routing', array(
				'default' => new Menu('Default Routing', array(), $this->getBaseUri() . '/routing#default'),
				'custom' => new Menu('Custom Routing', array(), $this->getBaseUri() . '/routing#custom'),
				'menu' => new Menu('Menu Routing', array(), $this->getBaseUri() .'/routing#menu'),
			), $this->getBaseUri() . '/routing', '/main/module/routing'),
			'events' => new Menu('Events', array(
				'global' => new Menu('Global Events', array(), $this->getBaseUri() . '/event#global'),
				'hook' => new Menu('Hook Functions', array(), $this->getBaseUri() . '/event#hook/')
			), $this->getBaseUri() . '/event', '/main/module/event'),
			'theme' => new Menu('Theme', array(
				'set' => new Menu('Set', array(), '/theme/set', '/theme#set'),
				'design' => new Menu('Design', array(), '/theme/design', '/theme#design')
			), $this->getBaseUri() . '/theme', '/main/module/theme'),
			'todo' => new Menu('To Do List', array(
				'acl' => new Menu('ACL', array(), $this->getBaseUri() . '/todo#acl'),
			), $this->getBaseUri() . '/todo', '/main/todo')
		));
		return array('top' => array('help' => $menu));
	}

	public function mainGet() {

	}
}