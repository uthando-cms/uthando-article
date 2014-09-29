<?php

namespace UthandoArticle\Mapper;

use UthandoCommon\Mapper\AbstractDbMapper;

class Article extends AbstractDbMapper
{
	protected $table = 'article';
	protected $primary = 'articleId';
	
	public function getArticleBySlug($slug)
	{
		$select = $this->getSelect()->where(['slug' => $slug]);
		$rowSet = $this->fetchResult($select);
		$row = $rowSet->current();
		return $row;
	}
}