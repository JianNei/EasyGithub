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

    /**
     * List your repositories
     * https://developer.github.com/v3/repos/#list-your-repositories
     *
     * @param  mixed  ...$args
     * @return UserApi
     * @throws \Jiannei\EasyGithub\Exceptions\HttpException
     */
    public function repos(...$args)
    {
        $this->authorize('Docs.ApiV3.user.repos', $this->username);
        $this->setHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->githubToken['access_token'],
            ]
        );
        $this->formatOptions('query');


        return $this->request('GET', "https://api.github.com/user/repos", $args);
    }
}
