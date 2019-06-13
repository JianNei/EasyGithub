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

class PagesApi extends Api
{
    private $owner;

    private $repo;

    /**
     * PagesApi constructor.
     *
     * @param $owner
     * @param $repo
     */
    public function __construct($owner, $repo)
    {
        $this->owner = $owner;
        $this->repo = $repo;
        $this->getGithubToken($this->owner);
    }

    public function enable($args)
    {
        // https://developer.github.com/v3/repos/pages/#enable-a-pages-site
        $this->setHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.github.switcheroo-preview+json',
                'Authorization' => 'Bearer '.$this->githubToken['access_token'],
            ]
        );
        $this->formatOptions('body', json_encode($args, 320));

        return $this->request('POST', "https://api.github.com/repos/{$this->owner}/{$this->repo}/pages");
    }

    public function disable()
    {
        // https://developer.github.com/v3/repos/pages/#disable-a-pages-site
        $this->setHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.github.switcheroo-preview+json',
                'Authorization' => 'Bearer '.$this->githubToken['access_token'],
            ]
        );

        return $this->request('DELETE', "https://api.github.com/repos/{$this->owner}/{$this->repo}/pages");
    }
}
