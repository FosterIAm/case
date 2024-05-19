<?php
namespace case\models;

use Exception;


class UserModel extends BaseModel
{    
    public function add(string $email)
    {   
        // уводимо змінну в бд   
        $sql = 'INSERT INTO users (email) 
                VALUES (:email)';

       $query = $this->connector->getQuery($sql,array(':email'=> $email));
     
       // перевіряємо чи запит правильно виконався
       $sql = 'SELECT email
               FROM users 
               WHERE email = :email';
       
       $query = $this->connector->getQuery($sql,array(':email'=> $email));
       $data = $query->fetch();
       
       if($data)
            return true;
        else
            throw new Exception();
    }
}