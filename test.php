<?php

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