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


    public function findAll()
    {
        return $this->tablegateway->select();
    }

    public function getById($id)
    {
        $resultset = $this->tablegateway->select(['id' => $id]);

        return $resultset->current();
    }

    public function save($data)
    {
        $this->tablegateway->insert($data);
    }

    public function delete($id)
    {
        $this->tablegateway->delete(['id' => $id]);
    }

    public function update($data)
    {
        $this->tablegateway->update($data, ['id' => $data['id']]);
    }
}