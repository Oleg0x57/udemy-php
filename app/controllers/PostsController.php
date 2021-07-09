<?php

namespace app\controllers;

use app\models\Post;
use framework\BaseController;
use framework\helpers\SessionHelper;
use framework\helpers\UrlHelper;
use http\Url;

class PostsController extends BaseController
{
    /** @var Post */
    protected $postModel;

    public function __construct()
    {
        if (!SessionHelper::isLoggedIn()) {
            UrlHelper::redirect('users/login');
        } else {
            $this->postModel = $this->load('Post');
        }
    }

    public function index()
    {
        $posts = $this->postModel->list();
        $data = ['posts' => $posts];

        $this->view('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($formData['title']),
                'body' => trim($formData['body']),
                'user_id' => $_SESSION['user_id'],
                'err_title' => '',
                'err_body' => '',
            ];

            if (empty($data['title'])) {
                $data['err_title'] = 'Please enter an title';
            } elseif (strlen($data['title']) < 6) {
                $data['err_title'] = 'title must be at least 6 characters';
            }

            if (empty($data['body'])) {
                $data['err_body'] = 'Please enter an body';
            }

            if ($this->postModel->create($data)) {
                SessionHelper::flashMessage('post_message', 'You are succesfully added the post');
                UrlHelper::redirect('posts');
            } else {
                throw new \Exception('Something went wrong');
            }

            if (
                !empty($data['err_title']) ||
                !empty($data['err_body'])
            ) {
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'err_title' => '',
                'err_body' => '',
            ];
        }

        $this->view('posts/add', $data);
    }

    public function show($id)
    {
        $post = $this->postModel->one($id);
        $data = ['post' => $post];

        $this->view('posts/show', $data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($formData['title']),
                'body' => trim($formData['body']),
                'user_id' => $_SESSION['user_id'],
                'id' => $id,
                'err_title' => '',
                'err_body' => '',
            ];

            if (empty($data['title'])) {
                $data['err_title'] = 'Please enter an title';
            } elseif (strlen($data['title']) < 6) {
                $data['err_title'] = 'title must be at least 6 characters';
            }

            if (empty($data['body'])) {
                $data['err_body'] = 'Please enter an body';
            }

            if ($this->postModel->update($data)) {
                SessionHelper::flashMessage('post_message', 'You are succesfully edited the post');
                UrlHelper::redirect('posts');
            } else {
                throw new \Exception('Something went wrong');
            }

            if (
                !empty($data['err_title']) ||
                !empty($data['err_body'])
            ) {
                $this->view('posts/edit', $data);
            }
        } else {
            $post = $this->postModel->one($id);
            if ($post->user_id !== $_SESSION['user_id']) {
                SessionHelper::flashMessage('post_message', 'You cannot edit the post');
                UrlHelper::redirect('posts');
            }

            $data = [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'err_title' => '',
                'err_body' => '',
            ];
        }

        $this->view('posts/edit', $data);
    }

    public function delete($id)
    {
        $post = $this->postModel->one($id);
        if ($post->user_id !== $_SESSION['user_id']) {
            SessionHelper::flashMessage('post_message', 'You cannot edit the post');
            UrlHelper::redirect('posts');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            UrlHelper::redirect('posts');
        }

        if ($this->postModel->remove($id)) {
            SessionHelper::flashMessage('post_message', 'You are succesfully deleted the post');
            UrlHelper::redirect('posts');
        } else {
            throw new \Exception('Something went wrong');
        }
    }
}