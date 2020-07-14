<?php

namespace App\models;

use App\services\DB;

abstract class Model {
	/**
	 * @var DB
	 */
	protected $db;

	/**
	 * Возвращает название таблицы
	 *
	 * @return string
	 */
	abstract public function getTableName(): string;

	abstract public function getClassName(): string;

	/**
	 * Model constructor.
	 */
	public function __construct() {
		$this->db = DB::getInstance();
	}

	public function getOne( $id ) {
		$sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = :id';

		return $this->db->find( $sql, $this->getClassName(), [ ':id' => $id ] );
	}

	public function getAll() {
		$sql = 'SELECT * FROM ' . $this->getTableName();

		return $this->db->findAll( $sql );
	}

	public function delete($id) {
		$sql = 'DELETE FROM ' . $this->getTableName().  ' WHERE ' .$this->getTableName() . '.id = :id';
		return $this->db->execute($sql, [':id' => $id]);
	}

	protected function insert() {
		$params = [];
		foreach ( $this as $key => $value ) {
			if ( $key == 'db' ) {
				continue;
			}
			$params[ $key ] = $value;
		}
		$tableName = $this->getTableName();
		if ( $tableName == 'goods' ) {
			$sql = "INSERT INTO goods
		    (name, description, img, price, comments, article)
		    VALUES 
		    (:name, :description, :img, :price, :comments, :article)";

			return $this->db->execute( $sql, [
				':name'        => $params['name'],
				':description' => $params['description'],
				':img'         => $params['img'],
				':price'       => $params['price'],
				':comments'    => $params['comments'],
				':article'     => $params['article']
			] );
		}

		$sql = "INSERT INTO users (login, name, password) VALUES (:login, :name, :password)";
		if ( empty( $params['name'] ) ) {
			$params['name'] = $params['login'];
		}

		return $this->db->execute( $sql, [
			':login'    => $params['login'],
			':name'     => $params['name'],
			':password' => $params['password'],
		] );

	}


	protected function update($id) {
		$params = [];
		foreach ( $this as $key => $value ) {
			if ( $key == 'db' || empty($value) || $key == 'id') {
				continue;
			}
			$params[ $key ] = $value;
		}
		$tableName = $this->getTableName();
		foreach ($params as $key => $value){
			$sql = "UPDATE {$tableName} SET $key = :value WHERE {$tableName}.id = :id";
			$this->db->execute( $sql, [
				':value'    => $value,
				':id'     => $id,
			] );
		}
		return;

	}


	public function save() {
		if ( empty( $this->id ) ) {
			return $this->insert();
		}

		return $this->update($this->id);
	}
}
