<?php

use LuisLuciano\Components\Container;

require(__DIR__ . '/../bootstrap/start.php');

function homeController()
{
    $access = Container::getInstance()->getAccess();
    view('index', compact('access'));
}

homeController();
