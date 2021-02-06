<?php


namespace Webinvoke\Client;


class Auth
{
    protected array $values = [];


    public static function create(?string $token = null): Auth
    {
        return new Auth($token);
    }

    public function __construct(?string $token)
    {
        if (null !== $token){
            $this->values['token'] = $token;
            $this->values['auth_type'] = 'token';
        }
    }

    public function open(): Auth
    {
        $this->values['auth_type'] = 'open';
        return $this;
    }

    public function credentials(string $username, string $password): Auth
    {
        $this->values['auth_type'] = 'credential';
        $this->values['credential'] = [
            'username' => $username,
            'password' => $password
        ];

        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }
}