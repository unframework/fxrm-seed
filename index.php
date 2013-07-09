<?php

ini_set('display_errors', 1);

require(__DIR__ . '/vendor/autoload.php');

$storable = new \Fxrm\Store\Environment('store.json');
$ctxInit = include(__DIR__ . '/context.php');
$ctx = $ctxInit($storable);

$service = $ctx->createService('\\TodoApp\\LoggedInApplication');

$app = $service->createInstance();

var_dump($app->findAllUsers());

$form = $service->createForm('api.php/setEmail', array('session' => $app->getSession()), 'setEmail');

if ($form->hasReturnValue()) {
    echo '<p>User information updated!</p>';
}

$form->start();

echo '<p>' . htmlspecialchars($form->getActionError()) . '</p>';

$form->field('email', 'text');
echo '<b>' . htmlspecialchars($form->getFieldError('email')) . '</b>';

echo '<button type="submit">Set Email</button>';

$form->end();

?>
