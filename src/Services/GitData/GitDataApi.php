<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Services\GitData;

use Jiannei\EasyGithub\Api;

class GitDataApi extends Api
{
    public function references($owner, $repo, $ref = '')
    {
        return new ReferencesApi($owner, $repo, $ref);
    }
}
