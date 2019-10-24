<?php




$router->get('', 'channelController@index');
$router->get('channels', 'channelController@create');
$router->get('rules', 'channelController@rules');


$router->post('upload', 'postController@create');

