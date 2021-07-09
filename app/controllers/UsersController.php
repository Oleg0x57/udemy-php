<?php

namespace app\controllers;

use app\models\User;
use framework\BaseController;
use framework\helpers\SessionHelper;
use framework\helpers\UrlHelper;

class UsersController extends BaseController
{
    /** @var User */
    protected $userModel;

    public function __construct()
    {
        $this->userModel = $this->load('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($formData['name']),
                'email' => trim($formData['email']),
                'password' => trim($formData['password']),
                'confirm_password' => trim($formData['confirm_password']),
                'err_name' => '',
                'err_email' => '',
                'err_password' => '',
                'err_confirm_password' => '',
            ];

            if (empty($data['email'])) {
                $data['err_email'] = 'Please enter an email';
            } else {
                if ($this->userModel->emailExists($data['email'])) {
                    $data['err_email'] = 'Email already exists';
                }
            }
            if (empty($data['name'])) {
                $data['err_name'] = 'Please enter an name';
            }
            if (empty($data['password'])) {
                $data['err_password'] = 'Please enter an password';
            } elseif (strlen($data['password']) < 6) {
                $data['err_password'] = 'Password must be at least 6 characters';
            }
            if (empty($data['confirm_password'])) {
                $data['err_confirm_password'] = 'Please enter an confirm_password';
            } elseif ($data['confirm_password'] !== $data['password']) {
                $data['err_confirm_password'] = 'Password and password confirm must be equal';
            }

            if (
                empty($data['err_email']) &&
                empty($data['err_name']) &&
                empty($data['err_password']) &&
                empty($data['err_confirm_password'])
            ) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    SessionHelper::flashMessage('registered_success', 'You are succesfully registered');
                    UrlHelper::redirect('users/login');
                } else {

                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'err_name' => '',
                'email' => '',
                'err_email' => '',
                'password' => '',
                'err_password' => '',
                'confirm_password' => '',
                'err_confirm_password' => '',
            ];
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($formData['email']),
                'password' => trim($formData['password']),
                'err_email' => '',
                'err_password' => '',
            ];

            if (empty($data['email'])) {
                $data['err_email'] = 'Please enter an email';
            }

            if (empty($data['password'])) {
                $data['err_password'] = 'Please enter an password';
            }

            $userCandidate = $this->userModel->findByEmail($data['email']);
            if (!$userCandidate) {
                $data['err_email'] = 'There\'s no user with such email found';
            }

            $loggedUser = $this->userModel->login($data['email'], $data['password']);

            if(!$loggedUser) {
                $data['err_password'] = 'Password incorrect';
            }

            if (
                !empty($data['err_email']) ||
                !empty($data['err_password'])
            ) {
                $this->view('users/login', $data);
            }

            SessionHelper::createUserSession($loggedUser);
            UrlHelper::redirect('posts/index');
        } else {
            $data = [
                'email' => '',
                'err_email' => '',
                'password' => '',
                'err_password' => '',
            ];
            $this->view('users/login', $data);
        }
    }

    public function logout()
    {
        SessionHelper::destroyUserSession();

        UrlHelper::redirect('users/login');
    }
}