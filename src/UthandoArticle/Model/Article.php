<?php

namespace UthandoArticle\Model;

use UthandoCommon\Model\DateCreatedTrait;
use UthandoCommon\Model\DateModifiedTrait;
use UthandoCommon\Model\Model;
use UthandoCommon\Model\ModelInterface;

class Article implements ModelInterface
{
    use Model,
        DateCreatedTrait,
        DateModifiedTrait;
    
	/**
	 * @var int
	 */
	protected $articleId;
	
	/**
	 * @var string
	 */
	protected $title;
	
	/**
	 * @var string
	 */
	protected $slug;
	
	/**
	 * @var string
	 */
	protected $content;
	
	/**
	 * @var string
	 */
	protected $description;
	
	/**
	 * @var int
	 */
	protected $pageHits = 0;

    /**
     * @return int
     */
	public function getArticleId()
	{
		return $this->articleId;
	}

    /**
     * @param $articleId
     * @return $this
     */
	public function setArticleId($articleId)
	{
		$this->articleId = $articleId;
		return $this;
	}

    /**
     * @return string
     */
	public function getTitle()
	{
		return $this->title;
	}

    /**
     * @param $title
     * @return $this
     */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

    /**
     * @return string
     */
	public function getSlug()
	{
		return $this->slug;
	}

    /**
     * @param $slug
     * @return $this
     */
	public function setSlug($slug)
	{
		$this->slug = $slug;
		return $this;
	}

    /**
     * @return string
     */
	public function getContent()
	{
		return $this->content;
	}

    /**
     * @param $content
     * @return $this
     */
	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}

    /**
     * @return string
     */
	public function getDescription()
	{
		return $this->description;
	}

    /**
     * @param $description
     * @return $this
     */
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

    /**
     * @return int
     */
	public function getPageHits()
	{
		return $this->pageHits;
	}

    /**
     * @param $pageHits
     * @return $this
     */
	public function setPageHits($pageHits)
	{
		$this->pageHits = $pageHits;
		return $this;
	}
}
