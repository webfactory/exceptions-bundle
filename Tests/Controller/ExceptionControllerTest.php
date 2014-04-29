<?php

/*
 * (c) webfactory GmbH <info@webfactory.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webfactory\Bundle\ExceptionsBundle\Tests\Controller;

use Webfactory\Bundle\ExceptionsBundle\Controller\ExceptionController;

/**
 * Tests for the ExceptionController.
 */
class ExceptionControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * System under test.
     *
     * @var ExceptionController
     */
    private $controller;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $this->controller = new ExceptionController(new \Twig_Environment(), true);
        parent::setUp();
    }

    /**
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    protected function tearDown()
    {
        $this->controller = null;
        parent::tearDown();
    }

    /**
     * Ensures that the ExceptionBundle's ExceptionController is a TwigBundle's ExceptionController.
     */
    public function testSutIsATwigExceptionController()
    {
        $this->assertInstanceOf('Symfony\Bundle\TwigBundle\Controller\ExceptionController', $this->controller);
    }

    /**
     * Ensures that setDebug sets the otherwise immutable value of 'debug'. There is no getter to test a round trip.
     */
    public function testSetDebugSetsValue()
    {
        $expectedValue = false;
        $this->assertAttributeNotEquals($expectedValue, 'debug', $this->controller, 'Test prerequisite not met.');

        $this->controller->setDebug($expectedValue);
        $this->assertAttributeEquals($expectedValue, 'debug', $this->controller);
    }
}
