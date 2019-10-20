<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Api\Repositories;

use Jiannei\EasyGithub\Api;

class Repositories extends Api
{
    private $baseUri = 'https://api.github.com';

    public function listYourRepositories(array $params)
    {
        return $this->buildHttpClient([
            'base_uri' => $this->baseUri,
        ])->get("/user/repos", $params);
    }

    public function listUserRepositories($username, $params = [])
    {
        return $this->buildHttpClient([
            'base_uri' => $this->baseUri,
        ])->get("/users/".rawurlencode($username)."/repos", $params);
    }
}
