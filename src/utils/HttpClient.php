<?php

/*
 * This file is part of the jiannei/easy-github.
 *
 * (c) jiannei <longjian.huang@aliyun.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\EasyGithub\utils;

use GuzzleHttp\Client;
use Jiannei\EasyGithub\Exceptions\HttpException;
use Log;

trait HttpClient
{
    // request
    protected $options = [];

    private $optionsFormat;

    private $hasFormatted = false;

    private $uri;

    private $method;

    // client
    private $clientOptions = [];

    private $logChannel = 'github';

    // response
    protected $response = null;

    protected $contents = null;

    // ------------- request -----------------
    protected function setHeaders($headers)
    {
        $this->options = array_merge($this->options, ['headers' => $headers]);
    }

    protected function formatOptions($format, $options = [])
    {
        // query、form_params、body、json、multipart
        $this->optionsFormat = $format;
        if ($options) {
            $options = [$format => $options];
            $this->hasFormatted = true;
        }

        return $this->options = array_merge($this->options, $options);
    }

    private function mergeOptions($args)
    {
        if ($this->hasFormatted || !$args) {
            return $this->options;
        }

        $options = is_array(current($args)) ? current($args) : [$args[0] => $args[1]];

        return $this->options = array_merge($this->options, [$this->optionsFormat => $options]);
    }

    // -------------- client ----------------
    protected function setLog($name = 'github')
    {
        $this->logChannel = $name;
    }

    protected function setClient(array $options = [])
    {
        $this->clientOptions = $options;
    }

    private function buildClient()
    {
        return new Client($this->clientOptions);
    }

    protected function request($method, $uri, $options = [])
    {
        $this->setClient();
        $this->setLog();

        $this->mergeOptions($options);

        try {
            $this->log(['uri' => $uri, 'method' => $method, 'options' => $this->options], 'request');

            $this->response = $this->buildClient()->request($method, $uri, $this->options);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $this->log(['errors'=>$e->getMessage()], 'response');
            throw new HttpException($e->getMessage(), 0, $e);
        }

        if (204 != $this->status()) {
            $this->contents = $this->response->getBody()->getContents();
        } else {
            $this->contents = json_encode([]);
        }

        return $this;
    }

    private function log(array $something, $type = 'response')
    {
        // error_log("{$type}: ".json_encode($something), 3, 'github.log');
        Log::channel($this->logChannel)->debug($type, $something);
    }

    //  -------------------- response
    public function toRaw()
    {
        // $contents = $this->response->getBody()->getContents();
        $this->log(['status' => $this->status(), 'contents' => $this->contents], 'response');

        return $this->contents;
    }

    public function toArray()
    {
        $contents = json_decode($this->contents, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \RuntimeException(sprintf(
                'Failed to read response from "%s" as JSON: %s.',
                $this->uri,
                json_last_error_msg()
            ));
        }

        $this->log(['status' => $this->status(), 'contents' => $contents], 'response');

        return $contents;
    }

    public function status()
    {
        return $this->response->getStatusCode();
    }

    public function isSuccess()
    {
        return $this->status() >= 200 && $this->status() < 300;
    }

    protected function isRedirect()
    {
        return $this->status() >= 300 && $this->status() < 400;
    }

    public function isClientError()
    {
        return $this->status() >= 400 && $this->status() < 500;
    }

    public function isServerError()
    {
        return $this->status() >= 500;
    }
}
