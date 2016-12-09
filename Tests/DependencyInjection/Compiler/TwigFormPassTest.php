<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Tests\DependencyInjection\Compiler;

use Otten\Bundle\ValidationBundle\DependencyInjection\Compiler\TwigFormPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class TwigFormPassTest extends \PHPUnit_Framework_TestCase
{
    public function testTwigFromResourcesIsNotSet()
    {
        $container = new ContainerBuilder();

        $compiler = new TwigFormPass();
        $compiler->process($container);

        $this->assertFalse($container->hasParameter('twig.form.resources'));
    }

    public function testTwigFromResourcesIsSet()
    {
        $container = new ContainerBuilder();

        $container->setParameter('twig.form.resources', []);

        $compiler = new TwigFormPass();
        $compiler->process($container);

        $this->assertEquals(1, count($container->getParameter('twig.form.resources')));
    }
}
