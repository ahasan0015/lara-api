<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:5173'],  // or specific: ['https://yourdomain.com']

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],  // or ['Content-Type', 'Authorization']

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
