<?php


namespace App\repositories;


use App\entities\Entity;
use App\services\DB;

abstract class Repository
{
    /**
     * Возвращает название таблицы
     *
     * @return string
     */
    abstract public function getTableName(): string;

    abstract public function getEntityName(): string;


    /**
     * @return DB
     */
    protected static function getDB()
    {
        return DB::getInstance();
    }

    public function getOne($id)
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = :id';

        return static::getDB()->findObject($sql, $this->getEntityName(), [':id' => $id]);
    }
    public function getOneByLogin($login)
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE login = :login';

        return static::getDB()->findObject($sql, $this->getEntityName(), [':login' => $login]);
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ' . $this->getTableName();
        return static::getDB()->findObjects($sql, $this->getEntityName());
    }


    public function getWithPage($page, $perPage)
    {
        $page = (int)($page - 1) * 10;
        $sql = sprintf('SELECT * FROM %s LIMIT %d , %d ',
            $this->getTableName(),
            $page,
            $perPage);
        return static::getDB()->findObjects($sql, $this->getEntityName());
    }

    public function getCountList()
    {
        $sql = 'SELECT COUNT(*) AS `count`FROM ' . $this->getTableName();
        return static::getDB()->find($sql);
    }


    public function getComments($article)
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE article = :article';

        return static::getDB()->findObjects($sql, $this->getEntityName(), [':article' => $article]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE ' . $this->getTableName() . '.id = :id';
        return static::getDB()->execute($sql, [':id' => $id]);
    }

    protected function insert(Entity $entity)
    {
        $columns = [];
        $params = [];
        foreach ($entity as $key => $value) {
            if ($key == 'id' || empty($value)) {
                continue;
            }
            $columns[] = $key;
            $params[':' . $key] = $value;
        }
        if ($this->getTableName() == 'users') {
            if (empty($params[':name'])) {
                $params[':name'] = $params[':login'];
                $columns[] = 'name';
            }
        }
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
            $this->getTableName(),
            implode(' , ', $columns),
            implode(' , ', array_keys($params))
        );
        $res = static::getDB()->execute($sql, $params);
        if ($res->rowCount() > 0){
            $entity->id = static::getDB()->getInsertId();
            return $entity;
        }

        return null;
    }


    protected function update(Entity $entity, $id)
    {
        $params = [];
        $columns = [];

        foreach ($entity as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $params[':' . $key] = $value;
            $columns[] = $key . ' = :' . $key;
        }

        $sql = sprintf('UPDATE %1$s SET %2$s WHERE %1$s.id = %3$s',
            $this->getTableName(),
            implode(' , ', $columns),
            $id);
        static::getDB()->execute($sql, $params);

    }


    public function save(Entity $entity)
    {
        if (empty($entity->id)) {
            return $this->insert($entity);
        }
        return $this->update($entity, $entity->id);
    }

}
