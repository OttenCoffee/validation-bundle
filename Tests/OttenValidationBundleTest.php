<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Test;

use Otten\Bundle\ValidationBundle\OttenValidationBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Otten\Bundle\ValidationBundle\DependencyInjection\OttenValidationExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class OttenValidationBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $container = $this->getMockBuilder(ContainerBuilder::class)->getMock();

        $bundle = new OttenValidationBundle();
        $bundle->build($container);

        $this->assertInstanceOf(OttenValidationExtension::class, $bundle->getContainerExtension());
    }
}
