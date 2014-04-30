<?php

namespace UthandoArticle\Mapper;

use UthandoCommon\Mapper\AbstractMapper;

class Article extends AbstractMapper
{
	protected $table = 'article';
	protected $primary = 'articleId';
	protected $model = 'UthandoArticle\Model\Article';
	protected $hydrator = 'UthandoArticle\Hydrator\Article';
	
	public function getArticleBySlug($slug)
	{
		$select = $this->getSelect()->where(['slug' => $slug]);
		$rowset = $this->fetchResult($select);
		$row = $rowset->current();
		return $row;
	}
}