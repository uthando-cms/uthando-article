<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticle\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoArticle\Mvc\Controller;

use UthandoCommon\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

/**
 * Class ArticleController
 *
 * @package UthandoArticle\Mvc\Controller
 */
class ArticleController extends AbstractCrudController
{
    protected $controllerSearchOverrides = ['sort' => 'articleId'];
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

        if (!$page) {
            $viewModel->setTemplate('uthando-article/article/404');
            return $viewModel;
        } else {
            $layout = ($page->getLayout()) ?: 'uthando-article/article/view';
            $viewModel->setTemplate($layout);
        }

        if (!$this->isAllowed($page->getResource(), null)) {
            throw new \Exception('Not allowed!');
        }

        $this->getService()->addPageHit($page);

        if ($this->params('model') == true) {
            $viewModel->setTemplate('uthando-article/article/model');
        }

        return $viewModel->setVariables(['page' => $page]);
    }
}
