<?php


namespace Webinvoke\Client;


class Server
{
    private string $uri;


    public static function create(string $uri): Server
    {
        return new Server($uri);
    }

    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    public function getValues(): array
    {
        return [
            'uri' => $this->uri
        ];
    }
}