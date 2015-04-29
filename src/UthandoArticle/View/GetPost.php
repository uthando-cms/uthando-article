<?php

namespace UthandoArticle\View;

use UthandoCommon\View\AbstractViewHelper;

class GetPost extends AbstractViewHelper
{
    public function __invoke($slug)
    {
        /* @var $service \UthandoArticle\Service\Article */
        $service = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoServiceManager')
             ->get('UthandoArticle');
        
        $model = $service->getArticleBySlug($slug);
        
        return $model;
    }
}