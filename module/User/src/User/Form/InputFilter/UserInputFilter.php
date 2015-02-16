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

namespace User\Form\InputFilter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\InArray;

class UserInputFilter implements InputFilterAwareInterface
{
    /**
     * @var InputFilterInterface
     */
    private $inputFilter;

    /**
     * @param InputFilterInterface $inputFilter
     */
    function __construct()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add(array(
            'name' => 'id',
            'continue_if_empty' => true,
        ));

        $inputFilter->add(array(
            'name' => 'username',
            'required' => true,
            'filters' => array(
                array('name' => 'Alnum'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Username is required',
                        ),
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'), // clean blank spaces
                array('name' => 'StripTags'), // clean malicious code
                array('name' => 'StringToLower'),
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'messages' => array(
                            'emailAddressInvalidFormat' => 'You entered an invalid email address',
                        ),
                    ),
                ),
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Email address is required',
                        ),
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name' => 'password',
            'required' => true,
            'filters' => array(
                array('name' => 'Alnum'),
            ),
        ));

        $inputFilter->add(array(
            'name' => 'role',
            'required' => true,
            'filters' => array(
                array('name' => 'Alpha'), // only letters
            ),
            'validators' => array(
                array(
                    'name'    => 'InArray',
                    'options' => array(
                        'haystack' => array('user', 'admin'),
                        'strict'   => InArray::COMPARE_STRICT
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name' => 'date',
            'continue_if_empty' => true,
        ));

        $this->inputFilter = $inputFilter;
    }


    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not used');
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}