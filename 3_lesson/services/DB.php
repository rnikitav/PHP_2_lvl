<?php

namespace App\services;

use App\models\Good;
use App\models\User;
use App\traits\TSingleton;
use PDO;

class DB {
	use TSingleton;

	protected $connect;

	protected $config = [
		'driver'   => 'mysql',
		'host'     => 'localhost',
		'dbname'   => 'lesson6',
		'charset'  => 'UTF8',
		'user'     => 'root',
		'password' => 'root0987'
	];

	public function getConnect() {
		if ( empty( $this->connect ) ) {
			$this->connect = new PDO(
				$this->getPrepareDsnString(),
				$this->config['user'],
				$this->config['password']
			);
			$this->connect->setAttribute(
				PDO::ATTR_DEFAULT_FETCH_MODE,
				PDO::FETCH_ASSOC
			);
//	        $this->connect->setAttribute(
//	        	PDO::ATTR_DEFAULT_FETCH_MODE,
//                  PDO::FETCH_CLASS
//            );

		}

		return $this->connect;
	}

	private function getPrepareDsnString() {
		return sprintf(
			"%s:host=%s;dbname=%s;charset=%s",
			$this->config['driver'],
			$this->config['host'],
			$this->config['dbname'],
			$this->config['charset']
		);
	}

	/**
	 * @param $sql
	 * @param array $params
	 *
	 * @return bool|\PDOStatement
	 */
	protected function query( $sql, $params = [] ) {
		$PDOStatement = $this->getConnect()->prepare( $sql );
		$PDOStatement->execute( $params );
		var_dump($PDOStatement->errorInfo());
		var_dump($PDOStatement->errorCode());
		return $PDOStatement;
	}


	public function find( $sql, $class,  $params = []) {
		$res = $this->query( $sql, $params );
		if ( $res->rowCount() > 0 ) {
//		$res->setFetchMode( PDO::FETCH_CLASS, $class);
//		return $res->fetch();
		return $res->fetchObject($class, [$this]);
//		return $res->fetchObject();// выведет все свойства без объекта на основе которого создан
		}

		return 'Товар не найден';
	}

	public function findAll( $sql, $params = [] ) {
//		return $this->query( $sql, $params )->fetchAll(PDO::FETCH_CLASS, Good::class);
		return $this->query( $sql, $params )->fetchAll();
	}

	/**
	 * @param $sql
	 * @param array $params
	 *
	 * @return bool|\PDOStatement
	 */
	public function execute( $sql, $params = [] ) {
		return $this->query( $sql, $params );
	}
}
