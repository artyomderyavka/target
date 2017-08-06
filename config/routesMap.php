<?php
/**
 * Created by PhpStorm.
 * Date: 03.08.2017
 * Time: 14:01
 */

$routesMap = array_merge($routesMap, [
    ['routesFilePath' => __DIR__ . '/routes.yml', 'routesPrefix' => $routesPrefix],  /*project micro-service*/
]);