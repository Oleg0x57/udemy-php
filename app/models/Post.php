<?php

namespace app\models;

use framework\DataLayer;

class Post
{
    /**
     * @var DataLayer
     */
    private $db;

    public function __construct()
    {
        $this->db = new DataLayer();
    }

    public function list()
    {
        $sql = <<<SQL
SELECT 
    u.name AS user_name,
    p.*
FROM posts p
    JOIN users u ON p.user_id = u.id
ORDER BY 
    p.created_at DESC
SQL;

        return $this->db
            ->query($sql)
            ->findAll();
    }

    /**
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        return $this->db
            ->query('INSERT INTO posts (title, body, user_id) VALUES (:title , :body, :user_id)')
            ->bind(':title', $data['title'], \PDO::PARAM_STR)
            ->bind(':body', $data['body'], \PDO::PARAM_STR)
            ->bind(':user_id', $data['user_id'], \PDO::PARAM_INT)
            ->execute();
    }

    public function one($id)
    {
        $sql = <<<SQL
SELECT 
    p.*, 
    u.name AS user_name 
FROM posts p 
    JOIN users u ON p.user_id = u.id
WHERE p.id = :id
SQL;

        return $this->db
            ->query($sql)
            ->bind(':id', $id, \PDO::PARAM_INT)
            ->findOne();
    }

    public function update($data)
    {
        $sql = <<<SQL
UPDATE posts 
SET title = :title,
    body = :body
WHERE id = :id
SQL;

        return $this->db
            ->query($sql)
            ->bind(':title', $data['title'], \PDO::PARAM_STR)
            ->bind(':body', $data['body'], \PDO::PARAM_STR)
            ->bind(':id', $data['id'], \PDO::PARAM_INT)
            ->execute();
    }

    public function remove($id)
    {
        $sql = <<<SQL
DELETE FROM posts WHERE id = :id
SQL;

        return $this->db
            ->query($sql)
            ->bind(':id', $id, \PDO::PARAM_INT)
            ->execute();
    }
}