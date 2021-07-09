<?php

namespace framework;

use framework\helpers\ArrayHelper;

class App {
    /** @var string */
    protected $currentController;
    /** @var string  */
    protected $currentAction = 'index';
    /** @var array  */
    protected $params = [];

    public function __construct()
    {
        session_start();

        /** @var array $url */
        $url = $this->getUrl();
//        ArrayHelper::d($url);
        $controllerCandidate = '\app\controllers\\' . ucwords($url[0]) . 'Controller';
        try {
            $controllerCandidateReflection = new \ReflectionClass($controllerCandidate);

            if(!file_exists($controllerCandidateReflection->getFileName())) {
                // 404
                throw new \Exception('Page not found');
            }

            unset($url[0]);

            $controllerClassName = $controllerCandidateReflection->getName();
            $this->currentController = new $controllerClassName;
//            ArrayHelper::d($this->currentController);

            if (isset($url[1]) && !method_exists($this->currentController, $url[1])) {
                // 404
                throw new \Exception('Page not found');
            }
            if (isset($url[1])) {
                $this->currentAction = $url['1'];
            }

            unset($url[1]);

            $this->params = $url ? array_values($url) : [];
//            ArrayHelper::d($this->params);
//            ArrayHelper::d([$this->currentController, $this->currentAction]);

            call_user_func_array([$this->currentController, $this->currentAction], $this->params);

        } catch (\ReflectionException $exception) {
            // 404
//            ArrayHelper::d($exception);
        }
    }

    public function getUrl()
    {
        $url = [];
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = $_SERVER['REQUEST_URI'];
            $url = trim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
        }
        return $url;
    }
}