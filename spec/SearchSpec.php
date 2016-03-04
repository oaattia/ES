<?php

namespace spec\Oaattia\Elasticsearch;

use Elasticsearch\Client;
use Oaattia\Elasticsearch\Exceptions\InvalidDataException;
use PhpSpec\ObjectBehavior;

class SearchSpec extends ObjectBehavior
{

    protected $query;

    public function __construct()
    {
        $this->query = ['search'];
    }

    public function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Oaattia\Elasticsearch\Search');
    }

    public function it_can_handle_search(Client $client)
    {
        $client->search($this->query)->shouldBeCalled();
        $this->searchByQuery($this->query);
    }

    public function it_can_handle_search_by_term()
    {
        $this->shouldThrow(new InvalidDataException("Must be array only."))->during('searchByterm', array('search'));

        $this->searchByTerm($this->query);
    }

}
