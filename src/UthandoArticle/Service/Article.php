<?php

namespace UthandoArticle\Service;

use UthandoArticle\Model\Article as ArticleModel;
use UthandoCommon\Model\ModelInterface;
use UthandoCommon\Service\AbstractRelationalMapperService;
use Zend\Form\Form;

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
        'user'  => [
            'refCol'    => 'userId',
            'service'   => 'UthandoUser\Service\User',
        ],
    ];

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
	
	public function getArticleBySlug($slug)
	{
		$slug = (string) $slug;
        $article = $this->getMapper()->getArticleBySlug($slug);

        $this->populate($article, true);

        return $article;
	}
	
	public function addPageHit(ArticleModel $article)
	{
		$pageHits = $article->getPageHits();
		$pageHits++;
		$article->setPageHits($pageHits);
		$this->save($article);
	}
	
	public function add(array $post, Form $form = null)
	{
		if (!$post['slug']) {
			$post['slug'] = $post['title'];
		}
		
		$insertId = parent::add($post);
		
		if (!$insertId instanceof Form) {
    		$pageResult = $this->updateMenuItem(
    		    $this->getById($insertId),
    		    $post
    		);
    	}
		
		return $insertId;
	}

    /**
     * @param ModelInterface $article
     * @param array $post
     * @param Form $form
     * @return int
     */
	public function edit(ModelInterface $article, array $post, Form $form = null)
	{
		$article->setDateModified();
		$result = parent::edit($article, $post);
		
		// find page first, if exists delete it before updating.
		
		if (!$result instanceof Form) {
		    $pageResult = $this->updateMenuItem(
		        $this->getById($article->getArticleId()), $post
	        );
		}
		
		return $result;
	}
	
	/**
	 * @param int $limit
	 * @return Ambigous <\Zend\Db\ResultSet\HydratingResultSet, \Zend\Db\ResultSet\ResultSet, \Zend\Paginator\Paginator>
	 */
	public function getRecentPosts($limit)
	{
	    $limit = (int) $limit;
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
			$this->menuItemService = $sl->get('UthandoNavigation\Service\MenuItem');
		}
		
		return $this->menuItemService;
	}
}
