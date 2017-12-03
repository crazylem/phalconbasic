<?php

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\MvC\View;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\Application;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/'
    ]
);

$loader->register();

$di = new FactoryDefault();

$di->set(
    'view',
    function() {
        $view = new View();
        $view->setViewsDir( APP_PATH . '/views/');
        return $view;
    }
);

$di->set(
    'url',
    function() {
        $url = new UrlProvider();
        $url->setBaseUri('/basic/');
        return $url;
    }
);

$application = new Application($di);

try {
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ' . $e->getMessage();
}

//somechanges






