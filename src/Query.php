<?php


namespace Webinvoke\Client;


class Query
{
    protected array $values = [];


    public function fetchAll(): Query
    {
        $this->values['command'] = 'fetch.all';
        return $this;
    }

    public function fetchNew(): Query
    {
        $this->values['command'] = 'fetch.new';
        return $this;
    }

    public function limit(int $total): Query
    {
        $this->values['limit'] = $total;
        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }
}