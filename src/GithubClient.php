<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub;

use Jiannei\EasyGithub\Api\Actions\Secrets;
use Jiannei\EasyGithub\Api\Apps\OAuthApps;
use Jiannei\EasyGithub\Api\Repositories\Contents;
use Jiannei\EasyGithub\Api\Repositories\Repositories;
use Jiannei\EasyGithub\Api\User;
use Jiannei\EasyGithub\Exceptions\BadMethodCallException;
use Jiannei\EasyGithub\Exceptions\InvalidArgumentException;

class GithubClient
{
    public function api($name)
    {
        switch ($name) {
            case 'secrets':
                $api = new Secrets();

                break;
            case 'user':
                $api = new User();

                break;
            case 'repositories':
                $api = new Repositories();

                break;
            case 'contents':
                $api = new Contents();

                break;
            case 'oauthApps':
                $api = new OAuthApps();

                break;
            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
    }

    public function __call($name, $args)
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }
}
