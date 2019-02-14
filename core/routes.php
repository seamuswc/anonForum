<?php


$router->get('' , 'pagesController@index');
$router->post('checkPayment' , 'paymentController@check');
$router->get('paid' , 'pagesController@paid');
