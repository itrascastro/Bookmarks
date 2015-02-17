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


use User\Form\InputFilter\LoginFormInputFilter;
use User\Form\LoginForm;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Zend\View\Model\ViewModel;
use User\Service\AuthenticationStorageService;

class LoginController extends AbstractActionController
{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * @var CredentialTreatmentAdapter
     */
    private $adapter;

    /**
     * @var AuthenticationStorageService
     */
    private $storage;

    /**
     * @param AuthenticationService $authenticationService
     */
    function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService    = $authenticationService;
        $this->adapter                  = $authenticationService->getAdapter();
        $this->storage                  = $authenticationService->getStorage();
    }

    public function loginAction()
    {
        if ($this->identity()) {
            return $this->redirect()->toRoute('user\users\index');
        }

        $this->layout()->title = 'Login';

        $form = new LoginForm();
        $form->get('submit')->setValue('Login');
        $form->setAttribute('action', $this->url()->fromRoute('user\login\doLogin'));

        return [
            'form'      => $form,
            'messages'  => $this->flashMessenger()->getMessages(),
        ];

    }

    public function doLoginAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new LoginForm();
            $inputFilter = new LoginFormInputFilter();
            $form->setInputFilter($inputFilter->getInputFilter());
            $form->setData($request->getPost());
            $messages = '';

            if ($form->isValid()) {
                $data = $form->getData();

                $this->adapter
                    ->setIdentity($data['email'])
                    ->setCredential($data['password'])
                ;

                $result = $this->authenticationService->authenticate();
                $messages = $result->getMessages();

                if ($result->isValid()) {
                    if ($data['rememberme'] == 1 ) {
                        $this->storage->setRememberMe(1);
                        $this->authenticationService->setStorage($this->storage);
                    }

                    $user = $this->adapter->getResultRowObject();
                    $this->storage->write($user);

                    return $this->redirect()->toRoute('user\users\index'); // success
                }
            }

            $form->prepare();

            $this->layout()->title = 'Login - Error - Review your data';

            $view = new ViewModel([
                'form'      => $form,
                'messages'  => $messages,
            ]);
            $view->setTemplate('user/login/login.phtml');

            return $view;
        }

        // trying to access 'user\login\doLogin' directly
        $this->flashMessenger()->addMessage('You must use this form');

        return $this->redirect()->toRoute('user\login\login');
    }

    public function logoutAction()
    {
        $this->storage->forgetMe();
        $this->authenticationService->clearIdentity();
        $this->flashMessenger()->clearCurrentMessages();
        $this->flashMessenger()->addMessage('Logged Out');

        return $this->redirect()->toRoute('user\login\login');
    }
}