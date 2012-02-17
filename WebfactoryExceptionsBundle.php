<?php

namespace Webfactory\Bundle\ExceptionsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WebfactoryExceptionsBundle extends Bundle {

    public function getParent() {
        return 'TwigBundle';
    }

    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new DependencyInjection\Compiler\OverrideControllerPass());
    }

}
