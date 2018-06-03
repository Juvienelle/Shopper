<?php

require __DIR__ . '/../vendor/autoload.php';

use Cart\App;
use Slim\Views\Twig;
use Illuminate\Database\Capsule\Manager as Capsule;
session_start();
$app = new App;

$container = $app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'host',
    'database'  => 'database',
    'username'  => 'username',
    'password'  => 'password',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

/* Register to braintree */
Braintree_Configuration::environment('');
Braintree_Configuration::merchantId('');
Braintree_Configuration::publicKey('');
Braintree_Configuration::privateKey('');

require __DIR__ . '/../app/routes.php';

$app->add(new \Cart\Middleware\ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new \Cart\Middleware\OldInputMiddleware($container->get(Twig::class)));