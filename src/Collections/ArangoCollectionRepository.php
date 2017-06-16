<?php

namespace App\Collections;

use Silex\Application;
use App\Collections\Validation\Validation;

use triagens\ArangoDb\CollectionHandler;
use triagens\ArangoDb\Document;
use triagens\ArangoDb\DocumentHandler;
use triagens\ArangoDb\Collection;
use triagens\ArangoDb\ServerException;

/**
 * Class ArangoCollectionRepository
 * @package App\Collections
 */
abstract class ArangoCollectionRepository implements Validation
{
    /**
     * @var string Collection name
     */
    public $collection;

    /**
     * @var $connection ArangoDb connection
     */
    protected $connection;

    /**
     * @var $collectionHandler CollectionHandler for repository
     */
    protected $collectionHandler;

    /**
     * @var $documentHandler DocumentHandler for repository
     */
    protected $documentHandler;


    public function __construct(Application $app)
    {
        $this->connection = $app['arango'];

        $this->collectionHandler = new CollectionHandler($this->connection);
        $this->documentHandler = new DocumentHandler($this->connection);

        // Create collection if not exists
        if (!$this->collectionHandler->has($this->collection)) {
            $this->collectionHandler->create(new Collection($this->collection));
        }
    }

    /**
     * Returns all documents from Collection
     * @return \triagens\ArangoDb\Cursor
     */
    public function all()
    {
        $collection = $this->collectionHandler->get($this->collection);
        return $this->collectionHandler->all($collection->getId());
    }

    /**
     * Returns a given document from Collection
     * @param $id
     * @return null|Document
     * @throws ServerException
     */
    public function find($id)
    {
        try {
            if ($this->documentHandler->has($this->collection, $id)) {
                return $this->documentHandler->get($this->collection, $id);
            };
        } catch (ServerException $exception) {
            if ($exception->getServerCode() != 1202) {
                throw $exception;
            }
        }

        return null;
    }

    /**
     * Create and save a new document
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        $document = new Document();

        foreach ($data as $key => $value) {
            $document->set($key, $value);
        }

        return $this->documentHandler->save($this->collection, $document);
    }

    /**
     * Updates a given document from Collection
     * @param $id
     * @param array $data
     * @return bool|null
     */
    public function update($id, array $data)
    {
        $document = $this->find($id);

        if ($document) {
            foreach ($data as $key => $value) {
                $document->set($key, $value);
            }

            return $this->documentHandler->update($document);
        }

        return null;
    }

    /**
     * Delete a given document from collection
     * @param $id
     * @return bool|null
     */
    public function delete($id)
    {
        $document = $this->find($id);

        if ($document) {
            return $this->documentHandler->remove($document);
        }

        return null;
    }

    /**
     * Collection name
     * @return string
     */
    public function getCollection(): string
    {
        return $this->collection;
    }
}
