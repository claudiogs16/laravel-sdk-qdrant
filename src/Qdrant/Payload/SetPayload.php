<?php

namespace Claudiogs16\LarQ\Qdrant\Payload;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class SetPayload
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, array $payload, array $ids): Response
    {
        return $this->client->post("/collections/{$collectionName}/points/payload", [
            'payload' => $payload,
            'points' => $ids,
        ]);
    }
}
