<?php

return [
    'providers' => [
        'deepseek' => [
            'api_key' => env('DEEPSEEK_API_KEY'),
            'url' => 'https://api.deepseek.com/v1',
        ],
    ],
    'default' => 'deepseek',
];
