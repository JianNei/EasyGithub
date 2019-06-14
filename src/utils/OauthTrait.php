<?php

namespace Jiannei\EasyGithub\utils;

use Cache;
use Carbon\Carbon;
use Jiannei\EasyGithub\Exceptions\Exception;

trait OauthTrait
{
    protected $githubToken;

    protected $githubUser;

    protected $githubApi;

    private function requiredAuthorization($api)
    {
        $this->githubApi = config("easy-github.{$api}");
        if (isset($this->githubApi['scope']) && $this->githubApi['scope']) {
            return true;// 需要授权
        }

        return false;// 不需要授权
    }

    private function verifyAuthorization($username)
    {
        $this->getGithubToken($username);// 校验 token 是否存在，是否过期
        if (! $this->githubToken || ! isset($this->githubToken['scope']) || ! $this->githubToken['scope']) {
            throw new Exception('Unauthorized', 401);
        }

        // https://developer.github.com/apps/building-oauth-apps/understanding-scopes-for-oauth-apps/
        // X-OAuth-Scopes lists the scopes your token has authorized.
        // X-Accepted-OAuth-Scopes lists the scopes that the action checks for.
        // scope 是否满足条件 todo
        $wait_verify_scope = explode(',', $this->githubApi['scope']);
        $auth_scope_list = explode(',', $this->githubToken['scope']);
        foreach ($wait_verify_scope as $item) {
            if (! in_array($item, $auth_scope_list)) {
                throw new Exception('Unauthorized', 401);
            }
        }

        return true;
    }

    protected function authorize($api, $username = '')
    {
        if (! $this->requiredAuthorization($api)) {
            return true;
        }

        return $this->verifyAuthorization($username);
    }

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
