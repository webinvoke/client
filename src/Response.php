<?php


namespace Winvoke\Client;


use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Psr\Http\Message\ResponseInterface;

class Response
{
    protected array $payload;


    /**
     * Response constructor.
     * @param ResponseInterface $response
     * @throws JsonException
     */
    public function __construct(ResponseInterface $response)
    {
        $bodyContents = $response->getBody()->getContents();
        $this->payload = Json::decode($bodyContents, Json::FORCE_ARRAY);
    }

    /**
     * Get request payload
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * Get request result
     * @return array
     */
    public function getResult(): array
    {
        return $this->payload['query'] ?? [];
    }
}