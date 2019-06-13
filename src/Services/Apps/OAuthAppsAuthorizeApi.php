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
    public function accessToken(...$args)
    {
        $this->setHeaders(['Accept' => 'application/json']);
        $this->formatOptions('form_params');

        return $this->request('POST', 'https://github.com/login/oauth/access_token', $args);
    }

    public function user(...$args)
    {
        $this->setHeaders(['Accept' => 'application/json']);
        $this->formatOptions('query');

        $options = is_array(current($args)) ? current($args) : [$args[0] => $args[1]];

        $res = $this->request('GET', 'https://api.github.com/user', $args);
        $owner = isset($res['name']) && $res['name'] ? $res['name'] : $res['login'];

        $this->setGithubToken($owner, $options['access_token']);
        $this->setGithubUser($owner, $res);

        return $res;
    }
}
