<?php

namespace Webfactory\Bundle\ExceptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;

class ExceptionController extends BaseController {

    protected function findTemplate($templating, $format, $code, $debug) {
        $debugExceptionPage = $this->container->getParameter('webfactory_exceptions.debug');
        $bundleName = $this->container->getParameter('webfactory_exceptions.bundlename');

        // Standardverhalten...
        $name = $debug ? 'exception' : 'error';
        if ($debug && 'html' == $format) {
            $name = 'exception_full';
        }

        // Wenn wir explizit die Exceptionpage debuggen wollen...
        $name = $debugExceptionPage ? 'error' : $name;

        // when not in debug, try to find a template for the specific HTTP status code and format
        if (!$debug || $debugExceptionPage) {
            $template = $this->loadTemplate($templating, $bundleName, $name.$code, $format);
            if ($template)
                return $template;
        }

        // try to find a template for the given format
        $template = $this->loadTemplate($templating, $bundleName, $name, $format);
        if ($template)
            return $template;

        return parent::findTemplate($templating, $format, $code, $debug);
    }

    protected function loadTemplate($templating, $bundlename, $name, $format) {
        $template = new TemplateReference($bundlename, 'Exception', $name, $format, 'twig');
        if ($templating->exists($template)) {
            return $template;
        }
    }

}
