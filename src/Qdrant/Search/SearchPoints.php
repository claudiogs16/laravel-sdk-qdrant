<?php

namespace Claudiogs16\LarQ\Qdrant\Search;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class SearchPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, array $vector, int $top = 10, ?array $filter = null): Response
    {
        $payload = [
            'vector' => $vector,
            'top' => $top,
        ];

        if ($filter) {
            $payload['filter'] = $filter;
        }

        return $this->client->post("/collections/{$collectionName}/points/search", $payload);
    }
}
