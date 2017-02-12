<?php

require_once 'vendor/autoload.php';


use Silex\Application;
use App\Providers\RouterServiceProvider;
use App\Providers\ControllerServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\Yaml\Yaml;


$app = new Application();


$routes = Yaml::parse(file_get_contents('routes/routes.yml'));
$config = Yaml::parse(file_get_contents('app.yml'));

$app['debug'] = $config['application']['debug'];

/**
 * Services
 */

/**
 * Providers
 */
$app->register(new ServiceControllerServiceProvider());
$app->register(new ControllerServiceProvider());
$app->register(new RouterServiceProvider($routes));

return $app;