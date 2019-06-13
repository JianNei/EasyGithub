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

use Jiannei\EasyGithub\Services\Apps\OAuthAppsAuthorizeApi;
use Jiannei\EasyGithub\Services\GitData\GitDataApi;
use Jiannei\EasyGithub\Services\Repositories\RepositoriesApi;
use Jiannei\EasyGithub\Services\UserApi;

class Client
{
//    protected $repository;
//    protected $user;

    public function repository($owner, $repo = '')
    {
        return new RepositoriesApi($owner, $repo);
    }

    public function user($username)
    {
        return new UserApi($username);
    }

    public function oauthApp()
    {
        return new OAuthAppsAuthorizeApi();
    }

    public function gitData()
    {
        return new GitDataApi();
    }
}
