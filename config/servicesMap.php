<?php
/**
 * Created by PhpStorm.
 * Date: 04.08.2017
 * Time: 13:21
 */

$pathFromProjectDir = str_replace($projectDir . "/", "", __DIR__);

$servicesMap = array_merge($servicesMap, [
    (!empty($pathFromProjectDir) ? $pathFromProjectDir . "/" : "") . 'services.yml',
]);