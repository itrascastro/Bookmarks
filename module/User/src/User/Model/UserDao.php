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


use Zend\Db\Adapter\Adapter;

class UserDao
{
    /**
     * @var Adapter
     */
    private $db;

    function __construct(Adapter $db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $rowset = $this->db->query('SELECT * FROM User', Adapter::QUERY_MODE_EXECUTE);

        $users = new \ArrayObject();

        $count = $rowset->count();

        for ($i=0; $i < $count; $i++) {
            $row = $rowset->current();
            $user = new User($row->id, $row->email, $row->password, $row->role, $row->date);
            $users->append($user);
            $rowset->next();
        }

        return $users;
    }

    public function getById($id)
    {
        $stm = $this->db->createStatement('SELECT * FROM User WHERE id = ?');
        $rowset = $stm->execute(array($id));
        $row = $rowset->current();

        return new User($row['id'], $row['email'], $row['password'], $row['role'], $row['date']);
    }

    public function save($data)
    {
        $stm = $this->db->createStatement('INSERT INTO User (email, password, role) VALUES (?, ?, ?)');
        $stm->execute(array($data['email'], $data['password'], $data['role']));
    }

    public function delete($id)
    {
        $stm = $this->db->createStatement('DELETE FROM User WHERE id = ?');
        $stm->execute(array($id));
    }

    public function update($data)
    {
        $stm = $this->db->createStatement('UPDATE User SET email = ?, password = ?, role = ? WHERE id = ?');
        $stm->execute(array($data['email'], $data['password'], $data['role'], $data['id']));
    }

}