<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return $this->app['twig']->render('welcome.twig', [
            'title' => 'Welcome page',
            'appname' => $this->app['config']['application']['name'],
            'welcome' => 'Welcome to Silex Arango Skeleton'
        ]);
    }
}
