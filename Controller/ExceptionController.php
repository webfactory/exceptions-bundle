<?php

namespace Webfactory\Bundle\ExceptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;

class ExceptionController extends BaseController {

    /**
     * @Route("/{locale}/{code}/{format}", defaults={"format" = "html"})
     */
    public function testErrorPageAction($locale, $code, $format) {
        /** @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $this->container->get('request');
        $request->setLocale($locale);
        $request->setRequestFormat($format);

        $currentContent = $this->getAndCleanOutputBuffering();

        $templating = $this->container->get('templating');
        $exception = new HttpException($code);

        return $templating->renderResponse(
            $this->findTemplate($templating, $format, $code, false),
            array(
                'status_code'    => $code,
                'status_text'    => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : '',
                'exception'      => $exception,
//                'logger'         => $logger,
                'currentContent' => $currentContent,
            )
        );
    }

    protected function findTemplate($templating, $format, $code, $debug) {
        /** @var $request \Symfony\Component\HttpFoundation\Request */
        if ($locales = $this->container->getParameter('webfactory_exceptions.locales')) {

            $availableLocales = array();
            foreach ($locales as $locale) {
                $availableLocales[$locale] = $locale;
                $availableLocales[\Locale::getPrimaryLanguage($locale)] = $locale;
            }

            $request = $this->container->get('request');

            $preferredLanguage = $request->getPreferredLanguage(array_keys($availableLocales));
            $preferredLocale = $availableLocales[$preferredLanguage];

            $request->setLocale($preferredLocale);
        }

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
