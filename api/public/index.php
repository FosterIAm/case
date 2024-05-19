<?php

declare(strict_types=1);

use case\controllers\AutoController;
use case\controllers\MoneyController;
use case\controllers\UserController;
use Slim\Factory\AppFactory;

http_response_code(200);

require __DIR__ .'/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

// відправити повідомлення поточного курсу USD до UAH
// виконує роль запиту для автоматизованої розсилки
/* з файлу README.txt
    існує 2 інших способа досягти автоматизації:

    1)  створити окремий модуль, і пересадити його на якийсь інший порт. 
        Тоді в нас буде 2 різних АРІ - для користувачів і для автоматизації роботи. Однак
        в контексті цього додатку я вирішив що це нерелеватне рішення
        та як буде дуже багато повторювань коду, доведеться робити лишній контейнер
        та виділяти окремий порт

    2)  Виконувати РНР код на пряму. Тобто не виносити його в запит
        а виконувати локально.
        Такий підхід вимагає локально установленого РНР підходящої версії
        що є дуже не зручним підходом. 

*/
$app->get('/send[/]', [AutoController::class, 'send']);



// Отримання поточного курсу USD до UAH
$app->get('/rate[/]', [MoneyController::class, 'rate']);

// Робота з підпискою
$app->post('/subscribe[/]', [UserController::class, 'subscribe']);

$app->run();
