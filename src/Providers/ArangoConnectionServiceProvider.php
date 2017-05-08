<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

use triagens\ArangoDb\Connection as ArangoConnection;
use triagens\ArangoDb\ConnectionOptions as ArangoConnectionOptions;
use triagens\ArangoDb\Exception as ArangoException;
use triagens\ArangoDb\UpdatePolicy as ArangoUpdatePolicy;

/**
 * Provides an Arango connection to Application
 * @package App\Providers
 */
class ArangoConnectionServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (!isset($app['config']['arangodb'])) {
            throw new \Exception("Connection settings for Arango database are missing", 1);
        }

        $host = sprintf('tcp://%s:%d', $app['config']['arangodb']['host'], $app['config']['arangodb']['port']);

        $connectionOptions = array(
            ArangoConnectionOptions::OPTION_DATABASE      => $app['config']['arangodb']['database'],
            ArangoConnectionOptions::OPTION_ENDPOINT      => $host,
            ArangoConnectionOptions::OPTION_AUTH_TYPE     => $app['config']['arangodb']['auth'],
            ArangoConnectionOptions::OPTION_AUTH_USER     => $app['config']['arangodb']['user'],
            ArangoConnectionOptions::OPTION_AUTH_PASSWD   => $app['config']['arangodb']['password'],
            ArangoConnectionOptions::OPTION_CONNECTION    => $app['config']['arangodb']['connection'],
            ArangoConnectionOptions::OPTION_TIMEOUT       => $app['config']['arangodb']['timeout'],
            ArangoConnectionOptions::OPTION_RECONNECT     => $app['config']['arangodb']['reconnect'],
            ArangoConnectionOptions::OPTION_CREATE        => $app['config']['arangodb']['create'],
            ArangoConnectionOptions::OPTION_UPDATE_POLICY => ArangoUpdatePolicy::LAST,
        );

        ArangoException::enableLogging();

        $app['arango'] = function () use ($connectionOptions) {
            return new ArangoConnection($connectionOptions);
        };

        unset($host);
    }
}
