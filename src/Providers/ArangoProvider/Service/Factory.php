<?php

namespace App\Providers\ArangoProvider\Service;

use triagens\ArangoDb\Collection as ArangoCollection;
use triagens\ArangoDb\CollectionHandler as ArangoCollectionHandler;
use triagens\ArangoDb\Connection as ArangoConnection;
use triagens\ArangoDb\DocumentHandler as ArangoDocumentHandler;
use triagens\ArangoDb\Document as ArangoDocument;
use triagens\ArangoDb\Statement as ArangoStatement;

/**
 * Class Factory
 * @package App\Providers\ArangoProvider\Service
 * @author Evaldo Barbosa
 */
class Factory
{
	private $connection;

	function __construct(ArangoConnection $connection)
	{
		$this->connection = $connection;
	}

	function newCollection($name)
	{
		return new ArangoCollection($name);
	}

	function newDocument()
	{
		return new ArangoDocument();
	}

	function handleDocument()
	{
		return new ArangoDocumentHandler($this->connection);
	}

	function handleCollection(ArangoCollection $value = null)
	{
		return new ArangoCollectionHandler($this->connection);
	}

	function newReadStatement($query, $batchSize = 1000, $canCount = true)
	{
		return new ArangoStatement(
			$this->connection,
			array(
				"query" => $query,
				"batchSize" => $batchSize,
				"count" => $canCount,
				"sanitize" => true,
			)
		);
	}

	function newChangeStatement($query, $bindVars)
	{
		return new ArangoStatement(
			$this->connection,
			array(
				"query" => $query,
				"bindVars" => $bindVars,
				"batchSize" => 1,
				"count" => true,
				"sanitize" => true,
			)
		);
	}
}