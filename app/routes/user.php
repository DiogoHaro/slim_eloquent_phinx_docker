<?php

use app\controllers\User;

$app->get('/user/create', User::class.':create');
$app->get('/user/edit/{id}', User::class.':edit');
$app->get('/user/edit/password/{id}', User::class.':changePassword');
$app->post('/user/store', User::class.':store');
$app->put('/user/update/{id}', User::class.':update');
$app->put('/user/update/password/{id}', User::class.':newPassword');
$app->delete('/user/delete/{id}', User::class.':destroy');