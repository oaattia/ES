<?php

namespace Oaattia\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Oaattia\Elasticsearch\Contracts\ElasticSearchContract;
use Oaattia\Elasticsearch\Exceptions\InvalidDataException;

class Elasticsearch implements ElasticSearchContract
{

    /**
     * @var
     */
    public $hosts = [];

    /**
     * @var Client
     */
    protected $client;

    /**
     * Elasticsearch constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function buildClient($hosts)
    {
        $this->handleHosts($hosts);
        return ClientBuilder::create()->setHosts($this->hosts)->build();
    }

    /**
     * @param mixed $hosts
     * @throws InvalidDataException
     */
    public function handleHosts($hosts)
    {
        if (empty($hosts)) {
            throw new InvalidDataException("Can't provide empty value.");
        }

        if (!is_array($hosts)) {
            throw new InvalidDataException("Must be array only");
        }

        $this->hosts = $hosts;
    }

}
