<?php

namespace App\services;

use App\engine\Container;
use App\repositories\BasketRepository;
use App\repositories\CommentsRepository;
use App\repositories\GoodRepository;
use App\repositories\RegistrationRepository;
use App\repositories\Repository;
use App\repositories\UserRepository;
use App\traits\TSingleton;
use PDO;

/**
 * Class DB
 * @package App\services
 * @property GoodRepository $goodRepository
 * @property BasketRepository $basketRepository
 * @property CommentsRepository $commentsRepository
 * @property RegistrationRepository $registrationRepository
 * @property Repository $repository
 * @property UserRepository $userRepository
 *
 */
class DB {

	protected $connect;
	protected $container;

	protected $config = [];

    /**
     * DB constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }


//    public function setContainer(Container $container)
//    {
//        $this->container = $container;
//    }

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
		$PDOStatement->execute($params);
//		var_dump($PDOStatement->errorInfo());
//		var_dump($PDOStatement->errorCode());
//		$PDOStatement->debugDumpParams();
		return $PDOStatement;
	}

	public function findObject( $sql, $class, $params = [] ) {
	$PDOStatement = $this->query($sql, $params);
	$PDOStatement->setFetchMode(PDO::FETCH_CLASS, $class);
	return $PDOStatement->fetch();
	}

	public function findObjects( $sql, $class, $params = [] ) {
		$PDOStatement = $this->query($sql, $params);
		$PDOStatement->setFetchMode(PDO::FETCH_CLASS, $class);
		return $PDOStatement->fetchAll();
	}


    public function find($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
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

	public function getInsertId() {
		return $this->getConnect()->lastInsertId();
	}

//	 public function __get($name)
//    {
//        return $this->container->name;
//    }
}
