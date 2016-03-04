<?php

namespace Oaattia\Elasticsearch;

use Elasticsearch\Client;
use Oaattia\Elasticsearch\Exceptions\InvalidDataException;

class Search
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Search constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $query
     */
    public function searchByQuery($query)
    {
        $this->client->search($query);
    }

    /**
     * @param $term
     * @throws InvalidDataException
     */
    public function searchByTerm($term)
    {
        if (!is_array($term)) {
            throw new InvalidDataException('Must be array only.');
        }

        $results = $this->searchByQuery($term);
        return $results;
    }
}
