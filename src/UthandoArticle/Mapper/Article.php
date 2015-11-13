<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticle\Mapper
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoArticle\Mapper;

use UthandoCommon\Mapper\AbstractDbMapper;

/**
 * Class Article
 *
 * @package UthandoArticle\Mapper
 */
class Article extends AbstractDbMapper
{
    protected $table = 'article';
    protected $primary = 'articleId';

    /**
     * @param string $slug
     * @return \UthandoArticle\Model\Article
     */
    public function getArticleBySlug($slug)
    {
        $select = $this->getSelect()->where(['slug' => $slug]);
        $rowSet = $this->fetchResult($select);
        $row = $rowSet->current();
        return $row;
    }

    /**
     * @param $limit
     * @return \Zend\Db\ResultSet\HydratingResultSet|\Zend\Db\ResultSet\ResultSet|\Zend\Paginator\Paginator
     */
    public function getArticlesByDate($limit)
    {
        $select = $this->getSelect();
        $select = $this->setLimit($select, $limit, 0);
        $select = $this->setSortOrder($select, '-dateCreated');

        $rowSet = $this->fetchResult($select);

        return $rowSet;
    }
}