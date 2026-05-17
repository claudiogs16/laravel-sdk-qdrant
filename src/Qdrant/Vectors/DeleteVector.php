<?php

namespace Claudiogs16\LarQ\Qdrant\Vectors;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class DeleteVector
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, array $vectorNames, array $pointIds): Response
    {
        return $this->client->post("/collections/{$collectionName}/points/vectors/delete", [
            'vectors' => $vectorNames,
            'points' => $pointIds,
        ]);
    }
}
