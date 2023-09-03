<?php declare(strict_types=1);

namespace Frosh\ThumbnailProcessor\tests;

use Shopware\Core\TestBootstrapper;

$testBootstrapperPluginDevDocker = '/opt/share/shopware/tests/TestBootstrapper.php';

if (\is_file($testBootstrapperPluginDevDocker)) {
    $testBootstrapper = require $testBootstrapperPluginDevDocker;

    return $testBootstrapper
        /*->setLoadEnvFile(true)*/
        ->setForceInstallPlugins(true)
        ->addActivePlugins('FroshPlatformThumbnailProcessor')
        ->bootstrap()
        ->getClassLoader();
}

$paths = [
    '../../../../src/Core/TestBootstrapper.php',
    '../vendor/shopware/core/TestBootstrapper.php',
    '../../../../vendor/shopware/core/TestBootstrapper.php',
];

foreach ($paths as $path) {
    $path = realpath(__DIR__ . '/' . $path);

    if (!\is_string($path)) {
        continue;
    }

    if (!\is_file($path)) {
        continue;
    }

    require $path;

    return (new TestBootstrapper())
        ->setPlatformEmbedded(false)
        ->setLoadEnvFile(true)
        ->setForceInstallPlugins(true)
        ->addActivePlugins('FroshPlatformThumbnailProcessor')
        ->bootstrap()
        ->getClassLoader();
}
