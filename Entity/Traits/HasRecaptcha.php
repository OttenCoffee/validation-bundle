<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Entity\Traits;

use Otten\Bundle\ValidationBundle\Validator\Constraints\Recaptcha;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
trait HasRecaptcha
{
    /**
     * @var mixed
     *
     * @Recaptcha
     */
    private $recaptcha;

    /**
     * Get Recaptcha.
     *
     * @return mixed
     */
    public function getRecaptcha()
    {
        return $this->recaptcha;
    }

    /**
     * Get Recaptcha.
     *
     * @param mixed
     *
     * @return mixed
     */
    public function setRecaptcha($recaptcha)
    {
        $this->recaptcha = $recaptcha;

        return $this;
    }
}
