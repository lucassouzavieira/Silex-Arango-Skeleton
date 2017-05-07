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

### Controllers

Be sure that your Controller was registred in `src/Providers/ControllerServiceProvider.php`
Example: 

```
   $app['foo'] = function (Container $app) {
       return new FooController($app);
   };
```

### Routes

Routes are defined in `routes/routes.yml` file. Be careful with indentation.
To define a route `foo` with action in 'FooController' and method `bar`, is just define here

```
    foo/:  
        method: get  
        to: foo:bar
```

If you have any route parameters, you could pass them in route name:

```
    foo/{id}:
        method: get
        to: foo:bar
```