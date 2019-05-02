# PSR15 リクエストハンドラー サンプル集


## Requirements

- PHP >= 7.2
- composer

## install

```
$ composer install
```

## run

以下のいずれかの方法で起動して、ブラウザから `http://localhost:8080/` へアクセスする。

### league/route

```
$ php -S localhost:8080 league.php
```

### northwoods/router

```
$ php -S localhost:8080 northwoods.php
```

### sunrise/http-router

```
$ php -S localhost:8080 sunrise.php
```

### middlewares/request-handler

```
$ php -S localhost:8080 middlewares.php
```
