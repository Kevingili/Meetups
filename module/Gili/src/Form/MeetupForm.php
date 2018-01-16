<?php

declare(strict_types=1);

namespace Gili\Form;

use Gili\Entity\Meetup;
use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Callback;
use Zend\Validator\StringLength;
use Zend\Validator\Date;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct('meetup');

        $hydrator = new DoctrineHydrator($entityManager, Meetup::class);
        $this->setHydrator($hydrator);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'date_begin',
            'options' => [
                'label' => 'Date Begin',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'date_end',
            'options' => [
                'label' => 'Date End',
            ],
        ]);

        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 45,
                        ],
                    ],
                ],
            ],
            'date_begin' => [
                'validators' => [
                    [
                        'name' => Date::class,
                    ],
                    [
                        'name' => Callback::class,
                        'options' => [
                            'callback' => function($value, $context) {
                                return strtotime($context['date_end']) > strtotime($context['date_begin']);
                            },
                        ],
                    ]
                ],
            ],
            'date_end' => [
                'validators' => [
                    [
                        'name' => Date::class,
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 500,
                        ],
                    ],
                ],
            ],
        ];
    }
}
