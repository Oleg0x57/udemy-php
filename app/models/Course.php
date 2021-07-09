<?php

namespace app\models;

use framework\DataLayer;

class Course
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
}