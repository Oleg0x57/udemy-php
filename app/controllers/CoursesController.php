<?php

namespace app\controllers;

use app\models\Course;
use framework\BaseController;
use framework\helpers\ArrayHelper;

class CoursesController extends BaseController
{
    /** @var Course */
    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = $this->load('Course');
    }
    public function index()
    {
        $this->view('courses/index',
            [
                'courses' => $this->courseModel->getPosts()
            ]
        );
    }
}