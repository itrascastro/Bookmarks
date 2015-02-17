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

namespace User\Form;


use Zend\Form\Form;

class LoginForm extends Form
{
    function __construct($name = null)
    {
        parent::__construct();

        $this->setName('User');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-signin');

        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'attributes' => array(
                'class'         => 'form-control',
                'required'      => 'required',
                'autofocus'     => 'autofocus',
                'placeholder'   => 'Email',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'attributes' => array(
                'class'         => 'form-control',
                'required'      => 'required',
                'placeholder'   => 'Password',
            ),
        ));

        $this->add(array(
            'name' => 'rememberme',
            'type' => 'Checkbox',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'id' => 'submitbutton',
                'class' => 'btn btn-lg btn-primary btn-block',
            ),
        ));
    }
}