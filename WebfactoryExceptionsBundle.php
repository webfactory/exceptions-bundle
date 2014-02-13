<?php

namespace Webfactory\Bundle\ExceptionsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WebfactoryExceptionsBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->setParameter('twig.controller.exception.class', 'Webfactory\Bundle\ExceptionsBundle\Controller\ExceptionController');
    }

}
