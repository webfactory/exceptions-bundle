<?php

namespace Webfactory\Bundle\ExceptionsBundle\Twig;

class Extension extends \Twig_Extension {

    protected $configuredBundleName;

    public function __construct($configuredBundleName) {
        $this->configuredBundleName = $configuredBundleName;
    }

    public function getName() {
        return 'webfactory_exceptions';
    }

    public function getGlobals() {
        return array(
            'webfactoryExceptionsBundleConfiguredBundleName' => $this->configuredBundleName
        );
    }

}