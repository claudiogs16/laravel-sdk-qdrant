<?php

namespace Claudiogs16\LarQ\Qdrant\Index;

use Claudiogs16\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class CreateIndex
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, string $fieldName, string $fieldType = 'keyword'): Response
    {
        return $this->client->put("/collections/{$collectionName}/indexes/{$fieldName}", [
            'field_type' => $fieldType
        ]);
    }
}
