<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

// Ниже мы добавляем новый маршрут для действия tagged.
// `*` означает, что после указанного маршрута
//могут быть добавлены параметры.
Router::scope(
    '/bookmarks',
    ['controller' => 'Bookmarks'],
    function ($routes) {
        $routes->connect('/tagged/*', ['action' => 'tags']);
    }
);

Router::scope('/', function (RouteBuilder $routes) {
   
    //подключение маршрута для стартовой 
    //страницы (список закладок)
    $routes->connect('/', [
        'controller' => 'Bookmarks', 
        'action' => 'index'
    ]);

    $routes->fallbacks(DashedRoute::class);
});

Plugin::routes();
