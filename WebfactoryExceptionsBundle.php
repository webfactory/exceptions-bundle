<?php

namespace Webfactory\Bundle\ExceptionsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WebfactoryExceptionsBundle extends Bundle {

    public function getParent() {
        return 'TwigBundle';
    }

}
