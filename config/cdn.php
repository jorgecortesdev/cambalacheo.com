<?php

return [
    'image' => [
        'host'  => env('CDN_IMAGE', ''),
        'files' => 'jpg|jpeg|png|gif|svg',
    ],
    'asset' => [
        'host'  => env('CDN_ASSET', ''),
        'files' => 'css|js|eot|woff|ttf',
    ],
];
