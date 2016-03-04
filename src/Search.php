<?php

namespace Oaattia\Elasticsearch;

use Elasticsearch\Client;

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

    public function searchByTerm($term)
    {

    }
}
