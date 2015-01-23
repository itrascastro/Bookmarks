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
use Zend\View\Model\ViewModel;

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

    public function addAction()
    {
        return [array('action' => $this->url('user\index\addDo'), 'id' => null)];
    }

    public function addDoAction()
    {
        $data = $this->params()->fromPost();
        $this->model->save($data);

        $this->redirect()->toRoute('user\index\index');
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $this->model->delete($id);

        $this->redirect()->toRoute('user\index\index');
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute('id');

        $view = new ViewModel();
        $view->setTemplate('user/index/add.phtml');
        //$view->action = $this->url('user\index\index');
        $view->id = $id;

        return $view;
    }

    public function updateDoAction()
    {
        $data = $this->params()->fromPost();
        $this->model->update($data);

        $this->redirect()->toRoute('user\index\index');
    }
}