<?php


$router->get('' , 'pagesController@index');
$router->post('checkPayment' , 'paymentController@check');
$router->get('paid' , 'pagesController@paid');

$router->get('login' , 'pagesController@loginForm');
$router->get('register' , 'pagesController@registerForm');
$router->get('logout' , 'adminController@logout');

$router->post('login' , 'adminController@login');
$router->post('register' , 'adminController@register');

$router->get('manage' , 'pagesController@manage');

$router->post('upload' , 'adminController@upload');


