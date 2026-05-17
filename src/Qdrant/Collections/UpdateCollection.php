<?php

namespace Claudiogs16\LarQ\Qdrant\Collections;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class UpdateCollection
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, array $settings): Response
    {
        return $this->client->post("/collections/{$collectionName}/update", $settings);
    }
}
