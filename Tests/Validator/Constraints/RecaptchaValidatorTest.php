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

use Otten\Bundle\ValidationBundle\Validator\Constraints\RecaptchaValidator;
use Otten\Bundle\ValidationBundle\Validator\Constraints\Recaptcha;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class RecaptchaValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateResponseSuccess()
    {
        $context = $this->getContextMock();
        $recaptcha = $this->getRecaptchaMock(true);
        $requestStack = $this->getRequestStackMock();
        $enabled = true;

        $validator = new RecaptchaValidator($recaptcha, $requestStack, $enabled);
        $validator->initialize($context);

        $context->expects($this->never())->method('buildViolation');

        $validator->validate('recaptcha_value_from_request', new Recaptcha());
    }

    public function testValidateResponseNotSuccess()
    {
        $context = $this->getContextMock();
        $recaptcha = $this->getRecaptchaMock(false);
        $requestStack = $this->getRequestStackMock();
        $enabled = true;

        $validator = new RecaptchaValidator($recaptcha, $requestStack, $enabled);
        $validator->initialize($context);

        $violationBuilder = $this->getMockBuilder('Symfony\Component\Validator\Violation\ConstraintViolationBuilder')->disableOriginalConstructor()->getMock();
        $violationBuilder->expects($this->once())->method('addViolation');
        $context->expects($this->once())->method('buildViolation')->willReturn($violationBuilder);

        $validator->validate('recaptcha_value_from_request', new Recaptcha());
    }

    public function testRecaptchaDisabled()
    {
        $context = $this->getContextMock();
        $recaptcha = $this->getMockBuilder('ReCaptcha\ReCaptcha')->disableOriginalConstructor()->getMock();
        $requestStack = $this->getMockBuilder('Symfony\Component\HttpFoundation\RequestStack')->disableOriginalConstructor()->getMock();
        $enabled = false;

        $validator = new RecaptchaValidator($recaptcha, $requestStack, $enabled);
        $validator->initialize($context);

        $recaptcha->expects($this->never())->method('verify');
        $requestStack->expects($this->never())->method('getMasterRequest');

        $validator->validate('recaptcha_value_from_request', new Recaptcha());
    }

    private function getContextMock()
    {
        return $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')->disableOriginalConstructor()->getMock();
    }

    private function getRequestStackMock()
    {
        $paremeterBag = $this->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')->disableOriginalConstructor()->getMock();
        $paremeterBag->expects($this->once())->method('get')->willReturn('foo');

        $masterRequest = $this->getMockBuilder('Symfony\Component\HttpFoundation\Request')->disableOriginalConstructor()->getMock();
        $masterRequest->expects($this->once())->method('getClientIp')->willReturn('127.0.0.1');
        $masterRequest->request = $paremeterBag;

        $requestStack = $this->getMockBuilder('Symfony\Component\HttpFoundation\RequestStack')->disableOriginalConstructor()->getMock();
        $requestStack->expects($this->any())->method('getMasterRequest')->willReturn($masterRequest);

        return $requestStack;
    }

    private function getRecaptchaMock($success = true)
    {
        $recaptchaResponse = $this->getMockBuilder('ReCaptcha\Response')->disableOriginalConstructor()->getMock();
        $recaptchaResponse->expects($this->once())->method('isSuccess')->willReturn($success);

        $recaptcha = $this->getMockBuilder('ReCaptcha\ReCaptcha')->disableOriginalConstructor()->getMock();
        $recaptcha->expects($this->once())->method('verify')->willReturn($recaptchaResponse);

        return $recaptcha;
    }
}
