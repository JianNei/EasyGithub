<?php

namespace Jiannei\EasyGithub\utils;

use Cache;
use Carbon\Carbon;

trait OauthTrait
{
    protected $githubToken;

    protected $githubUser;

    protected function getGithubToken($owner, $key = '')
    {
        $this->githubToken = Cache::get("github.{$owner}.token");

        return $this->githubToken && isset($this->githubToken[$key]) ? $this->githubToken[$key] : null;
    }

    protected function getGithubUser($owner, $key = '')
    {
        $this->githubUser = Cache::get("github.{$owner}.user");

        return $this->githubUser && isset($this->githubUser[$key]) ? $this->githubUser[$key] : null;
    }

    protected function setGithubToken($owner, $token)
    {
        return Cache::put("github.{$owner}.token", $token, Carbon::now()->addMonth(1));
    }

    protected function setGithubUser($owner, $user)
    {
        return Cache::put("github.{$owner}.user", $user, Carbon::now()->addMonth(1));
    }
}
