<?php


namespace Webinvoke\Client;

use Closure;
use Guzwrap\Request as GRequest;
use Guzwrap\Wrapper\Form;
use LogicException;
use Nette\Utils\Json;
use UnexpectedValueException;


class Request
{
    private Auth $auth;
    private Server $server;
    private Query $query;


    public static function create(): Request
    {
        return new Request();
    }

    /**
     * Server authentication
     * @param string|Auth $tokenOrAuth
     * @return $this
     */
    public function auth($tokenOrAuth): Request
    {
        if (is_string($tokenOrAuth)) {
            $this->auth = Auth::create($tokenOrAuth);
            return $this;
        } elseif ($tokenOrAuth instanceof Auth) {
            $this->auth = $tokenOrAuth;
            return $this;
        } else {
            throw new UnexpectedValueException('Passed parameter only support value of type string or Webinvoke\Client\Auth');
        }
    }

    /**
     * Remote webinvoke server
     * @param string|Server $uriOrServer
     * @return $this
     */
    public function server($uriOrServer): Request
    {
        if (is_string($uriOrServer)) {
            $this->server = Server::create($uriOrServer);
        }

        $this->server = $uriOrServer;
        return $this;
    }

    /**
     * Define request query
     * @param Query|Closure $closureOrQuery
     * @return $this
     */
    public function query($closureOrQuery): Request
    {
        if (is_callable($closureOrQuery)) {
            $query = new Query();
            $closureOrQuery($query);
            $this->query = $query;
            return $this;
        } elseif ($closureOrQuery instanceof Query) {
            $this->query = $closureOrQuery;
            return $this;
        }

        throw new UnexpectedValueException('Passed parameter only support value of type \Closure or Webinvoke\Client\Query');
    }

    public function execute(): Response
    {
        if (!isset($this->server)) {
            throw new LogicException('Please provide server/server uri before executing the request.');
        }

        if (!isset($this->auth)) {
            throw new LogicException('Please provide auth method before executing the request.');
        }

        $response = GRequest::form(function (Form $form) {
            $serverData = $this->server->getValues();
            $form->action($serverData['uri']);
            $form->method('post');
            $form->input('auth', Json::encode($this->auth->getValues()));
            $form->input('query', Json::encode($this->query->getValues()));
        })->exec();

        return new Response($response);
    }
}