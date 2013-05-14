<?php

namespace Webfactory\Bundle\ExceptionsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\Definition\Processor;

class WebfactoryExceptionsExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);
        $container->setParameter('webfactory_exceptions.bundlename', $config['bundle']);
        $container->setParameter('webfactory_exceptions.locales', $config['locales']);

        if (!$container->getParameter('kernel.debug')) {
            $container->setParameter('twig.exception_listener.controller', 'Webfactory\Bundle\ExceptionsBundle\Controller\ExceptionController::showAction');
        }
    }

}
