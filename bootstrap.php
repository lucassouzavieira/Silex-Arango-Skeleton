<?php

require_once 'vendor/autoload.php';
// ArangoDB PHP Driver still uses PSR-0 autoloader, so we require this PSR-0 autoloader here
require_once 'vendor/triagens/arangodb/autoload.php';

use Silex\Application;
use Symfony\Component\Yaml\Yaml;
use Silex\Provider\TwigServiceProvider;
use App\Providers\ControllerServiceProvider;
use App\Providers\ArangoConnectionServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

$app = new Application();

$routes = Yaml::parse(file_get_contents('routes/routes.yml'));
$config = Yaml::parse(file_get_contents('app.yml'));

$app['config'] = $config;
$app['debug'] = $app['config']['application']['debug'];

/**
 * Services
 */


/**
 * Providers
 */
$app->register(new ServiceControllerServiceProvider());
$app->register(new ControllerServiceProvider());
$app->register(new ArangoConnectionServiceProvider());
$app->register(new TwigServiceProvider(), [
    'twig.path' => 'views'
]);

/**
 * Applicaiton routes
 */
require_once 'routes/routes.php';

return $app;
