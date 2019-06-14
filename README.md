<h1 align="center"> EasyGithub </h1>

## Installing

```shell
$ composer require jiannei/easy-github -vvv
```

## Usage

### For Laravel

**config**

```
php artisan vendor:publish --provider="Jiannei\EasyGithub\Providers\LaravelServiceProvider"
```

```php
use Jiannei\EasyGithub\Client as GithubClient;

// 获取某用户的所有仓库 
$result = app(GithubClient::class)->user('Jiannei')->repos();

// Oauth Apps 授权
$result = app(GithubClient::class)->oauthApp()->accessToken([
    'code'          => 'oauth code',// Github 返回的授权码
    'client_id'     => 'your oauth app client_id',// Github Oauth app
    'client_secret' => 'your oauth app client_secret',// Github Oauth app
]);

// 获取当前授权的用户信息
$result = app(GithubClient::class)->oauthApp()->user('access_token', 'xxxxxxx');
$result = app(GithubClient::class)->oauthApp()->user(['access_token' => 'xxxxxxx'])

// 另一种授权方式（accessToken + user）
$result = app(GithubClient::class)->oauthApp()->oauth([
    'code'          => 'oauth code',
    'client_id'     => 'your oauth app client_id',
    'client_secret' => 'your oauth app client_secret',
]);

// 获取用户仓库的 readme 信息
$result = app(GithubClient::class)->repository()->contents('Jiannei', 'EasyGithub')->readme();

// 在仓库下创建文件
$result = app(GithubClient::class)->repository()->contents('Jiannei', 'EasyGithub', 'test.md')->create([
    'message' => '测试',
    'content' => base64_encode('# 测试'),
    'branch'  => 'master',
]);

// 查找文件（sha）
$result = app(GithubClient::class)->repository()->contents('Jiannei', 'test', 'test.md')->get();

// 删除文件
$fileInfo = $result->toArray();// 需要上一步查找文件得到的 sha 值
$result = app(GithubClient::class)->repository()->contents('Jiannei', 'test', 'test.md')->delete([
    'message' => 'delete',
    'sha'     => $fileInfo['sha'],
    'branch'  => 'master',
]);

// 启用 page site
$result = app(GithubClient::class)->repository()->pages('Jiannei', 'test')->enable([
    'source' => [
        'branch' => 'master',
        'path'   => '/docs',
    ],
]);

// 禁用 page site
$result = app(GithubClient::class)->repository()->pages('Jiannei', 'test')->disable();

// 查询 git data 信息 （Git commit SHA-1 hash）
$result = app(GithubClient::class)->gitData()->references('JianNei', 'test', 'heads/master')->get();

// 创建仓库
$result = app(GithubClient::class)->repository('Jiannei')->create([
    'name'        => 'Hello-World',
    "description" => "This is your first repository",
]);

// 删除仓库
 $result = app(GithubClient::class)->repository('Jiannei','Hello-World')->delete();

dd($result->toArray());
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/Jiannei/EasyGithub/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/Jiannei/EasyGithub/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
