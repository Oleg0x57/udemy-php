<?php

namespace framework\helpers;

class SessionHelper
{
    public static function flashMessage($name = '', $message = '', $class = 'alert alert-success')
    {
        if (!empty($name)) {
            if (!empty($message) && empty($_SESSION[$name])) {
                if(!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }

                if(!empty($_SESSION[$name . '_class'])) {
                    unset($_SESSION[$name . '_class']);
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif (empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                $message = $_SESSION[$name];

                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);

                return '<div class="'. $class .'">' . $message . '</div>';
            }
        }
    }

    public static function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
    }

    public static function destroyUserSession()
    {
        if(!empty($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
        if(!empty($_SESSION['user_email'])) {
            unset($_SESSION['user_email']);
        }
        if(!empty($_SESSION['user_name'])) {
            unset($_SESSION['user_name']);
        }
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}