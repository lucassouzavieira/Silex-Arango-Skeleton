<?php

require_once 'vendor/autoload.php';
require_once 'vendor/triagens/arangodb/autoload.php';


use Silex\Application;
use App\Providers\RouterServiceProvider;
use App\Providers\ControllerServiceProvider;
use App\Providers\ArangoProvider\Service\Provider as ArangoProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\Yaml\Yaml;


$app = new Application();


$routes = Yaml::parse(file_get_contents('routes/routes.yml'));
$config = Yaml::parse(file_get_contents('app.yml'));

$app['debug'] = $config['application']['debug'];
$app['config'] = $config;

/**
 * Services
 */


/**
 * Providers
 */
$app->register(new ServiceControllerServiceProvider());
$app->register(new ControllerServiceProvider());
$app->register(new RouterServiceProvider($routes));
$app->register(new ArangoProvider());

return $app;