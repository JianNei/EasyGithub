<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\Providers;

use Jiannei\EasyGithub\Client as GithubClient;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton(GithubClient::class, function () {
            return new GithubClient();
        });

        $this->app->alias(GithubClient::class, 'Github');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/easy-github.php' => config_path('easy-github.php'),
        ], 'config');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [GithubClient::class, 'Github'];
    }
}
