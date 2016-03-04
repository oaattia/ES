<?php

namespace spec\Oaattia\Elasticsearch;

use Elasticsearch\Client;
use Oaattia\Elasticsearch\Contracts\ElasticSearchContract;
use Oaattia\Elasticsearch\Elasticsearch;
use Oaattia\Elasticsearch\Exceptions\InvalidDataException;
use PhpSpec\ObjectBehavior;

class ElasticsearchSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Oaattia\Elasticsearch\Elasticsearch');
    }

    public function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    public function it_implement_elasticsearch_contract()
    {
        $this->shouldImplement(ElasticSearchContract::class);
    }

    public function it_should_handle_hosts()
    {
        $hosts = $this->getHosts();
        $this->handleHosts($hosts);
        $this->hosts->shouldBe($hosts);
    }

    public function it_should_throw_exception_if_hosts_empty()
    {
        $this->shouldThrow(new InvalidDataException("Can't provide empty value."))->during('handleHosts', array(''));

        $this->shouldThrow(new InvalidDataException("Must be array only"))->during('handleHosts', array('search'));

    }

    public function it_should_build_client()
    {
        $this->buildClient($this->getHosts())->shouldReturnAnInstanceOf('Elasticsearch\Client');
    }

    /**
     * @return array
     */
    private function getHosts()
    {
        // https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/_configuration.html
        $hosts = [
            '192.168.1.1:9200', // IP + Port
            '192.168.1.2', // Just IP
            'mydomain.server.com:9201', // Domain + Port
            'mydomain2.server.com', // Just Domain
            'https://localhost', // SSL to localhost
            'https://192.168.1.3:9200', // SSL to IP + Port
        ];
        return $hosts;

        // we want to
        //        $client = new Elasticsearch();
        //        $client->buildClient()
    }

}
