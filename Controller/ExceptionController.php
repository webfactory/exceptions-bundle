<?php
namespace Webfactory\Bundle\ExceptionsBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;

class ExceptionController extends BaseController {

    public function setDebug($bool) {
        $this->debug = $bool;
    }

} 
