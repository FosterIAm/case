<?php
namespace case\controllers;

use case\controllers\BaseController;
use case\models\MoneyModel;
use case\models\UserModel;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends BaseController
{ 
    private function isNew(string $email) : bool
    {
        $sql = 'SELECT email
                FROM users
                WHERE email = :email;';
        
        $query = $this->connect->getQuery($sql, array(':email' => $email));
        $data = $query->fetch();         
        
        if($data)
            return false;
        else
            return true;
    }

    public function rate(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {       
        $model = new MoneyModel();
        $data = $model->getRate();
        $decoded = json_decode($data);
        $rate = (string)$decoded->{"result"};

        $response->getBody()->write($rate);        
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function subscribe(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {   
        $params = $request->getParsedBody();        

        if($this->isNew($params['email']))
        {
            $model = new UserModel($this->connect);
        }    
        else
            return $response->withStatus(409);

        try{
            $model->add($params['email']);
        }catch(Exception $err)
        {
            return $response = $response->withStatus(400);
        }

        return $this->toJson('E-mail додано', $response);
    }


}