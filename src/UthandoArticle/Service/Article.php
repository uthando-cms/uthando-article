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
use UthandoCommon\Mapper\AbstractNestedSet;
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
            'pre.form'
        ], [$this, 'setSlug']);

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
    public function setSlug(Event $e)
    {
        $data = $e->getParam('data');

        if (null === $data) {
            return;
        }

        if ($data instanceof ArticleModel) {
            $data->setSlug($data->getTitle());
        } elseif (is_array($data)) {
            $data['slug'] = $data['slug'];
        }

        $e->setParam('data', $data);
    }

    /**
     * @param Event $e
     */
    public function setValidation(Event $e)
    {
        $form = $e->getParam('form');
        $model = $e->getParam('model');
        $post = $e->getParam('post');

        if ($model instanceof ArticleModel) {
            $model->setDateModified();
        }

        $form->setValidationGroup([
            'articleId', 'userId', 'title', 'slug',
            'content', 'description', 'resource',
            'image', 'lead', 'layout',
        ]);
    }

    /**
     * @param Event $e
     */
    public function updateMenu(Event $e)
    {
        $saved = $e->getParam('saved');
        $post = $e->getParam('post');
        $service = $e->getTarget();

        if ($saved) {
            $article = $e->getParam('form')->getData();

            if ($post['menuInsertType'] !== AbstractNestedSet::INSERT_NO) {
                $ids = explode('-', $post['position']);
                $data = [
                    'menuId' => $ids[0],
                    'label' => $article->getTitle(),
                    'position' => $post['position'],
                    'params' => 'params.slug=' . $article->getSlug(),
                    'route' => 'article',
                    'resource' => '',
                    'visible' => 1,
                    'menuInsertType' => $post['menuInsertType'],
                    'security' => $post['security'],
                ];

                $page = $service->getMenuItemService()->getMenuItemByMenuIdAndLabel($ids[0], $article->getTitle());

                if (!$page) {
                    $result = $service->getMenuItemService()->add($data);
                } else {
                    $service->getMenuItemService()->edit($page, $data);
                }
            }
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
