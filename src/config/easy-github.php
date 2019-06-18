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
                'accessToken' => ['url' => 'https://github.com/login/oauth/access_token'],
                'user' => ['url' => 'https://api.github.com/user', 'scope' => ''],
            ],
        ],
        'ApiV3' => [
            'GitData' => [
                'References' => [
                    'get' => ['url' => 'https://api.github.com/repos/repos/:owner/:repo/git/refs/:ref', 'scope' => ''],
                    'create' => ['url' => 'https://api.github.com/repos/:owner/:repo/git/refs', 'scope' => 'public_repo'],
                ],
            ],
            'Repositories' => [
                'create' => ['url' => 'https://api.github.com/user', 'scope' => 'public_repo'],
                'delete' => ['url' => 'https://api.github.com/repos/:owner/:repo', 'scope' => 'public_repo'],

                'Contents' => [
                    'readme' => 'https://api.github.com/repos/:owner/:repo/readme',
                    'get' => 'https://api.github.com/repos/:owner/:repo/contents/:path',
                    'create' => ['url' => 'https://api.github.com/repos/:owner/:repo/contents/:path', 'scope' => 'public_repo'],
                    'update' => ['url' => 'https://api.github.com/repos/:owner/:repo/contents/:path', 'scope' => 'public_repo'],
                    'delete' => ['url' => 'https://api.github.com/repos/:owner/:repo/contents/:path', 'scope' => 'public_repo'],
                ],
                'Pages' => [
                    'enablePagesSite' => ['url' => 'https://api.github.com/repos/:owner/:repo/pages', 'scope' => 'public_repo'],
                    'disablePagesSite' => ['url' => 'https://api.github.com/repos/:owner/:repo/pages', 'scope' => 'public_repo'],
                ],
            ],
            'user' => [
                'repos' => ['url'=>'https://api.github.com/user/repos','scope' => 'public_repo']
            ]
        ],
    ],
];
