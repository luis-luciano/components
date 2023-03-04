<?php

use LuisLuciano\Components\Container;

require(__DIR__ . '/../bootstrap/start.php');

function teachersController()
{
    $access = Container::getInstance()->getAccess();

    if (!$access->check('teacher')) {
        abort404();
    }

    view('teachers', compact('access'));
}

teachersController();
