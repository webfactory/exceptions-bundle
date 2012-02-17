<?php

namespace Webfactory\Bundle\ExceptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;

class ExceptionController extends BaseController {

    protected function findTemplate($templating, $format, $code, $debug) {
        if ($debug && !$this->container->getParameter('webfactory_exceptions.force')) {
            return parent::findTemplate($templating, $format, $code, $debug);
        }

        $bundleName = $this->container->getParameter('webfactory_exceptions.bundlename');

        // Spezifisches für Code und Format
        if ($template = $this->loadTemplate($templating, $bundleName, 'error' . $code, $format))
            return $template;

        // Spezifisches für Format
        if ($template = $this->loadTemplate($templating, $bundleName, 'error', $format))
            return $template;

        // Fallback auf HTML
        if ($template = $this->loadTemplate($templating, $bundleName, 'error', 'html'))
            return $template;

        // Fallback auf ExceptionSeite aus unserem Bundle
        return $this->loadTemplate($templating, 'WebfactoryExceptionsBundle', 'error', 'html');
    }

    protected function loadTemplate($templating, $bundlename, $name, $format) {
        $template = new TemplateReference($bundlename, 'Exception', $name, $format, 'twig');
        if ($templating->exists($template)) {
            return $template;
        }
    }

}
