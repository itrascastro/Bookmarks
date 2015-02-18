<?php
/**
 * xenFramework (http://xenframework.com/)
 *
 * This file is part of the xenframework package.
 *
 * (c) Ismael Trascastro <itrascastro@xenframework.com>
 *
 * @link        http://github.com/xenframework for the canonical source repository
 * @copyright   Copyright (c) xenFramework. (http://xenframework.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace User\Service\Factory;


use Zend\Permissions\Acl\Acl;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AclServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $acl = new Acl();

        $config = $serviceLocator->get('config');
        $roles = $config['application']['roles'];

        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        $routes = $config['router']['routes'];

        foreach ($routes as $route => $value) {
            $acl->addResource($route);
            $routeRoles = array_key_exists('roles', $value['options']['defaults']) ? $value['options']['defaults']['roles'] : $roles;
            $acl->allow($routeRoles, $route);
        }

        return $acl;
    }
}