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

use User\Form\InputFilter\UserInputFilter;
use User\Form\UserForm;
use User\Model\UsersModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsersController extends AbstractActionController
{
    /**
     * @var UsersModel
     */
    private $model;

    function __construct(UsersModel $model)
    {
        $this->model = $model;
    }

    public function indexAction()
    {
//        if (!$this->identity()) {
//            $this->redirect()->toRoute('user\login\login');
//        }

        $this->layout()->title = 'List Users';
        $users = $this->model->findAll();

        return ['users' => $users];
    }

    public function createAction()
    {
        $this->layout()->title = 'Create User';

        $form = new UserForm();
        $form->get('submit')->setValue('Create New User');
        $form->setAttribute('action', $this->url()->fromRoute('user\users\doCreate'));

        return ['form' => $form, 'isUpdate' => false];
    }

    public function doCreateAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new UserForm();
            $inputFilter = new UserInputFilter();
            $form->setInputFilter($inputFilter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();

                $data['username']   = $formData['username'];
                $data['email']      = $formData['email'];
                $data['password']   = $formData['password'];
                $data['role']       = $formData['role'];
                $data['date']       = date('Y-m-d H:i:s');

                $this->model->save($data);

                $this->redirect()->toRoute('user\users\index');
            }

            $form->prepare();

            $this->layout()->title = 'Create User - Error - Review your data';

            // we reuse the create view
            $view = new ViewModel(['form' => $form, 'isUpdate' => false]);
            $view->setTemplate('user/users/create.phtml');

            return $view;
        }

        $this->redirect()->toRoute('user\users\create');
    }

    public function viewAction()
    {
        $this->layout()->title = 'User Details';

        $id = $this->params()->fromRoute('id');
        $user = $this->model->getById($id);

        return ['user' => $user];
    }

    public function deleteAction()
    {
        $this->model->delete($this->params()->fromRoute('id'));

        $this->redirect()->toRoute('user\users\index');
    }

    public function updateAction()
    {
        $this->layout()->title = 'Update User';

        $user = $this->model->getById($this->params()->fromRoute('id'));

        $form = new UserForm();
        $form->setAttribute('action', $this->url()->fromRoute('user\users\doUpdate'));
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Edit User');

        // we reuse the create view
        $view = new ViewModel(['form' => $form, 'isUpdate' => true]);
        $view->setTemplate('user/users/create.phtml');

        return $view;
    }

    public function doUpdateAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new UserForm();
            $inputFilter = new UserInputFilter();
            $form->setInputFilter($inputFilter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();

                $data['id']         = $formData['id'];
                $data['username']   = $formData['username'];
                $data['email']      = $formData['email'];
                $data['password']   = $formData['password'];
                $data['role']       = $formData['role'];
                $data['date']       = $formData['date']; //date('Y-m-d H:i:s');

                $this->model->update($data);

                return $this->redirect()->toRoute('user\users\index');
            }

            $form->prepare();

            $this->layout()->title = 'Update User - Error - Review your data';

            // we reuse the create view
            $view = new ViewModel(['form' => $form, 'isUpdate' => true]);
            $view->setTemplate('user/users/create.phtml');

            return $view;
        }

        $this->redirect()->toRoute('user\users\index');
    }

    public function forbiddenAction()
    {
        return [];
    }
}

