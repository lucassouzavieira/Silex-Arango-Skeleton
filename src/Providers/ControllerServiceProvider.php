<?php

namespace App\Providers;

use App\Controllers\HomeController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ControllerServiceProvider implements ServiceProviderInterface
{
    /**
     * Register your controllers here
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['home'] = function (Container $app) {
            return new HomeController($app);
        };
    }
}
