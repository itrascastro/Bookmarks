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
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class TagDao implements CrudInterface
{
    private $table;

    function __construct(TableGateway $table)
    {
        $this->table = $table;
    }

    public function findAll()
    {
        return $this->table->select();
    }

    public function getById($id)
    {
        $rowset = $this->table->select(['id' => $id]);

        return $rowset->current();
    }

    /*
     * SELECT
	 *  t.name
     * FROM
	 *  Tags_Bookmark tb
	 *  INNER JOIN Tags t
	 *      ON tb.tagsId = t.id
     * WHERE
	 *  bookmarkId = ?
     */
    public function getTagsByBookmarkId($id)
    {
        $select = new Select();
        $select->from(['t' => 'Tags']);
        $select->columns(['name']);
        $select->join(['tb' => 'Tags_Bookmark'], 'tb.tagsId = t.id');
        $select->where('tb.bookmarkId = ' . $id);

        return $this->table->selectWith($select);
    }

    public function delete($id)
    {
        $this->table->delete(['id' => $id]);
    }

    public function save($data)
    {
        $this->table->insert($data);
    }

    public function update($data)
    {
        $this->table->update($data, ['id' => $data['id']]);
    }
}