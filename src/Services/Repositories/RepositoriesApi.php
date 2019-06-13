<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Services\Repositories;

use Jiannei\EasyGithub\Api;

class RepositoriesApi extends Api
{
    public function contents($owner, $repo, $path = '')
    {
        return new ContentsApi($owner, $repo, $path);
    }

    public function pages($owner, $repo)
    {
        return new PagesApi($owner, $repo);
    }
}
