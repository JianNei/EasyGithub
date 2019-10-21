<?php

namespace Jiannei\EasyGithub\Api;

class Users extends Api
{
    public function repositories($username, $params)
    {
        return $this->httpClient->get('https://api.github.com/users/'.rawurlencode($username).'/repos', $params);
    }
}
