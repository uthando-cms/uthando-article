<?php
namespace UthandoArticle\Hydrator;

use UthandoCommon\Hydrator\AbstractHydrator;
use UthandoCommon\Hydrator\Strategy\DateTime as DateTimeStrategy;

class Article extends AbstractHydrator
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
     * @param $object \UthandoArticle\Model\Article
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
            'dateCreated'   => $this->extractValue('dateCreated', $object->getDateCreated()),
            'dateModified'  => $this->extractValue('dateModified', $object->getDateModified())
        ];
    }
}
