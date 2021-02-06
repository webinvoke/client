# WebInvoke Client
Webinvoke client is a client that provided access to all functionalities provied by [Webinvoke Server](https://github.com/webinvoke/server). <br/>
This library uses [Guzwrap](https://github.com/ahmard/guzwrap) internally.

## Installation
Installation is made using [Composer](https://getcomposer.org)

```bash
composer require webinvoke/client
```

## Usage
Before running below code, [Webinvoke Server](https://github.com/webinvoke/server#usage) must be started on port **8999**.
```php
use Webinvoke\Client\Auth;
use Webinvoke\Client\Query;
use Webinvoke\Client\Request;
use Webinvoke\Client\Server;

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
