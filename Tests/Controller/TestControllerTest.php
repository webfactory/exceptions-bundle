<?php

/*
 * (c) webfactory GmbH <info@webfactory.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webfactory\Bundle\ExceptionsBundle\Tests\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Webfactory\Bundle\ExceptionsBundle\Controller\TestController;

/**
 * Tests for the TestController.
 */
class TestControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var TestController
     */
    private $controller;

    /**
     * Mocked container of the TestController.
     *
     * @var ContainerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $container;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $this->controller = new TestController();
        $this->container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
        $this->controller->setContainer($this->container);
        parent::setUp();
    }

    /**
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    protected function tearDown()
    {
        $this->container = null;
        $this->controller = null;
        parent::tearDown();
    }

    /**
     * Ensures that testErrorPageAction() throws a HttpException having the passed code as it's status code.
     */
    public function testTestErrorPageActionThrowsHttpExceptionWithPassedCode()
    {
        $expectedExceptionWasThrown = false;
        $expectedCode = 404;

        // $this->setExpectedException() would be much shorter but to expect a certain status code, one would also have
        // to expect a certain message, which we don't
        try {
            $this->controller->testErrorPageAction($expectedCode);
        } catch (HttpException $exception) {
            if ($expectedCode === 404) {
                $expectedExceptionWasThrown = true;
            }
        }

        if ($expectedExceptionWasThrown === false) {
            $message = 'Either the thrown HttpException had not the correct code (' . $expectedCode . '), or no '
                     . 'HttpException was thrown at all.';
            $this->fail($message);
        }
    }

    /**
     * Ensures that testErrorPageAction() does not call setDebug(false) if the Twig Controller retrieved from the
     * container is not an ExceptionsBundle's ExceptionController (because it probably has no setDebug or it has another
     * meaning).
     */
    public function testTestErrorPageActionDoesNotSetDebugToFalseForTwigControllerThatsNotAnExceptionController()
    {
        $notAnExceptionController = $this->getMock('stdClass')
                                         ->expects($this->never())
                                         ->method('setDebug');
        $this->container->expects($this->any())
                        ->method('get')
                        ->with('twig.controller.exception')
                        ->will($this->returnValue($notAnExceptionController));
        $this->setExpectedException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->controller->testErrorPageAction(404);
    }

    /**
     * Ensures that testErrorPageAction() calls setDebug(false) if the Twig Controller retrieved from the container is
     * an ExceptionsBundle's ExceptionController.
     */
    public function testTestErrorPageActionSetsDebugToFalseForTwigExceptionController()
    {
        $mockedClass = 'Webfactory\Bundle\ExceptionsBundle\Controller\ExceptionController';
        $exceptionController = $this->getMockBuilder($mockedClass)
                                    ->disableOriginalConstructor()
                                    ->getMock();
        $exceptionController->expects($this->atLeastOnce())
                            ->method('setDebug')
                            ->with(false);
        $this->container->expects($this->any())
                        ->method('get')
                        ->with('twig.controller.exception')
                        ->will($this->returnValue($exceptionController));
        $this->setExpectedException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->controller->testErrorPageAction(404);
    }
}
