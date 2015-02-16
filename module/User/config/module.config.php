<?php
return array(
    'router' => array(
        'routes' => array(
            'user\users\index' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/users/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'index',
                    ),
                ),
            ),
            'user\users\view' => array(
                'type'              => 'Segment',
                'options'           => array(
                    'route'         => '/admin/users/view/id/[:id]/',
                    'constraints'   => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'view',
                    ),
                ),
            ),
            'user\users\create' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/users/create/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'create',
                    ),
                ),
            ),
            'user\users\doCreate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/users/do-create/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'doCreate',
                    ),
                ),
            ),
            'user\users\delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/users/delete/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'user\users\update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/users/update/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'update',
                    ),
                ),
            ),
            'user\users\doUpdate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/users/do-update/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'doUpdate',
                    ),
                ),
            ),
            'user\login\login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/login/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Login',
                        'action'     => 'login',
                    ),
                ),
            ),
            'user\login\doLogin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/doLogin/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Login',
                        'action'     => 'doLogin',
                    ),
                ),
            ),
            'user\login\logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/logout/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Login',
                        'action'     => 'logout',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            'Zend\Authentication\AuthenticationService' => 'User\Service\Authentication', // needed for identity plugin
        ),
        'factories' => array(
            'User\Model\UsersModel'                 => 'User\Model\Factory\UsersModelFactory',
            'User\Service\AuthenticationStorage'    => 'User\Service\Factory\AuthenticationStorageServiceFactory',
            'User\Service\Authentication'           => 'User\Service\Factory\AuthenticationServiceFactory',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'User\Controller\Users' => 'User\Controller\Factory\UsersControllerFactory',
            'User\Controller\Login' => 'User\Controller\Factory\LoginControllerFactory',
        ),
    ),
    'view_manager' => array(
        'template_map'              => array(
        ),
        'template_path_stack'       => array(
            __DIR__ . '/../view',
        ),
    ),
);