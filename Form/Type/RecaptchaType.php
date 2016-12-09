<?php

/*
 * This file is part of the validation-bundle.
 *
 * (c) OttenCoffee <https://ottencoffee.co.id/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Otten\Bundle\ValidationBundle\Form\Type;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class RecaptchaType extends AbstractType
{
    protected $siteKey;
    protected $enabled;

    public function __construct($enabled, $siteKey)
    {
        $this->enabled = $enabled;
        $this->siteKey = $siteKey;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['site_key'] = $this->siteKey;
        $view->vars['enabled'] = $this->enabled;
        $view->vars['url_challenge'] = '//www.google.com/recaptcha/api.js';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'options' => [
                    'theme' => 'light',
                    'type' => 'image',
                    'size' => 'normal',
                    'expiredCallback' => null,
                    'defer' => true,
                    'async' => true,
                ],
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        // BC for Symfony < 2.8
        if (Kernel::VERSION_ID < 20800) {
            return 'text';
        } else {
            return 'Symfony\Component\Form\Extension\Core\Type\TextType';
        }
    }

    /**
     * BC for SF < 3.0.
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'otten_recaptcha';
    }
}
