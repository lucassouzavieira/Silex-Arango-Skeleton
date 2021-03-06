[![Codacy Badge](https://api.codacy.com/project/badge/Grade/396ed54daa224865b504a83cbd42979a)](https://www.codacy.com/app/lucassouzavieira/Silex-Arango-Skeleton?utm_source=github.com&utm_medium=referral&utm_content=lucassouzavieira/Silex-Arango-Skeleton&utm_campaign=badger)
[![Code Triagers Badge](https://www.codetriage.com/lucassouzavieira/silex-arango-skeleton/badges/users.svg)](https://www.codetriage.com/lucassouzavieira/silex-arango-skeleton)
[![Build Status](https://travis-ci.org/lucassouzavieira/Silex-Arango-Skeleton.svg?branch=master)](https://travis-ci.org/lucassouzavieira/Silex-Arango-Skeleton)
[![Coverage Status](https://coveralls.io/repos/github/lucassouzavieira/Silex-Arango-Skeleton/badge.svg?branch=master)](https://coveralls.io/github/lucassouzavieira/Silex-Arango-Skeleton?branch=master)

# Silex Arango Skeleton

Basic skeleton for applications using ArangoDB


### Dependencies
* ArangoDB Driver for PHP  
* Respect Validator
* Twig
* Symfony YAML


### Installation
 Use composer:  

 `composer create-project lvieira/silex-arango-skeleton MyAwesomeProject`  

* Set `public` folder as web root of your application  
* Add your custom configurations to `app.yml`
* Let's code !

### Custom configurations  

On the `app.yml` file you can add your own configurations.  
To disable API prefixes set the configuration `enabled` to `false` under `api` block.

### Controllers

Make sure your Controller is registered on `src/Providers/ControllerServiceProvider.php`  
Example:

```
   $app['foo'] = function (Container $app) {
       return new FooController($app);
   };
```

### Routes

Routes are defined on `routes/routes.php` file. 

### Using Docker  
Put your custom configurations in `docker-compose.yml` file. Otherwise, you can simple run:  
`docker-compose up`
