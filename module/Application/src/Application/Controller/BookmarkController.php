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


use Application\Model\BookmarkDao;
use Application\Model\TagDao;
use Zend\Mvc\Controller\AbstractActionController;

class BookmarkController extends AbstractActionController
{
    /**
     * @var BookmarkDao
     */
    private $bookmarkDao;

    /**
     * @var TagDao
     */
    private $tagDao;

    /**
     * @param BookmarkDao $bookmarkDao
     * @param TagDao      $tagDao
     */
    function __construct(BookmarkDao $bookmarkDao, TagDao $tagDao)
    {
        $this->bookmarkDao = $bookmarkDao;
        $this->tagDao = $tagDao;
    }

    /**
     * indexAction
     *
     * We need to copy $bookmarks ResultSet into an Array because we cannot iterate a ResultSet twice
     * ResulSet does not allow rewind
     *
     * @return array
     */
    public function indexAction()
    {
        $bookmarks = $this->bookmarkDao->findAll();

        foreach ($bookmarks as $b) {
            $tags = $this->tagDao->getTagsByBookmarkId($b->getId());
            $b->tags = $tags;
            $bookmarksArray[] = $b;
        }

        return [
            'bookmarks' => $bookmarksArray,
        ];
    }

    public function infoAction()
    {
        $id = $this->params()->fromRoute('id');
        $bookmark = $this->bookmarkDao->getById($id);

        return ['bookmark' => $bookmark];
    }

    public function addBookmarkAction()
    {
        return new ViewbookmarkDao(['title' => 'Add Bookmark']);
    }

    public function addDoBookmark()
    {
        $data = $this->params()->fromPost();
        $this->bookmarkDao->save($data);

        $this->redirect()->toUrl('application\bookmark\index');
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $this->bookmarkDao->delete($id);

        $this->redirect()->toUrl('application\bookmark\index');
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute('id');
        $bookmark = $this->bookmarkDao->getById($id);

        return ['bookmark' => $bookmark];
    }

    public function updateDoAction()
    {
        $data = $this->params()->fromPost();
        $this->bookmarkDao->update($data);

        $this->redirect()->toUrl('application\bookmark\index');
    }
}