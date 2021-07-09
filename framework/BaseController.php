<?php

namespace framework;

class BaseController
{
    public function load($model) {
        $model = (ucwords($model));

        $modelCandidateReflection = new \ReflectionClass('\app\models\\' . $model);
        $modelCandidateFilePath = $modelCandidateReflection->getFileName();

        if(!file_exists($modelCandidateFilePath)) {
            throw new \Exception('Model ' . $model . ' not found in ' . $modelCandidateFilePath);
        }

        $model = $modelCandidateReflection->getName();

        return new $model();
    }

    public function view($view, $data = [])
    {
        $viewCandidateFilePath = '../app/views/' . $view . '.php';
        if (!file_exists($viewCandidateFilePath)) {
            throw new \Exception('Model ' .$view . ' not found in ' . $viewCandidateFilePath);
        }

        require_once $viewCandidateFilePath;
    }
}