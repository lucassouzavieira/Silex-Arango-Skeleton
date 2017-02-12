<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use App\Helpers\RouteConfiguration;


class RouterServiceProvider implements ServiceProviderInterface
{
    private $routes;


    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $routes = $this->routes;

        foreach ($routes as $routeName => $params){
            $method = (string) $params['method'];
            $app->$method($routeName, $params['to']);
        }
    }
}
