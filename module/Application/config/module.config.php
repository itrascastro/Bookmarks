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
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'application\tag\index' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/tags/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tag',
                        'action'     => 'index',
                    ),
                ),
            ),
            'application\tag\add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/tag/add/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tag',
                        'action'     => 'add',
                    ),
                ),
            ),
            'application\tag\addDo' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/tag/add-do/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tag',
                        'action'     => 'addDo',
                    ),
                ),
            ),
            'application\tag\delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/tag/delete/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tag',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'application\tag\update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/tag/update/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tag',
                        'action'     => 'update',
                    ),
                ),
            ),
            'application\tag\updateDo' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/tag/update-do/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tag',
                        'action'     => 'updateDo',
                    ),
                ),
            ),
            'application\tag\tags' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/tags/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Tag',
                        'action'     => 'users',
                    ),
                ),
            ),
            'application\bookmark\index' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/bookmarks/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Bookmark',
                        'action'     => 'index',
                    ),
                ),
            ),
            'application\bookmark\addBookmark' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/bookmarks/add/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Bookmark',
                        'action'     => 'addBookmark',
                    ),
                ),
            ),
            'application\bookmark\info' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/bookmarks/info/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Bookmark',
                        'action'     => 'info',
                    ),
                ),
            ),
            'application\bookmark\update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/bookmarks/update/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Bookmark',
                        'action'     => 'update',
                    ),
                ),
            ),
            'application\bookmark\delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/bookmarks/delete/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Bookmark',
                        'action'     => 'delete',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'TagDao'    => 'Application\Model\Factory\TagDaoFactory',
            'Application\Model\BookmarkDao' => 'Application\Model\Factory\BookmarkDaoFactory',
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
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
        'factories' => array(
            'Application\Controller\Tag' => 'Application\Controller\Factory\TagControllerFactory',
            'Application\Controller\Bookmark' => 'Application\Controller\Factory\BookmarkControllerFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
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
