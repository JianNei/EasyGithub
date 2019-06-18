<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Services\Apps;

use Jiannei\EasyGithub\Api;

class OAuthAppsAuthorizeApi extends Api
{
    // https://developer.github.com/apps/building-oauth-apps/authorizing-oauth-apps/
    public function accessToken($args)
    {
        $this->setHeaders(['Accept' => 'application/json']);
        $this->formatOptions('form_params',$args);

        return $this->request('POST', 'https://github.com/login/oauth/access_token');
    }

    public function user(...$args)
    {
        $this->setHeaders(['Accept' => 'application/json']);
        $this->formatOptions('query');

        return $this->request('GET', 'https://api.github.com/user', $args);
    }

    public function oauth(...$args)
    {
        $githubToken = $this->accessToken($args)->toArray();
        $githubUser = $this->user('access_token', $githubToken['access_token'])->toArray();

        $username = isset($githubUser['name']) && $githubUser['name'] ? $githubUser['name'] : $githubUser['login'];

        $this->setGithubUser($username, $githubToken);
        $this->setGithubToken($username, $githubToken);

        return $this;
    }
}
