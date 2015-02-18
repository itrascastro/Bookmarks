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

namespace User\Form\Factory;


use User\Form\InputFilter\LoginFormInputFilter;
use User\Form\LoginForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginFormFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return LoginForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new LoginForm();
        $inputFilter = new LoginFormInputFilter();
        $form->setInputFilter($inputFilter->getInputFilter());

        return $form;
    }
}