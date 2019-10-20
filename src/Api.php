<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub;

use Jiannei\Http\Client;

class Api
{
    protected function buildHttpClient($options = [])
    {
        $defaultConfig = [
            'Accept'     => 'application/vnd.github.v3+json',
            'User-Agent' => 'EasyGithub',
            'Time-Zone'  => 'Asia/Shanghai',
        ];

        return Client::create(array_merge($defaultConfig, $options));
    }
}
