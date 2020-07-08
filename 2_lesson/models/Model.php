<?php


namespace App\models;


use App\services\IDB;

abstract class Model
{
	protected $db;

	/**
	 * Возвращает название таблицы
	 * @return string
	 */
	abstract  public function getNameTable(): string;    //метод не определен в классе модели, но обязательно в дочернем

	/**
	 * Model constructor.
	 *
	 * @param $db
	 */
	public function __construct(IDB $db ) {
		$this->db = $db;
	}

	public function getOne($id)
	{
		$sql = 'SELECT * FROM `' . $this->getNameTable() .'` WHERE id= ' . $id;
		return $this->db->find($sql);
	}

	public function getAll()
	{
		$sql = 'SELECT * FROM `' . $this->getNameTable() . '`' ;
		return $this->db->findAll($sql);
	}


}
