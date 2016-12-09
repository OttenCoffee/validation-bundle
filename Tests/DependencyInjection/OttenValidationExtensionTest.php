<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Tests\DependencyInjection;

use Otten\Bundle\ValidationBundle\DependencyInjection\OttenValidationExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class OttenValidationExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testConfigurationThrowsExceptionUnlessRecaptchaSiteKeySet()
    {
        $loader = new OttenValidationExtension();
        $config = $this->getDefaultConfig();
        unset($config['recaptcha']['site_key']);

        $loader->load([$config], $this->containerBuilder);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testConfigurationThrowsExceptionUnlessRecaptchaSecretKeySet()
    {
        $loader = new OttenValidationExtension();
        $config = $this->getDefaultConfig();
        unset($config['recaptcha']['secret_key']);

        $loader->load([$config], $this->containerBuilder);
    }

    public function testContainerHasDefinition()
    {
        $loader = new OttenValidationExtension();
        $config = $this->getDefaultConfig();
        $loader->load([$config], $this->containerBuilder);

        $this->assertTrue($this->containerBuilder->hasDefinition('otten_validation.recaptcha'));
        $this->assertTrue($this->containerBuilder->hasDefinition('otten_validation.validator.recaptcha'));
    }

    public function testServiceValidArgument()
    {
        $loader = new OttenValidationExtension();
        $config = $this->getDefaultConfig();
        $loader->load([$config], $this->containerBuilder);

        $recaptchaDefinition = $this->containerBuilder->getDefinition('otten_validation.recaptcha');
        $validatorDefinition = $this->containerBuilder->getDefinition('otten_validation.validator.recaptcha');
        $formTypeDefinition = $this->containerBuilder->getDefinition('otten_validation.form_type.recaptcha');

        $this->assertEquals('secretkeyvalue', $recaptchaDefinition->getArguments()[0]);
        $this->assertTrue($formTypeDefinition->getArguments()[0]);
        $this->assertEquals('sitekeyvalue', $formTypeDefinition->getArguments()[1]);
        $this->assertTrue($validatorDefinition->getArguments()[2]);
    }

    /**
     * @return array
     */
    protected function getDefaultConfig()
    {
        $yaml = <<<'EOF'
recaptcha:
    enabled: true
    site_key: sitekeyvalue
    secret_key: secretkeyvalue
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    protected function setUp()
    {
        $this->containerBuilder = new ContainerBuilder();
    }

    protected function tearDown()
    {
        $this->containerBuilder = null;
        unset($this->containerBuilder);
    }
}
