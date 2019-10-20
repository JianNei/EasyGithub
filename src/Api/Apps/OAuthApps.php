<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Api\Apps;

use Jiannei\EasyGithub\Api;

class OAuthApps extends Api
{
    private $baseUri = 'https://github.com';

    public function getAccessToken(array $params)
    {
        return $this->buildHttpClient([
            'base_uri' => $this->baseUri,
        ])->withHeaders(['Accept' => 'application/json',])
            ->post('/login/oauth/access_token', $params);
    }

    public function authorizedUser()
    {

    }
}
