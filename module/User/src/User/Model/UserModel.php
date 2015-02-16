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

namespace User\Model;


class UserModel
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $date;

    function __construct($id = null, $username = null, $email = null, $password = null, $role = null, $date = null)
    {
        $this->id           = $id;
        $this->username     = $username;
        $this->email        = $email;
        $this->password     = $password;
        $this->role         = $role;
        $this->date         = $date;
    }

    public function exchangeArray($data)
    {
        $this->id           = (!empty($data['id'])) ? $data['id'] : null;
        $this->username     = (!empty($data['username'])) ? $data['username'] : null;
        $this->email        = (!empty($data['email'])) ? $data['email'] : null;
        $this->password     = (!empty($data['password'])) ? $data['password'] : null;
        $this->role         = (!empty($data['role'])) ? $data['role'] : null;
        $this->date         = (!empty($data['date'])) ? $data['date'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}