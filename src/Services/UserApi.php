<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Services;

use Jiannei\EasyGithub\Api;

class UserApi extends Api
{
    private $username;

    /**
     * UserApi constructor.
     *
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    public function repos(...$args)
    {
        $this->setHeaders(['Accept' => 'application/json']);
        $this->formatOptions('query');

        return $this->request('GET', "https://api.github.com/users/{$this->username}/repos", $args);
    }
}
