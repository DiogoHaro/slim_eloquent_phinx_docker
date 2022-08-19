<?php

namespace app\controllers;

use app\models\User;
use app\classes\Flash;
use app\controllers\Base;

class Home extends Base
{

    public function index($request, $response)
    {
        
        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Home',
            'users' => User::all(),
            'message' => Flash::get('message')
        ]);
    }
}