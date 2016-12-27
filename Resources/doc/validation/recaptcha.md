# Step2: Setup ReCaptcha Validation

## Config
Add the following to your config.
```yml
# app/config/config.yml
otten_validation:
    recaptcha:
        enabled: true #default true
        site_key: "your_recaptcha_site_key"
        secret_key: "your_recaptcha_secret_key"
```

## Usage
add `HasRecaptcha` trait to entity.
```php
// src/AppBundle/Entity/Task.php
namespace AppBundle\Entity;

use Otten\Bundle\ValidationBundle\Entity\Traits\HasRecaptcha;

class Task
{
    use HasRecaptcha;

    protected $task;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }
}
```

When creating a new form class add the following line to create the field:

```php
<?php

use Otten\Bundle\RecaptchaBundle\Form\Type\RecaptchaType;

public function buildForm(FormBuilder $builder, array $options)
{
    // Symfony >= 2.8
    $builder->add('recaptcha', RecaptchaType::class);
    // Symfony 2.7
    // $builder->add('recaptcha', 'otten_recaptcha');
}
```

you can pass extra options to recaptcha
```php
<?php

use Otten\Bundle\RecaptchaBundle\Form\Type\RecaptchaType;

public function buildForm(FormBuilder $builder, array $options)
{
    $builder->add('recaptcha', RecaptchaType::class, [
        'attr' => [
            'options' => [
                'theme' => 'light', // available value 'light', 'dark'. default value 'light'
                'type'  => 'image', // available value 'image', 'audio'. default value 'image'
                'size'  => 'normal', // available value 'normal', 'compact'. default value 'normal'
                'defer' => true,
                'async' => true,
            ],
        ],
    ]);
}
```
