<?php

namespace Claudiogs16\LarQ\Qdrant\Points;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class CountPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, ?array $filter = null): Response
    {
        $payload = ['exact' => true];
        if ($filter) {
            $payload['filter'] = $filter;
        }
        return $this->client->post("/collections/{$collectionName}/points/count", $payload);
    }
}
