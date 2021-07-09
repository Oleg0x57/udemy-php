<?php

namespace app\models;

use framework\DataLayer;

class User
{
    /**
     * @var DataLayer
     */
    private $db;

    public function __construct()
    {
        $this->db = new DataLayer();
    }

    public function getPosts()
    {
        return $this->db
            ->query('SELECT * FROM courses')
            ->findAll();
    }

    public function findByEmail($email)
    {
        $userCandidate = $this->db
            ->query('SELECT * FROM users WHERE email = :email')
            ->bind(':email', $email)
            ->findOne();

        return $userCandidate;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        $this->findByEmail($email);
        return $this->db->rowCount() > 0;
    }

    public function register($data)
    {
        return $this->db
            ->query('INSERT INTO users (name, email, password, created_at) VALUES (:name , :email, :password, CURRENT_TIMESTAMP)')
            ->bind(':name', $data['name'], \PDO::PARAM_STR)
            ->bind(':email', $data['email'], \PDO::PARAM_STR)
            ->bind(':password', $data['password'], \PDO::PARAM_STR)
            ->execute();
    }

    public function login($email, $password)
    {
        $userCandidate = $this->findByEmail($email);

        if (password_verify($password, $userCandidate->password)) {
            return $userCandidate;
        }

        return false;
    }
}