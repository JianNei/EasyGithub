<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Api\Repositories;

use Jiannei\EasyGithub\Api\Api;

class Contents extends Api
{
    public function readme($owner, $repo, $params)
    {
        return $this->httpClient->get('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/readme',
            $params);
    }

    public function show($owner, $repo, $path, $params)
    {
        return $this->httpClient->get('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/contents/'.rawurlencode($path),
            $params);
    }

    public function store($owner, $repo, $path, $params)
    {
        return $this->httpClient->put('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/contents/'.rawurlencode($path),
            $params);
    }

    public function update($owner, $repo, $path, $params)
    {
        $content = $this->show($owner, $repo, $path, $params)->json();
        $params['sha'] = $content['sha'];
        return $this->httpClient->put('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/contents/'.rawurlencode($path),
            $params);
    }

    public function destroy($owner, $repo, $path, $params)
    {
        $content = $this->show($owner, $repo, $path, $params)->json();
        $params['sha'] = $content['sha'];
        return $this->httpClient->delete('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/contents/'.rawurlencode($path),
            $params);
    }
}
