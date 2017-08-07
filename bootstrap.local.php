<?php
/**
 * Created by PhpStorm.
 * User: Artyom
 * Date: 06.08.2017
 * Time: 15:15
 */
if (!isset($targetServiceBootstrapped) || $targetServiceBootstrapped === false) {
    $routesPrefix = "/target";
    require_once __DIR__ . "/config/routesMap.php";
    require_once __DIR__ . "/config/servicesMap.php";
    $routesPrefix = "";
    require_once $vendorDir . "/artyomderyavka/content/bootstrap.local.php";
    $targetServiceBootstrapped = true;
}
