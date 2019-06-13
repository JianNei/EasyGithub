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
    'OauthApp' => [
        'client_id' => env('GITHUB_CLIENT_ID', 'your-app-id'),
        'client_secret' => env('GITHUB_CLIENT_SECRET', 'your-app-secret'),
        'callback_url' => env('GITHUB_CALLBACK_URL', 'http://localhost/api/oauth/callback'),
    ],

    'Docs' => [
        'Apps' => [
            'OauthApp' => [
                'accessToken' => 'https://github.com/login/oauth/access_token',
                'user' => 'https://api.github.com/user',
            ],
        ],
        'ApiV3' => [
            'GitData' => [
                'References' => 'https://api.github.com/repos/repos/:owner/:repo/git/refs/:ref',
            ],
            'Repositories' => [
                'create' => 'https://api.github.com/user',
                'delete' => 'https://api.github.com/repos/:owner/:repo',

                'Contents' => [
                    'readme' => 'https://api.github.com/repos/:owner/:repo/readme',
                    'get' => 'https://api.github.com/repos/:owner/:repo/contents/:path',
                    'create' => 'https://api.github.com/repos/:owner/:repo/contents/:path',
                    'delete' => 'https://api.github.com/repos/:owner/:repo/contents/:path',
                ],
                'Pages' => [
                    'enablePagesSite' => 'https://api.github.com/repos/:owner/:repo/pages',
                    'disablePagesSite' => 'https://api.github.com/repos/:owner/:repo/pages',
                ],
            ],
        ],
    ],
];
