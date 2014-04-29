<?php
/*
 * (c) webfactory GmbH <info@webfactory.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webfactory\Bundle\ExceptionsBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;

/**
 * This ExceptionController is a plain Symfony ExceptionController apart from the possibility to change it's debug
 * property after construction.
 *
 * Having set debug = true, as you probably have during development, throwing and not catching an exception leads to
 * Symfony's default "Exception detected" ghost page. For the TestController, setting debug to false is an easy way to
 * circumvent this behaviour, resulting in your fine crafted exeption pages being rendered.
 */
class ExceptionController extends BaseController
{
    /**
     * Set the internal debug property.
     *
     * @param bool $bool
     */
    public function setDebug($bool)
    {
        $this->debug = $bool;
    }
}
