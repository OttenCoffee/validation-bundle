<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Otten\Bundle\ValidationBundle\DependencyInjection\OttenValidationExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Otten\Bundle\ValidationBundle\DependencyInjection\Compiler\TwigFormPass;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class OttenValidationBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigFormPass());
    }

    /**
     * @return OttenValidationExtension
     */
    public function getContainerExtension()
    {
        return new OttenValidationExtension();
    }
}
