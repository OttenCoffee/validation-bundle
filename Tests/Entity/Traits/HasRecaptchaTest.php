<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Test\Entity\Traits;

use Otten\Bundle\ValidationBundle\Entity\Traits\HasRecaptcha;
use Doctrine\Common\Annotations\AnnotationReader;
use Otten\Bundle\ValidationBundle\Tests\Entity\Entity;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class HasRecaptchaTest extends \PHPUnit_Framework_TestCase
{
    public function testRecaptchaProperty()
    {
        $hasRecaptchaEntity = new Entity();

        $value = 'recaptcha_value';

        $this->assertEquals(get_class($hasRecaptchaEntity), get_class($hasRecaptchaEntity->setRecaptcha($value)));
        $this->assertEquals($value, $hasRecaptchaEntity->getRecaptcha());
    }

    public function testHasAnnotation()
    {
        $hasRecaptchaEntity = new Entity();

        $reader = new AnnotationReader();
        $recaptchaAnnotations = $reader->getPropertyAnnotations(new \ReflectionProperty(get_class($hasRecaptchaEntity), 'recaptcha'));

        $this->assertEquals(1, count($recaptchaAnnotations));
        $this->assertEquals('Otten\Bundle\ValidationBundle\Validator\Constraints\Recaptcha', get_class($recaptchaAnnotations[0]));
    }
}
