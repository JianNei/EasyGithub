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

    /**
     * List user repositories
     * https://developer.github.com/v3/repos/#list-user-repositories.
     *
     * @param mixed ...$args
     *
     * @return RepositoriesApi
     *
     * @throws \Jiannei\EasyGithub\Exceptions\HttpException
     */
    public function all(...$args)
    {
        $this->setHeaders(['Accept' => 'application/json']);
        $this->formatOptions('query');

        return $this->request('GET', "https://api.github.com/users/{$this->owner}/repos", $args);
    }

    public function create($args)
    {
        $this->authorize('Docs.ApiV3.Repositories.create', $this->owner);

        $this->setHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->githubToken['access_token'],
            ]
        );
        $this->formatOptions('body', json_encode($args));

        return $this->request('POST', 'https://api.github.com/user/repos');
    }

    public function delete()
    {
        $this->setHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->githubToken['access_token'],
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
