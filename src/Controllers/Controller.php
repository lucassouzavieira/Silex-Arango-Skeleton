<?php

namespace App\Controllers;

use Silex\Application;

/**
 * Class Controller
 * @package App\Controllers
 */
abstract class Controller
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
