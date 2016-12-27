# Validation Bundle

[![Source Code](http://img.shields.io/badge/source-OttenCoffee/validation--bundle-blue.svg?style=flat-square)](https://github.com/OttenCoffee/validation-bundle)
[![GitHub license](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/OttenCoffee/validation-bundle/blob/master/LICENSE)
[![Travis](https://img.shields.io/travis/OttenCoffee/validation-bundle.svg?style=flat-square)](https://travis-ci.org/OttenCoffee/validation-bundle)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/OttenCoffee/validation-bundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/OttenCoffee/validation-bundle)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/OttenCoffee/validation-bundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/OttenCoffee/validation-bundle/code-structure)

This bundle provides additional Symfony validation, include:
* ReCaptcha

## Step1: Setting up the Bundle

### Download the Bundle

Package can be installed using Composer.
```bash
composer require otten/validation-bundle
```

### Enable the Bundle

Enable the bundle in the kernel:
```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Otten\Bundle\ValidationBundle\OttenValidationBundle(),
        );

        // ...
    }
}
```

## Step2: Configuring Validation
* [ReCaptcha](Resources/doc/validation/recaptcha.md)

## License

This bundle is under the MIT license. See the complete license [in the bundle](LICENSE)
