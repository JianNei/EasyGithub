<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    'oauthApp' => [
        'client_id'     => env('GITHUB_CLIENT_ID', 'your-app-id'),
        'client_secret' => env('GITHUB_CLIENT_SECRET', 'your-app-secret'),
        'callback_url'  => env('GITHUB_CALLBACK_URL', 'http://localhost/api/oauth/callback'),
    ],
];
