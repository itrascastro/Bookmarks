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

namespace Application\Model;


use Application\Model\Interfaces\CrudInterface;
use Zend\Db\TableGateway\TableGateway;

class BookmarkDao implements CrudInterface
{
    /**
     * @var TableGateway
     */
    private $tableGateway;

    /**
     * @param TableGateway $tableGateway
     */
    function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll()
    {
        return $this->tableGateway->select();
    }

    public function getById($id)
    {
        $dataset = $this->tableGateway->select(['id' => $id]);

        return $dataset->current();
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }

    public function save($data)
    {
        $this->tableGateway->insert($data);
    }

    public function update($data)
    {
        $this->tableGateway->update($data, ['id' => $data['id']]);
    }
}