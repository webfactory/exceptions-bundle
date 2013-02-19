<?php

namespace Webfactory\Bundle\ExceptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller {

    /**
     * @Route("/{code}/", defaults={"_format" = "html"}, requirements={"code" = "\d+"})
     * @Route("/{code}/{_locale}/", defaults={"_format" = "html"}, requirements={"code" = "\d+"})
     * @Route("/{code}/{_locale}/{_format}/", requirements={"code" = "\d+"})
     */
    public function testErrorPageAction($code, $_format) {
        return $this->forward('WebfactoryExceptionsBundle:Exception:show', array(
            'exception' => FlattenException::create(new HttpException($code)),
            'format' => $_format
        ));
    }

}
