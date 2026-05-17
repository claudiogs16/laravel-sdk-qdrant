<?php

namespace Claudiogs16\LarQ\Qdrant\Collections;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class ListCollections
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(): Response
    {
        return $this->client->get('/collections');
    }
}
