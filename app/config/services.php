<?php

use Framework\Container;
use App\Infrastructure\Persistence\Database;

$container = new Container();

$container->setService(Database::class, function(){
    return new Database(
        getenv('DB_HOST'), 
        getenv('DB_PORT'), 
        getenv('DB_NAME'), 
        getenv('DB_USER'), 
        getenv('DB_PASSWORD')
    );
});

return $container;