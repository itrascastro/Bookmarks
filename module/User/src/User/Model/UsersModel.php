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

use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbTableGateway;
use Zend\Paginator\Paginator;

class UsersModel
{
    /**
     * @var TableGateway
     */
    private $tablegateway;

    /**
     * @param TableGateway $tablegateway
     */
    function __construct(TableGateway $tablegateway)
    {
        $this->tablegateway = $tablegateway;
    }


    /**
     * findAll
     *
     * In this approach we are using DbTableGateway adapter which uses the tablegateway to take all the info needed
     *
     * If you need to create your own Select from different tables rather than the tablegateway table, you can use the DbSelect
     * adapter instead: http://framework.zend.com/manual/current/en/tutorials/tutorial.pagination.html#modifying-the-albumtable
     *
     * @param bool $paginated
     * @return \Zend\Db\ResultSet\ResultSet|Paginator
     */
    public function findAll($paginated = true)
    {
        return ($paginated) ? new Paginator(new DbTableGateway($this->tablegateway)) : $this->tablegateway->select();
    }

    public function getById($id)
    {
        $resultset = $this->tablegateway->select(['id' => $id]);

        return $resultset->current();
    }

    public function save($data)
    {
        $data['password'] = md5($data['password']);
        $this->tablegateway->insert($data);
    }

    public function delete($id)
    {
        $this->tablegateway->delete(['id' => $id]);
    }

    public function update($data)
    {
        if (!empty($data['password'])) {
            $data['password'] = md5($data['password']);
        } else {
            unset($data['password']);
        }

        $this->tablegateway->update($data, ['id' => $data['id']]);
    }
}