<?php
namespace case\models;

use case\connector\Connector;

class BaseModel
{    
    public function __construct(
        protected Connector $connector
    ){}

}