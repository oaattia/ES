<?php

namespace Oaattia\Elasticsearch\Contracts;

interface ElasticSearchContract
{
    public function buildClient($hosts);
    public function handleHosts($hosts);
}
