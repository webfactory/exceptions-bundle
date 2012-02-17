<?php

namespace Webfactory\Bundle\ExceptionsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Definition\Processor;

class WebfactoryExceptionsExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);
        $container->setParameter('webfactory_exceptions.bundlename', $config['bundle']);

        if ($config['debug'])
            $container->setParameter('webfactory_exceptions.debug', $config['debug']);
    }

}
