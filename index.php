<?php
require_once "bootstrap.php";

if (CONTENT_SERVICE_CLIENT_TRANSPORT === 'local') {
    require_once $vendorDir . "/artyomderyavka/content/bootstrap.local.php";
}

$cachedContainerFile = $projectDir . DI_CONTAINER_CACHE_FILE;
//@todo - add checking of included configuration. Throw invalid configuration exception on error

//@todo - move container building into kernel
if (file_exists($cachedContainerFile)) {
    require_once $cachedContainerFile;
    $container = new ProjectServiceContainer();
} else {
    $locator = new \Symfony\Component\Config\FileLocator($projectDir);
    $container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
    $containerLoader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader($container, $locator);
    foreach ($servicesMap as $file) {
        $containerLoader->load($file);
    }
    $container->compile();

    $dumper = new \Symfony\Component\DependencyInjection\Dumper\PhpDumper($container);
    file_put_contents($cachedContainerFile, $dumper->dump());
}

//@todo - rename routes map parameter to routes config
$routesMap = [
    'cacheFile' => $projectDir . ROUTES_CACHE_FILE,
    'routes' => $routesMap
];

\FastMicroKernel\Components\App::run(
    $routesMap,
    $container
);