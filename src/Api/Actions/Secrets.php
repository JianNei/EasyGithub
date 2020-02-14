<?php


namespace Jiannei\EasyGithub\Api\Actions;


use Jiannei\EasyGithub\Api\Api;

class Secrets extends Api
{
    public function publicKey($owner, $repo)
    {
        return $this->httpClient->get('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/actions/secrets/public-key');
    }

    public function all($owner, $repo)
    {
        return $this->httpClient->get('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/actions/secrets');
    }

    public function show($owner, $repo, $name)
    {
        return $this->httpClient->get('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/actions/secrets/'.rawurlencode($name));
    }

    public function store($owner, $repo, $keypair, $params)
    {
        $encrypted_value = sodium_crypto_box_seal($params['value'], base64_decode($keypair['key']));
        $data = [
            'encrypted_value' => base64_encode($encrypted_value),
            'key_id' => $keypair['key_id']
        ];

        return $this->httpClient->put('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/actions/secrets/'.rawurlencode($params['name']), $data);
    }

    public function destroy($owner, $repo, $name)
    {
        return $this->httpClient->delete('https://api.github.com/repos/'.rawurlencode($owner).'/'.rawurlencode($repo).'/actions/secrets/'.rawurlencode($name));
    }
}