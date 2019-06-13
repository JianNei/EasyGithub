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

use Jiannei\EasyGithub\utils\HttpClient;
use Jiannei\EasyGithub\utils\OauthTrait;

class Api
{
    use HttpClient;
    use OauthTrait;
}
