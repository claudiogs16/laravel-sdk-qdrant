<?php

namespace Claudiogs16\LarQ\Qdrant\Points;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class UpsertPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, array $points): Response
    {
        return $this->client->put("/collections/{$collectionName}/points", ['points' => $points]);
    }
}
