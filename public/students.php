<?php

use LuisLuciano\Components\Container;

require(__DIR__ . '/../bootstrap/start.php');

function studentsController()
{
    $access = Container::getInstance()->getAccess();

    if (!$access->check('student')) {
        abort404();
    }

    view('students', compact('access'));
}

studentsController();
