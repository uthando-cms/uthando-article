<?php

namespace UthandoArticle\Controller;

use UthandoCommon\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractCrudController
{
    protected $controllerSearchOverrides = array('sort' => 'articleId');
    protected $serviceName = 'UthandoArticle';
    protected $route = 'admin/article';
    
    public function viewAction()
    {
        $viewModel = new ViewModel();
        
        if ($this->getRequest()->isXmlHttpRequest()) {
            $viewModel->setTerminal(true);
        }
        
        $slug = $this->params()->fromRoute('slug');
        $page = $this->getService()->getArticleBySlug($slug);

        if (!$this->isAllowed($page->getResource())) {
            throw new \Exception('Not allowed!');
        }
        
        if (!$page) {
            $viewModel->setTemplate('uthando-article/article/404');
            return $viewModel;
        }
        
        $this->getService()->addPageHit($page);
        
        if ($this->params('model') == true) {
            $viewModel->setTemplate('uthando-article/article/model');
        }
        
        return $viewModel->setVariables(['page' => $page]);
    }
}
