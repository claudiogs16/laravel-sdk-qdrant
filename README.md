# Laravel SDK for Qdrant

[![Latest Version on Packagist](https://img.shields.io/packagist/v/claudiogs16/laravel-sdk-qdrant.svg?style=flat-square)](https://packagist.org/packages/claudiogs16/laravel-sdk-qdrant)
[![License](https://img.shields.io/packagist/l/claudiogs16/laravel-sdk-qdrant.svg?style=flat-square)](https://packagist.org/packages/claudiogs16/laravel-sdk-qdrant)
[![PHP Version](https://img.shields.io/packagist/php-v/claudiogs16/laravel-sdk-qdrant.svg?style=flat-square)](https://packagist.org/packages/claudiogs16/laravel-sdk-qdrant)
[![Laravel](https://img.shields.io/badge/Laravel-11.x%20%7C%2012.x%20%7C%2013.x-red?style=flat-square)](https://laravel.com)

Laravel SDK for [Qdrant](https://qdrant.tech) vector database. Supports collection management, point operations (upsert, search, scroll, recommend, count), payload manipulation, index management, and vector embedding via OpenAI and Gemini.

> Forked from [wontonee/laravel-qdrant-sdk](https://github.com/wontonee/laravel-qdrant-sdk) with compatibility for Laravel 11, 12, and 13, re-namespaced to `Claudiogs16\LarQ`.

---

## Installation

```bash
composer require claudiogs16/laravel-sdk-qdrant
```

Laravel auto-discovers the service provider. Publish the config:

```bash
php artisan vendor:publish --tag=larq-config
```

## Configuration

Add to your `.env`:

```env
LARQ_HOST=http://localhost:6333
LARQ_API_KEY=

OPENAI_API_KEY=sk-...
OPENAI_MODEL=text-embedding-3-small

GEMINI_API_KEY=
GEMINI_MODEL=models/embedding-001
```

The published config is at `config/larq.php`.

## Usage

### Client

```php
use Claudiogs16\LarQ\Qdrant\Client;

$client = new Client();

// Raw HTTP calls
$response = $client->get('/collections');
$response = $client->put('/collections/my-collection', [...]);
$response = $client->post('/collections/my-collection/points/search', [...]);
```

### Collections

```php
use Claudiogs16\LarQ\Qdrant\Collections\CreateCollection;
use Claudiogs16\LarQ\Qdrant\Collections\ListCollections;
use Claudiogs16\LarQ\Qdrant\Collections\GetCollection;
use Claudiogs16\LarQ\Qdrant\Collections\UpdateCollection;
use Claudiogs16\LarQ\Qdrant\Collections\DeleteCollection;

CreateCollection::make()->handle('my-collection', [
    'vectors' => ['size' => 1536, 'distance' => 'Cosine'],
]);

$collections = ListCollections::make()->handle();
$info = GetCollection::make()->handle('my-collection');
```

### Points

```php
use Claudiogs16\LarQ\Qdrant\Points\UpsertPoints;
use Claudiogs16\LarQ\Qdrant\Points\SearchPoints;
use Claudiogs16\LarQ\Qdrant\Points\ScrollPoints;
use Claudiogs16\LarQ\Qdrant\Points\CountPoints;
use Claudiogs16\LarQ\Qdrant\Points\DeletePoints;
use Claudiogs16\LarQ\Qdrant\Points\RecommendPoints;

// Upsert
UpsertPoints::make()->handle('my-collection', [
    [
        'id' => 1,
        'vector' => [0.1, 0.2, ...],
        'payload' => ['title' => 'Document 1'],
    ],
]);

// Search
$results = SearchPoints::make()->handle('my-collection', [
    'vector' => [0.1, 0.2, ...],
    'limit' => 10,
]);

// Count
$count = CountPoints::make()->handle('my-collection');
```

### Payload

```php
use Claudiogs16\LarQ\Qdrant\Payload\SetPayload;
use Claudiogs16\LarQ\Qdrant\Payload\DeletePayload;
use Claudiogs16\LarQ\Qdrant\Payload\ClearPayload;
```

### Indexes

```php
use Claudiogs16\LarQ\Qdrant\Index\CreateIndex;
use Claudiogs16\LarQ\Qdrant\Index\DeleteIndex;
```

### Vectors

```php
use Claudiogs16\LarQ\Qdrant\Vectors\DeleteVector;
```

### Embedders

```php
use Claudiogs16\LarQ\Embedders\OpenAIEmbedder;
use Claudiogs16\LarQ\Embedders\GeminiEmbedder;

$embedder = new OpenAIEmbedder();
$vector = $embedder->embed('Some text to embed');
```

### Eloquent Trait

```php
use Claudiogs16\LarQ\Traits\HasVectors;

class Document extends Model
{
    use HasVectors;

    // Optional overrides:
    protected function getVectorText(): string { ... }
    protected function getVectorPayload(): array { ... }
    protected function getVectorId(): string|int { ... }
    protected function getVectorCollection(): string { ... }
    protected function getEmbedder(): EmbedderInterface { ... }
}

$document->upsertToQdrant();
```

## Testing

```bash
composer test
```

## Requirements

- PHP 8.2+
- Laravel 11.x | 12.x | 13.x

## License

MIT
