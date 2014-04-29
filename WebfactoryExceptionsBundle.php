<?php
/*
 * (c) webfactory GmbH <info@webfactory.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webfactory\Bundle\ExceptionsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Symfony bundle class that overwrites the Twig exception controller class with this bundle's one for easy testing of
 * your custom exception pages.
 */
class WebfactoryExceptionsBundle extends Bundle
{
    /**
     * @see \Symfony\Component\HttpKernel\Bundle\Bundle::build()
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->setParameter(
            'twig.controller.exception.class',
            'Webfactory\Bundle\ExceptionsBundle\Controller\ExceptionController'
        );
    }
}
