<h1 align="center"> EasyGithub </h1>

<p align="center">
<a href="https://github.styleci.io/repos/191761913"><img src="https://github.styleci.io/repos/191761913/shield?branch=master" alt="StyleCI"></a>
</p>

## Installing

```shell
$ composer require jiannei/easy-github -vvv
```

## Usage

### 测试准备

* 在 web 服务器创建 test 目录和测试使用的 index.php 文件

```
// xxx/xxx/test/index.php
require __DIR__.'/vendor/autoload.php';

use Jiannei\EasyGithub\GithubClient;

$githubClient = new GithubClient();
```

#### 授权测试参考流程

* `settings -> Oauth Apps -> Authorization callback URL` 配置成本地测试地址
* 访问 `https://github.com/login/oauth/authorize?client_id=YOUR_OAUTH_APP_CLINET_ID`
* 将以下测试代码添加到测试文件，访问 `index.php`，将得到授权成功返回的 access_token

```
if (isset($_GET['code'])) {
    $response = $githubClient->api('oauthApps')->getAccessToken([
        'client_id'     => 'YOUR_OAUTH_APP_CLINET_ID',
        'client_secret' => 'YOUR_OAUTH_APP_CLINET_SECRET',
        'code'          => $_GET['code'],
    ]);
    var_export($response->body());
}else{
    echo '<br />testing...';
}
```

#### Github Action Secrets

- 获取 public_key

```
// 需要事先获取到授权 $accessToken
$response = $githubClient->api('secrets')->authorize($accessToken)->publicKey("Jiannei","vuepress-blog-demo");
```

- 获取全部的 secret

```
// 需要事先获取到授权 $accessToken
$response = $githubClient->api('secrets')->authorize($accessToken)->all("Jiannei","vuepress-blog-demo");
```

- 获取指定的 secret

```
// 需要事先获取到授权 $accessToken
$response = $githubClient->api('secrets')->authorize($accessToken)->show("Jiannei","vuepress-blog-demo",'ACCESS_TOKEN');
```

- 创建或更新 secret

```
// 需要事先获取到授权 $accessToken + 获取 public_key
$keypair = [
    'key_id' => 'your key_id',// 调用获取 public_key 接口得到的 key_id
    'key' => 'your key',// 调用获取 public_key 接口得到的 key
];

$params = [
    'value' => 'hello,world',// 新增/更新的 secret 值
    'name' => 'TEST'// secret 名称
];

// $response = $githubClient->api('secrets')->authorize($accessToken)->store("Jiannei", "vuepress-blog-demo", $keypair, $params);
```

- 删除 secret（测试未通过)

```
// 需要事先获取到授权 $accessToken
$response = $githubClient->api('secrets')->authorize($accessToken)->destroy("Jiannei","vuepress-blog-demo",'TEST');
```

### For Laravel


## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/Jiannei/EasyGithub/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/Jiannei/EasyGithub/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
