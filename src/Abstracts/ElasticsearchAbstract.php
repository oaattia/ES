<?php

namespace Oaattia\Elasticsearch\Abstracts;

use Elasticsearch\ClientBuilder;
use Oaattia\Elasticsearch\Exceptions\InvalidDataException;

abstract class ElasticsearchAbstract
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
     * @param $hosts
     * @return Client
     * @throws InvalidDataException
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
            throw new InvalidDataException("Must be array only.");
        }

        return $hosts;
    }

}
