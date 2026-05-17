<?php

namespace Claudiogs16\LarQ\Providers;

use Illuminate\Support\ServiceProvider;
use Claudiogs16\LarQ\Contracts\EmbedderInterface;
use Claudiogs16\LarQ\Embedders\OpenAIEmbedder;

class LarQServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind default embedder
        $this->app->bind(EmbedderInterface::class, function () {
            return new OpenAIEmbedder();
        });

        // Merge configuration
        $this->mergeConfigFrom(__DIR__ . '/../Config/larq.php', 'larq');
    }

    public function boot(): void
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/../Config/larq.php' => config_path('larq.php'),
        ], 'larq-config');
    }
}
