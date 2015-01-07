<?php
/*
 * (c) webfactory GmbH <info@webfactory.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webfactory\Bundle\ExceptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Controller to render your custom exception pages. Accessing it is really simple, e.g. a call to .../405/html will
 * render your 405 HTML error page.
 */
class TestController extends Controller
{
    /**
     * Let the error page for the HTTP status code $code be rendered in the format $format.
     *
     * @param int $code HTTP error status code
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testErrorPageAction($code)
    {
        $exceptionController = $this->get('twig.controller.exception');

        if ($exceptionController instanceof ExceptionController) {
            $exceptionController->setDebug(false);
        }

        throw new HttpException($code);
    }
}
