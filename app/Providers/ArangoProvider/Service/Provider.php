<?php

namespace App\Providers\ArangoProvider\Service;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

use triagens\ArangoDb\Connection as ArangoConnection;
use triagens\ArangoDb\ConnectionOptions as ArangoConnectionOptions;
use triagens\ArangoDb\Exception as ArangoException;
use triagens\ArangoDb\UpdatePolicy as ArangoUpdatePolicy;

/**
 * @package App\Providers\ArangoProvider\Service
 * @author Evaldo Barbosa
 */
class Provider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if ( !isset($app['config']['arangodb']) ) {
            throw new \Exception("Connection settings for arango database is missing", 1);
        }

        $db = [
            'database' => $app['config']['arangodb']['database'],
            'host' => sprintf(
                'tcp://%s:%d',
                $app['config']['arangodb']['host'],
                $app['config']['arangodb']['port']
            ),
            'user' => $app['config']['arangodb']['user'],
            'pass' => $app['config']['arangodb']['password']
        ];

        $connectionOptions = array(
            ArangoConnectionOptions::OPTION_DATABASE => $db['database'],
            ArangoConnectionOptions::OPTION_ENDPOINT => $db['host'],
            ArangoConnectionOptions::OPTION_AUTH_TYPE => 'Basic',
            ArangoConnectionOptions::OPTION_AUTH_USER => $db['user'],
            ArangoConnectionOptions::OPTION_AUTH_PASSWD => $db['pass'],
            ArangoConnectionOptions::OPTION_CONNECTION => 'Close',
            ArangoConnectionOptions::OPTION_TIMEOUT => 3,
            ArangoConnectionOptions::OPTION_RECONNECT => true,
            ArangoConnectionOptions::OPTION_CREATE => true,
            ArangoConnectionOptions::OPTION_UPDATE_POLICY => ArangoUpdatePolicy::LAST,
        );

        ArangoException::enableLogging();

        $app['arango'] = function () use ($connectionOptions){
            return new Factory(new ArangoConnection($connectionOptions));
        };

        unset($db);
    }
}