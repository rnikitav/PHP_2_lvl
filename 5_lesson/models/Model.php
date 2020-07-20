<?php

namespace App\models;

use App\services\DB;

abstract class Model {

	/**
	 * Возвращает название таблицы
	 *
	 * @return string
	 */
	abstract public static function getTableName(): string;

	abstract public static function getClassName(): string;

	/**
	 * @return DB
	 */
	protected static function getDB()
	{
		return DB::getInstance();
	}

	public static function getOne( $id ) {
		$sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id';

		return static::getDB()->findObject( $sql, static::class, [ ':id' => $id ] );
	}

	public static function getAll() {
		$sql = 'SELECT * FROM ' . static::getTableName();
		return static::getDB()->findObjects( $sql, static::class );
	}


	public function getWithPage($page, $perPage){
	    $page = (int)($page -1 ) * 10;
	    $sql = sprintf('SELECT * FROM %s LIMIT %d , %d ',
                        static::getTableName(),
                        $page,
                        $perPage);
        return static::getDB()->findObjects( $sql, static::class);
    }

    public function getCountList()
    {
        $sql = 'SELECT COUNT(*) AS `count`FROM ' . static::getTableName();
        return static::getDB()->find($sql);
    }


	public static function getComments($article)
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE article = :article';

        return static::getDB()->findObjects( $sql, static::class, [ ':article' => $article ] );
    }

	public function delete($id) {
		$sql = 'DELETE FROM ' . static::getTableName().  ' WHERE ' .static::getTableName() . '.id = :id';
		return static::getDB()->execute($sql, [':id' => $id]);
	}

	protected function insert() {
		$columns = [];
		$params = [];
		foreach ( $this as $key => $value ) {
			if ( $key == 'id' || empty($value)) {
				continue;
			}
			$columns[] = $key;
			$params[ ':' . $key ] = $value;
		}
		if (static::getTableName() == 'users') {
			if ( empty( $params[':name'] ) ) {
				$params[':name'] = $params[':login'];
				$columns[] = 'name';
 			}
		}
		$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
				static::getTableName(),
				implode(' , ', $columns),
				implode(' , ',array_keys($params))
		);
		$res = static::getDB()->execute($sql, $params);
		$this->id = static::getDB()->getInsertId();
		return $res;
	}


	protected function update($id) {
		$params = [];
		$columns = [];

		foreach ( $this as $key => $value ) {
			if ( empty($value) || $key == 'id') {
				continue;
			}
			$params[':' . $key ] = $value;
			$columns[] = $key . ' = :' . $key ;
		}

		$sql = sprintf('UPDATE %1$s SET %2$s WHERE %1$s.id = %3$s',
						static::getTableName(),
						implode(' , ', $columns),
						$id);
		static::getDB()->execute($sql, $params);
	}


	public  function save() {
		if ( empty( $this->id) ) {
			return $this->insert();
		}

		return $this->update($this->id);
	}
}
