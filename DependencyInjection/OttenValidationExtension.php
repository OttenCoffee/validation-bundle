<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class OttenValidationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $this->loadRecaptcha($container, $config['recaptcha']);
    }

    private function loadRecaptcha(ContainerBuilder $container, array $config)
    {
        $recaptchaDefinition = $container->findDefinition('otten_validation.recaptcha');
        $recaptchaDefinition->replaceArgument(0, $config['secret_key']);

        $validatorDefinition = $container->findDefinition('otten_validation.validator.recaptcha');
        $validatorDefinition->replaceArgument(2, $config['enabled']);

        $formTypeDefinition = $container->findDefinition('otten_validation.form_type.recaptcha');
        $formTypeDefinition->replaceArgument(0, $config['enabled']);
        $formTypeDefinition->replaceArgument(1, $config['site_key']);
    }
}
