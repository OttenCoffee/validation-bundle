<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\RequestStack;
use ReCaptcha\ReCaptcha as GoogleRecaptcha;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class RecaptchaValidator extends ConstraintValidator
{
    private $recaptcha;
    private $requestStack;
    private $enabled;

    const RECAPTCHA_RESPONSE_KEY = 'g-recaptcha-response';

    /**
     * @param GoogleRecaptcha    $recaptcha
     * @param RequestStack $requestStack
     * @param bool         $enabled
     */
    public function __construct(GoogleRecaptcha $recaptcha, RequestStack $requestStack, $enabled)
    {
        $this->recaptcha = $recaptcha;
        $this->requestStack = $requestStack;
        $this->enabled = (bool) $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$this->enabled) {
            return;
        }

        $value = $this->requestStack->getMasterRequest()->request->get(self::RECAPTCHA_RESPONSE_KEY);
        $response = $this->recaptcha->verify($value, $this->requestStack->getMasterRequest()->getClientIp());

        if (!$response->isSuccess()) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
