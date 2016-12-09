<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Tests\Validator\Constraints;

use Otten\Bundle\ValidationBundle\Validator\Constraints\Recaptcha;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class RecaptchaTest extends \PHPUnit_Framework_TestCase
{
    public function testValidatedBy()
    {
        $validator = new Recaptcha();
        $this->assertEquals('otten_recaptcha', $validator->validatedBy());
    }
}
