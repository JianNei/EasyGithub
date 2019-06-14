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

class ContentsApi extends Api
{
    private $owner;

    private $repo;

    private $path;

    private $customMediaType = 'object';

    /**
     * ContentsApi constructor.
     *
     * @param  string  $owner
     * @param  string  $repo
     * @param  string  $path
     */
    public function __construct($owner, $repo, $path)
    {
        $this->owner = $owner;
        $this->repo = $repo;
        $this->path = $path;

        $this->getGithubToken($this->owner);
    }

    private function setCustomMedia($type = '')
    {
        if (in_array($type, ['object', 'raw', 'html'])) {
            $this->customMediaType = "application/vnd.github.VERSION.{$type}";
        }

        $this->customMediaType = "application/vnd.github.VERSION.{$this->customMediaType}";
    }

    public function get(...$args)
    {
        $this->setCustomMedia();
        $this->setHeaders(['Accept' => $this->customMediaType]);
        $this->formatOptions('query');

        return $this->request('GET', "https://api.github.com/repos/{$this->owner}/{$this->repo}/contents/{$this->path}", $args);
    }

    public function readme(...$args)
    {
        $this->setCustomMedia();
        $this->setHeaders(['Accept' => $this->customMediaType]);
        $this->formatOptions('query');

        return $this->request('GET', "https://api.github.com/repos/{$this->owner}/{$this->repo}/readme", $args);
    }

    public function create(...$args)
    {
        return $this->update(current($args));
    }

    public function update($args)
    {
        $this->authorize("Docs.ApiV3.Repositories.Contents.update", $this->owner);

        $this->setHeaders([
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '.$this->githubToken['access_token'],
            ]
        );
        $this->formatOptions('body', json_encode($args));

        // todo 创建/更新文件以后缓存文件的 sha 值
        return $this->request('PUT', "https://api.github.com/repos/{$this->owner}/{$this->repo}/contents/{$this->path}");
    }

    public function delete($args)
    {
        $this->authorize("Docs.ApiV3.Repositories.Contents.delete", $this->owner);

        $this->setHeaders([
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '.$this->githubToken['access_token'],
            ]
        );
        $this->formatOptions('body', json_encode($args));

        return $this->request('DELETE', "https://api.github.com/repos/{$this->owner}/{$this->repo}/contents/{$this->path}");
    }
}
