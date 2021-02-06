# Winvoke Client
Winvoke(Web Invoke) client is a client that provided access to all functionalities provied by [Winvoke Server](https://github.com/winvoke/server). <br/>
This library uses [Guzwrap](https://github.com/ahmard/guzwrap) internally.

## Installation
Installation is made using [Composer](https://getcomposer.org)

```bash
composer require winvoke/client
```

## Usage
Before running below code, [Winvoke Server](https://github.com/winvoke/server#usage) must be started on port **8999**.
```php
use Winvoke\Client\Auth;
use Winvoke\Client\Query;
use Winvoke\Client\Request;
use Winvoke\Client\Server;

require 'vendor/autoload.php';

$response = Request::create()
    ->server(Server::create('http://localhost:8999'))
    ->auth(Auth::create()->open())
    ->query(function (Query $query){
        $query->fetchAll();
        $query->limit(5);
    })
    ->execute();

var_dump($response->getPayload());
```