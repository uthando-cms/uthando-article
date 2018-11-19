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

use UthandoArticle\Form\ArticleForm;
use UthandoArticle\Hydrator\ArticleHydrator;
use UthandoArticle\InputFilter\ArticleInputFilter;
use UthandoArticle\Mapper\ArticleMapper;
use UthandoArticle\Model\ArticleModel;
use UthandoCommon\Mapper\AbstractNestedSet;
use UthandoCommon\Service\AbstractRelationalMapperService;
use UthandoNavigation\Service\MenuItemService;
use UthandoUser\Service\UserService;
use Zend\EventManager\Event;

/**
 * Class Article
 *
 * @package UthandoArticle\Service
 */
class ArticleService extends AbstractRelationalMapperService
{
    /**
     * @var \UthandoNavigation\Service\MenuItemService
     */
    protected $menuItemService;

    protected $form         = ArticleForm::class;
    protected $hydrator     = ArticleHydrator::class;
    protected $inputFilter  = ArticleInputFilter::class;
    protected $mapper       = ArticleMapper::class;
    protected $model        = ArticleModel::class;

    /**
     * @var array
     */
    protected $referenceMap = [
        'user' => [
            'refCol' => 'userId',
            'service' => UserService::class,
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
        /* @var $mapper ArticleModel */
        $mapper = $this->getMapper();
        return $mapper->getArticlesByDate($limit);
    }

    /**
     * @return \UthandoNavigation\Service\MenuItemService
     */
    protected function getMenuItemService()
    {
        if (!$this->menuItemService) {
            $sl = $this->getServiceLocator();
            $this->menuItemService = $sl->get(MenuItemService::class);
        }

        return $this->menuItemService;
    }
}
