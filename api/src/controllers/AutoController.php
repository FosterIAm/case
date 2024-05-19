<?php
namespace case\controllers;


use case\controllers\BaseController;
use case\models\AutoModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AutoController extends BaseController
{ 
    public function send(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {       
        $model = new AutoModel($this->connect);
        $model->sendMessage();       
        return $response;
    }
}