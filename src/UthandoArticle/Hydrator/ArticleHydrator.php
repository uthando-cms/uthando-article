<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticle\Hydrator
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoArticle\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;
use UthandoCommon\Hydrator\Strategy\DateTime as DateTimeStrategy;

/**
 * Class Article
 *
 * @package UthandoArticle\Hydrator
 */
class ArticleHydrator extends AbstractHydrator
{

    public function __construct()
    {
        parent::__construct();
        
        $dateTime = new DateTimeStrategy();
        
        $this->addStrategy('dateCreated', $dateTime);
        $this->addStrategy('dateModified', $dateTime);
        
        return $this;
    }

    /**
     *
     * @param $object \UthandoArticle\Model\ArticleModel
     * @return array
     */
    public function extract($object)
    {
        return [
            'articleId'     => $object->getArticleId(),
            'userId'        => $object->getUserId(),
            'title'         => $object->getTitle(),
            'slug'          => $object->getSlug(),
            'content'       => $object->getContent(),
            'description'   => $object->getDescription(),
            'resource'      => $object->getResource(),
            'pageHits'      => $object->getPageHits(),
            'image'         => $object->getImage(),
            'layout'        => $object->getLayout(),
            'lead'          => $object->getLead(),
            'dateCreated'   => $this->extractValue('dateCreated', $object->getDateCreated()),
            'dateModified'  => $this->extractValue('dateModified', $object->getDateModified())
        ];
    }
}
