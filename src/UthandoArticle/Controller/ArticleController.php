<?php

namespace UthandoArticle\Controller;

use UthandoCommon\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractCrudController
{
    protected $controllerSearchOverrides = array('sort' => 'articleId');
    protected $serviceName = 'UthandoArticle\Service\Article';
    protected $route = 'admin/article';
    
    public function viewAction()
    {
        $slug = $this->params()->fromRoute('slug');
        $page = $this->getService()->getArticleBySlug($slug);

        if (!$this->isAllowed($page->getResource())) {
            throw new \Exception('Not allowed!');
        }
        
        if (!$page) {
            $model = new ViewModel();
            $model->setTemplate('article/article/404');
            return $model;
        }
        
        $this->getService()->addPageHit($page);
        
        return ['page' => $page];
    }
}
