<?php

return [
    'image' => [
        'host'  => env('CDN_IMAGE', 'stg.cdn.cambalacheo.com'),
        'files' => 'jpg|jpeg|png|gif|svg',
    ],
    'asset' => [
        'host'  => env('CDN_ASSET', 'stg.cdn.cambalacheo.com'),
        'files' => 'css|js|eot|woff|ttf',
    ],
];
