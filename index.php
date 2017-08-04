<?php
$projectDir =  __DIR__;
require_once $projectDir . "/vendor/autoload.php";
require_once $projectDir . "/config/constants.php";
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

require_once $projectDir . "/config/routesMap.php";
require_once $projectDir . "/config/servicesMap.php";

$cachedContainerFile = $servicesMap['cachedContainerFile'];
$servicesFiles = $servicesMap['servicesFiles'];

//@todo - add checking of included configuration. Throw invalid configuration exception on error

if (file_exists($cachedContainerFile)) {
    require_once $cachedContainerFile;
    $container = new ProjectServiceContainer();
} else {
    $locator = new \Symfony\Component\Config\FileLocator($projectDir);
    $container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
    $containerLoader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader($container, $locator);
    foreach ($servicesFiles as $file) {
        $containerLoader->load($file);
    }
    $container->compile();

    $dumper = new \Symfony\Component\DependencyInjection\Dumper\PhpDumper($container);
    file_put_contents($cachedContainerFile, $dumper->dump());
}

\FastMicroKernel\Components\App::run(
    $routesMap,
    $container
);