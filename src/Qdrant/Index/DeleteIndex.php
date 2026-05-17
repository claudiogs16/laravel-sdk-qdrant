<?php

namespace Claudiogs16\LarQ\Qdrant\Index;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class DeleteIndex
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, string $fieldName): Response
    {
        return $this->client->delete("/collections/{$collectionName}/indexes/{$fieldName}");
    }
}
