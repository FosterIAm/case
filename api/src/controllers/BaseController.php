<?php
namespace case\controllers;

use case\connector\Connector;
use Psr\Http\Message\ResponseInterface;

class BaseController 
{
    protected $connect;

    public function __construct()
    {
        $this->connect = new Connector;
    }

    protected function toJson(string $data, ResponseInterface $response): ResponseInterface
    {
        $data = json_encode($data, JSON_THROW_ON_ERROR);
        $response->getBody()->write($data);
        
        return $response->withHeader('Content-Type', 'application/json');
    }

}