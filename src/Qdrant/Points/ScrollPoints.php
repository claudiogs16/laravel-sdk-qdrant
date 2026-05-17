<?php

namespace Claudiogs16\LarQ\Qdrant\Points;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class ScrollPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, int $limit = 10, ?array $filter = null, ?array $offset = null): Response
    {
        $payload = ['limit' => $limit];
        if ($filter) {
            $payload['filter'] = $filter;
        }
        if ($offset) {
            $payload['offset'] = $offset;
        }
        return $this->client->post("/collections/{$collectionName}/points/scroll", $payload);
    }
}
