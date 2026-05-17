<?php

namespace Claudiogs16\LarQ\Embedders;

use Illuminate\Support\Facades\Http;
use Claudiogs16\LarQ\Contracts\EmbedderInterface;

class OpenRouterEmbedder implements EmbedderInterface
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl;
    protected ?string $siteUrl;
    protected ?string $siteName;

    public function __construct()
    {
        $this->apiKey = config('larq.openrouter_api_key');
        $this->model = config('larq.openrouter_model', 'openai/text-embedding-3-small');
        $this->baseUrl = config('larq.openrouter_base_url', 'https://openrouter.ai/api/v1');
        $this->siteUrl = config('larq.openrouter_site_url');
        $this->siteName = config('larq.openrouter_site_name');
    }

    public function embed(string $text): array
    {
        $request = Http::withToken($this->apiKey)
            ->acceptJson()
            ->withHeaders(array_filter([
                'HTTP-Referer' => $this->siteUrl,
                'X-Title' => $this->siteName,
            ]))
            ->baseUrl($this->baseUrl);

        $response = $request->post('/embeddings', [
            'model' => $this->model,
            'input' => $text,
        ]);

        if (! $response->successful()) {
            throw new \RuntimeException('OpenRouter embedding failed: ' . $response->body());
        }

        return $response->json('data.0.embedding') ?? [];
    }
}
