<?php

use LuisLuciano\Components\AccessHandler;

require __DIR__ . '/../vendor/autoload.php';

//class_alias(AccessHandler::class, 'Access');

// Show errors through the Whoops package
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
