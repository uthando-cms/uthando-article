<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticle\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoArticle\View;

use UthandoArticle\Service\ArticleService;
use UthandoCommon\Service\ServiceManager;
use UthandoCommon\View\AbstractViewHelper;

/**
 * Class RecentPosts
 *
 * @package UthandoArticle\View
 */
class RecentPosts extends AbstractViewHelper
{
    public function __invoke($number)
    {
        $service = $this->getServiceLocator()
            ->getServiceLocator()
            ->get(ServiceManager::class)
             ->get(ArticleService::class);
        
        $models = $service->getRecentPosts($number);
        
        return $models;
    }
}