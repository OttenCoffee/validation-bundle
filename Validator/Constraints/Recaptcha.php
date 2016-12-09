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

/**
 * @Annotation
 *
 * @author Indra Gunawan <hello@indra.my.id>
 */
class Recaptcha extends Constraint
{
    public $message = 'This value is not a valid recaptcha.';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'otten_recaptcha';
    }
}
