<?php

namespace Claudiogs16\LarQ\Qdrant\Points;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class RecommendPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, array $positive, array $negative = [], int $top = 10, ?array $filter = null): Response
    {
        $payload = ['positive' => $positive, 'top' => $top];
        if (!empty($negative)) {
            $payload['negative'] = $negative;
        }
        if ($filter) {
            $payload['filter'] = $filter;
        }
        return $this->client->post("/collections/{$collectionName}/points/recommend", $payload);
    }
}
