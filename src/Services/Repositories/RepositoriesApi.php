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
    private $owner;

    private $repo;

    /**
     * RepositoriesApi constructor.
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

    public function create($args)
    {
        $this->setHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->githubToken,
            ]
        );
        $this->formatOptions('body', json_encode($args));

        return $this->request('POST', 'https://api.github.com/user/repos');
    }

    public function delete()
    {
        $this->setHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->githubToken,
            ]
        );

        return $this->request('DELETE', "https://api.github.com/repos/{$this->owner}/{$this->repo}");
    }

    public function contents($owner, $repo, $path = '')
    {
        return new ContentsApi($owner, $repo, $path);
    }

    public function pages($owner, $repo)
    {
        return new PagesApi($owner, $repo);
    }
}
