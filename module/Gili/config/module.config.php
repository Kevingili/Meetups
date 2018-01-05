<?php

declare(strict_types=1);

use Gili\Form\MeetupForm;
use Gili\Form\MeetupFormFactory;
use Zend\Router\Http\Literal;
use Gili\Controller;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'meetups' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetups',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/new',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/edit/:params',
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/delete/:params',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupForm::class => MeetupFormFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'gili/index/index' => __DIR__ . '/../view/gili/index/index.phtml',
            'gili/index/add' => __DIR__ . '/../view/gili/index/add.phtml',
            'gili/index/edit' => __DIR__ . '/../view/gili/index/edit.phtml',
            'gili/index/delete' => __DIR__ . '/../view/gili/index/delete.phtml',
        ],
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'gili_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Entity/',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `application_driver` for any entity under namespace `Application\Entity`
                    'Gili\Entity' => 'gili_driver',
                ],
            ],
        ],
    ],
];
