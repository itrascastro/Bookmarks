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

namespace Application\Controller;


use Application\Model\TagDao;
use Zend\Mvc\Controller\AbstractActionController;

class TagController extends AbstractActionController
{
    /**
     * @var TagDao
     */
    private $model;

    function __construct(TagDao $model)
    {
        $this->model = $model;
    }

    public function indexAction()
    {
        $tags = $this->model->getTagsByBookmarkId(1);

        foreach ($tags as $tag) {
            echo $tag->getName() . '<br>';
        }

        $tags = $this->model->findAll();

        return ['tags' => $tags];
    }

    public function tagsByBookmarkIdAction()
    {
        $tags = $this->model->getTagsByBookmarkId(1);
    }

}