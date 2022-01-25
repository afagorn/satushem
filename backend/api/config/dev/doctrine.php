<?php

return [
    'config' => [
        'doctrine' => [
            'dev_mode' => true,
            'proxy_dir' => __DIR__ . '/../../var/cache/' . PHP_SAPI . 'doctrine/proxy',
            'cache_dir' => null,
        ]
    ]
];
