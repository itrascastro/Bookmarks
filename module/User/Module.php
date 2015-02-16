<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'routeHandler'), -100);
    }

    public function routeHandler(MvcEvent $event)
    {
        $match = $event->getRouteMatch();

        if (!$match) { // we need a route
            return;
        }

        $controller     = $match->getParam('controller');
        $action         = $match->getParam('action');
        $roles          = $match->getParam('roles');

        $sm = $event->getApplication()->getServiceManager();
        $authenticationService = $sm->get('User\Service\Authentication');

        $role = ($identity = $authenticationService->getIdentity()) ? $identity->role : 'guest';

        if (!empty($roles) && !in_array($role, $roles)) {
            $response = $event->getResponse();
            $response->setStatusCode(401); // Auth required
            $match->setParam('controller', 'User\Controller\Users');
            $match->setParam('action', 'forbidden');
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
