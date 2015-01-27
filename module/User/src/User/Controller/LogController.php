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

namespace User\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class LogController extends AbstractActionController
{
    public function inAction()
    {
        if (!$this->getRequest()->isPost()) {
            return [];
        }

        $data = $this->params()->fromPost();
        $email = $data['email'];
        $password = $data['password'];

    }

    public function outAction()
    {

    }
}