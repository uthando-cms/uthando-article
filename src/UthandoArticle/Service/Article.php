<?php

namespace UthandoArticle\Service;

use UthandoArticle\Model\Article as ArticleModel;
use UthandoCommon\Service\AbstractService;
use UthandoCommon\Model\ModelInterface;
use Zend\Form\Form;

class Article extends AbstractService
{	
	/**
	 * @var UthandoNavigation\Service\Page
	 */
	protected $menuItemService;
	
	protected $mapperClass = 'UthandoArticle\Mapper\Article';
	protected $form = 'UthandoArticle\Form\Article';
	protected $inputFilter = 'UthandoArticle\InputFilter\Article';
	
	public function getArticleBySlug($slug)
	{
		$slug = (string) $slug;
		return $this->getMapper()->getArticleBySlug($slug);
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
		
		if ($insertId) {
    		$pageResult = $this->updateMenuItem(
    		    $this->getById($insertId),
    		    $post
    		);
    	}
		
		return $insertId;
	}
	
	/**
     * @param \UthandoArticle\Model\Article $article
     * @param array $post
     * @param \UthandoArticle\Form\Article
     * @return int $result
	 */
	public function edit(ModelInterface $article, array $post, Form $form = null)
	{
		$article->setDateModified();
		$result = parent::edit($article, $post);
		
		// find page first, if exists delete it before updating.
		
		if ($result) {
		    $pageResult = $this->updateMenuItem(
		        $this->getById($article->getArticleId()), $post
	        );
		}
		
		return $result;
	}
	
	protected function updateMenuItem($article, $post)
	{
	    if ($post['position'] && $post['menuInsertType'] != 'noInsert') {
	        $ids = explode('-', $post['position']);
	        $data = array(
	                'menuId' => $ids[0],
	                'label' => $article->getTitle(),
	                'position' => $ids[1],
	                'params' => 'slug=' . $article->getSlug(),
	                'route' => 'article',
	                'resource' => '',
	                'visible' => 1,
	                'menuInsertType' => $post['menuInsertType']
	        );
	         
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
