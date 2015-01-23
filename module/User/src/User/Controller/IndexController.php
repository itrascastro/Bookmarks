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


use User\Model\UserDao;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    /**
     * @var UserDao
     */
    private $model;

    /**
     * @param UserDao $model
     */
    function __construct(UserDao $model)
    {
        $this->model = $model;
    }

    public function indexAction()
    {
        $users = $this->model->findAll();

        return ['users' => $users];
    }
}