<?php

namespace Jiannei\EasyGithub\Traits\OauthApp;


trait Authenticatable
{
    protected function authorize($accessToken)
    {
        return $this->httpClient->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ]);
    }
}