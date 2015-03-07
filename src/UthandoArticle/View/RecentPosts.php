<?php

namespace UthandoArticle\View;

use UthandoCommon\View\AbstractViewHelper;

class RecentPosts extends AbstractViewHelper
{
    public function __invoke($number)
    {
        $service = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('UthandoServiceManager')
             ->get('UthandoArticle');
        
        $models = $service->getRecentPosts($number);
        
        return $models;
    }
}