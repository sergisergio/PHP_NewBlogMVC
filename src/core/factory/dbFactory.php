<?php

namespace Philippe\Blog\Src\Core\Factory;

use Philippe\Blog\Src\Core\Database\DbConfig;

class dbFactory {
	private $config;


	public function __construct() {
		$this->config = new DbConfig;
	}	

	public function getPdo() {
		$db = new \PDO(
			'mysql:host=' . $this->config->getConfig()['host'] . 
			';dbname=' . $this->config->getConfig()['dbname'], 
			$this->config->getConfig()['user'],
			$this->config->getConfig()['password']);
			return $db;		
	}
}