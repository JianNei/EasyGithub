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

class Repositories extends Api
{
    public function store($params)
    {
        return $this->httpClient->post('https://api.github.com/user/repos', $params);
    }

    public function destroy($owner, $repo)
    {
        return $this->httpClient->delete('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo));
    }

    public function show($owner, $repo)
    {
        return $this->httpClient->get('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo));
    }

    public function createWithTemplate($templateOwner, $templateRepo, $params)
    {
        return $this->httpClient
            ->withHeaders([
                'Accept' => 'application/vnd.github.baptiste-preview+json'
            ])
            ->post('https://api.github.com/repos/'.rawurlencode($templateOwner).'/'.rawurlencode($templateRepo).'/generate', $params);
    }
}
