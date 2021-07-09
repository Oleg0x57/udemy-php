<?php

namespace app\controllers;

use framework\BaseController;

class SiteController extends BaseController
{
    public function index()
    {
        $this->view('site/index');
    }

    public function about()
    {
        $this->view('site/about', ['title' => 'About page', 'h1' => 'Welcome to courses app!']);
    }
}