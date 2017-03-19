<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticle\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoArticle\Service;

use UthandoArticle\Model\Article as ArticleModel;
use UthandoCommon\Model\ModelInterface;
use UthandoCommon\Service\AbstractRelationalMapperService;
use Zend\EventManager\Event;
use Zend\Form\Form;

/**
 * Class Article
 *
 * @package UthandoArticle\Service
 */
class Article extends AbstractRelationalMapperService
{
    /**
     * @var \UthandoNavigation\Service\MenuItem
     */
    protected $menuItemService;

    /**
     * @var string
     */
    protected $serviceAlias = 'UthandoArticle';

    /**
     * @var array
     */
    protected $referenceMap = [
        'user' => [
            'refCol' => 'userId',
            'service' => 'UthandoUser',
        ],
    ];

    /**
     * (non-PHPdoc)
     * @see \UthandoCommon\Service\AbstractService::attachEvents()
     */
    public function attachEvents()
    {
        $this->getEventManager()->attach([
            'pre.add', 'pre.edit'
        ], [$this, 'setValidation']);

        $this->getEventManager()->attach([
            'post.add', 'post.edit'
        ], [$this, 'updateMenu']);
    }

    /**
     * @param Event $e
     */
    public function setValidation(Event $e)
    {
        $form = $e->getParam('form');
        $model = $e->getParam('model');
        $post = $e->getParam('post');

        if (!$post['slug']) {
            $post['slug'] = $post['title'];
        }

        $e->setParam('post', $post);

        $form->setValidationGroup([
            'articleId', 'userId', 'title', 'slug',
            'content', 'description', 'resource',
            'image', 'lead', 'layout',
        ]);

        $model->setDateModified();
    }

    /**
     * @param Event $e
     */
    public function updateMenu(Event $e)
    {
        $saved = $e->getParam('saved');
        $post = $e->getParam('post');

        if ($saved) {
            $model = $e->getParam('form')->getData();
            /*$pageResult = $this->updateMenuItem(
                $this->getById($model->getId()),
                $post
            );*/
        }
    }

    /**
     * @param int $id
     * @param null $col
     * @return array|mixed|\UthandoCommon\Model\ModelInterface
     */
    public function getById($id, $col = null)
    {
        $article = parent::getById($id, $col);
        $this->populate($article, true);

        return $article;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getArticleBySlug($slug)
    {
        $slug = (string)$slug;
        $article = $this->getMapper()->getArticleBySlug($slug);

        if ($article) {
            $this->populate($article, true);
        }

        return $article;
    }

    /**
     * @param ArticleModel $article
     */
    public function addPageHit(ArticleModel $article)
    {
        $pageHits = $article->getPageHits();
        $pageHits++;
        $article->setPageHits($pageHits);
        $this->save($article);
    }

    /**
     * @param $limit
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
    public function getRecentPosts($limit)
    {
        $limit = (int)$limit;
        /* @var $mapper \UthandoArticle\Mapper\Article */
        $mapper = $this->getMapper();
        return $mapper->getArticlesByDate($limit);
    }

    /**
     * @param $article
     * @param $post
     * @throws \Exception
     */
    protected function updateMenuItem($article, $post)
    {
        if ($post['position'] && $post['menuInsertType'] != 'noInsert') {
            $ids = explode('-', $post['position']);
            $data = [
                'menuId' => $ids[0],
                'label' => $article->getTitle(),
                'position' => $ids[1],
                'params' => 'params.slug=' . $article->getSlug(),
                'route' => 'article',
                'resource' => '',
                'visible' => 1,
                'menuInsertType' => $post['menuInsertType']
            ];

            $page = $this->getMenuItemService()->getMenuItemByMenuIdAndLabel($ids[0], $article->getTitle());

            if (!$page) {
                $this->getMenuItemService()->add($data);
            } else {
                $this->getMenuItemService()->edit($page, $data);
            }
        }
    }

    /**
     * @return \UthandoNavigation\Service\MenuItem
     */
    protected function getMenuItemService()
    {
        if (!$this->menuItemService) {
            $sl = $this->getServiceLocator();
            $this->menuItemService = $sl->get('UthandoNavigationMenuItem');
        }

        return $this->menuItemService;
    }
}
