<?php

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