<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Api;

use Jiannei\EasyGithub\Traits\OauthApp\Authenticatable;

class User extends Api
{
    use Authenticatable;

    public function repos($accessToken, $params = [])
    {
        $this->authorize($accessToken);

        return $this->httpClient->get('https://api.github.com/user/repos', $params);
    }
}
