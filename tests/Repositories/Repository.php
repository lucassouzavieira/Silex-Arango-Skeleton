<?php

namespace AppTests\Repositories;

use App\Collections\ArangoCollectionRepository;
use triagens\ArangoDb\Collection;

class Repository extends ArangoCollectionRepository
{
    public $collection = 'testCollection';

    public function validate(array $input): bool
    {
        if (!array_key_exists('test', $input)) {
            return false;
        }

        return true;
    }

    public function resetCollection()
    {
        $this->collectionHandler->drop($this->collection);
        $this->collectionHandler->create(new Collection($this->collection));
    }
}
