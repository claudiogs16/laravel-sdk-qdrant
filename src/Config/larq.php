<?php

return [
    'host' => env('LARQ_HOST', 'http://localhost:6333'),
    'api_key' => env('LARQ_API_KEY'),

    // OpenAI
    'openai_api_key' => env('OPENAI_API_KEY'),
    'openai_model' => env('OPENAI_MODEL', 'text-embedding-ada-002'),

    // Gemini
    'gemini_api_key' => env('GEMINI_API_KEY'),
    'gemini_model' => env('GEMINI_MODEL', 'models/embedding-001'),

    // OpenRouter (OpenAI-compatible API)
    'openrouter_api_key' => env('OPENROUTER_API_KEY'),
    'openrouter_model' => env('OPENROUTER_MODEL', 'openai/text-embedding-3-small'),
    'openrouter_base_url' => env('OPENROUTER_BASE_URL', 'https://openrouter.ai/api/v1'),
    'openrouter_site_url' => env('OPENROUTER_SITE_URL'),
    'openrouter_site_name' => env('OPENROUTER_SITE_NAME'),
];
