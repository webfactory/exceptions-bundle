<?php

namespace Webfactory\Bundle\ExceptionsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class OverrideControllerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        $container->setParameter('twig.exception_listener.controller', 'Webfactory\Bundle\ExceptionsBundle\Controller\ExceptionController::showAction');
    }

}


