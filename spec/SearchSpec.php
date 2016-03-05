<?php

namespace spec\Oaattia\Elasticsearch;

use Elasticsearch\Client;
use Oaattia\Elasticsearch\Abstracts\ElasticsearchAbstract;
use Oaattia\Elasticsearch\Exceptions\InvalidDataException;
use PhpSpec\ObjectBehavior;

class SearchSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(SearchStub::class);
        $this->beConstructedWith(Client::class);
    }

    public function it_should_handle_build_the_client()
    {
        $this->handleHosts(['192.168.1.1:9200']);
        $this->buildClient(['192.168.1.1:9200']);
    }

    public function it_should_handle_passed_hosts()
    {
        $this->shouldThrow(new InvalidDataException("Can't provide empty value."))->during('handleHosts', ['']);
        $this->shouldThrow(new InvalidDataException("Must be array only."))->during('handleHosts', ['asdasd']);
    }

}

class SearchStub extends ElasticsearchAbstract
{

    /**
     * SearchStub constructor.
     */
    public function __construct(Client $client)
    {
    }
}
