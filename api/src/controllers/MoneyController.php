<?php
namespace case\controllers;

use case\controllers\BaseController;
use case\models\MoneyModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MoneyController extends BaseController
{ 

    public function rate(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {       
        $model = new MoneyModel();
        $data = $model->getRate();
        $decoded = json_decode($data);
        $rate = (string)$decoded->{"result"};

        $response->getBody()->write($rate);        
        return $response->withHeader('Content-Type', 'application/json');
    }

}