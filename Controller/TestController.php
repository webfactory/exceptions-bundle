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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller {

    /**
     * @Route("/{code}/", defaults={"_format" = "html"}, requirements={"code" = "\d+"})
     * @Route("/{code}/{_format}/", requirements={"code" = "\d+"})
     */
    public function testErrorPageAction($code) {
        $exceptionController = $this->get('twig.controller.exception');

        if ($exceptionController instanceof ExceptionController) {
            $exceptionController->setDebug(false);
        }

        throw new HttpException($code);
    }

}
