<?php

namespace Jiannei\EasyGithub\Api;

use Jiannei\Http\Client;

abstract class Api
{
    protected $httpClient;

    public function __construct($options = [])
    {
        $defaultConfig = [
            'Accept' => 'application/vnd.github.v3+json',
            'User-Agent' => 'EasyGithub',
            'Time-Zone' => 'Asia/Shanghai',
        ];

        $this->httpClient = Client::create(array_merge($defaultConfig, $options));
    }

    public function authorize($accessToken)
    {
        return tap($this, function () use ($accessToken) {
            $this->httpClient->withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ]);
        });
    }
}
