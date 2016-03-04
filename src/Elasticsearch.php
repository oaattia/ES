<?php

namespace Oaattia\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Oaattia\Elasticsearch\Contracts\ElasticSearchContract;
use Oaattia\Elasticsearch\Exceptions\InvalidDataException;

class Elasticsearch implements ElasticSearchContract
{

    /**
     * @var Client
     */
    protected $client;

    /**
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
        $returnedHosts = $this->handleHosts($hosts);
        return ClientBuilder::create()->setHosts($returnedHosts)->build();
    }

    /**
     * @param mixed $hosts
     * @return mixed
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

        return $hosts;
    }

}
