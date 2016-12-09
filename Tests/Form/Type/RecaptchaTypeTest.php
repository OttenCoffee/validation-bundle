<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Tests\Form\Type;

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormFactoryInterface;
use Otten\Bundle\ValidationBundle\Form\Type\RecaptchaType;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class RecaptchaTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $factory;

    protected function setUp()
    {
        $this->factory = Forms::createFormFactoryBuilder()
            ->addType(new RecaptchaType(true, 'foo'))
            ->getFormFactory();
    }

    public function testDefaultValue()
    {
        if (Kernel::VERSION_ID < 20800) {
            $form = $this->factory->create('otten_recaptcha');
        } else {
            $form = $this->factory->create(RecaptchaType::class);
        }
        $view = $form->createView();

        $this->assertTrue($view->vars['enabled']);
        $this->assertEquals('foo', $view->vars['site_key']);
    }
}
