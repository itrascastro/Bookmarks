<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'user\index\index' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/user/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'user\index\add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/user/add/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'     => 'add',
                    ),
                ),
            ),
            'user\index\addDo' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/user/add-do/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'     => 'addDo',
                    ),
                ),
            ),
            'user\index\delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/user/delete/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'user\index\update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/user/update/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'     => 'update',
                    ),
                ),
            ),
            'user\index\updateDo' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/user/update-do/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action'     => 'updateDo',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'UserDao' => 'User\Model\Factory\UserDaoFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            //'User\Controller\Index' => 'User\Controller\IndexController'
        ),
        'factories' => array(
            'User\Controller\Index' => 'User\Controller\Factory\IndexControllerFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'        => __DIR__ . '/../view/layout/layout.phtml',
            'user/index/index'     => __DIR__ . '/../view/user/index/index.phtml',
            'error/404'            => __DIR__ . '/../view/error/404.phtml',
            'error/index'          => __DIR__ . '/../view/error/index.phtml',
            'partial/form'         => __DIR__ . '/../view/partial/newUserForm.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
