<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticleTest\Model
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoArticleTest\Model;

use UthandoArticle\Model\ArticleModel as ArticleModel;
use UthandoArticleTest\Framework\TestCase;

class ArticleModelTest extends TestCase
{
    /**
     * @var ArticleModel
     */
    protected $model;

    public function setUp()
    {
        parent::setUp();
        $this->model = new ArticleModel();
    }

    public function testSetGetId()
    {
        $this->model->setArticleId(1);
        $this->assertSame(1, $this->model->getArticleId());
    }

    public function testSetGetTitle()
    {
        $this->model->setTitle('This is a title');
        $this->assertSame('This is a title', $this->model->getTitle());
    }

    public function testSetGetSlug()
    {
        $this->model->setSlug('this-is-a-slug');
        $this->assertSame('this-is-a-slug', $this->model->getSlug());
    }

    public function testSetGetContent()
    {
        $this->model->setContent('some content');
        $this->assertSame('some content', $this->model->getContent());
    }

    public function testSetGetDescription()
    {
        $this->model->setDescription('this is a description');
        $this->assertSame('this is a description', $this->model->getDescription());
    }

    public function testSetGetPageHits()
    {
        $this->model->setPageHits(54);
        $this->assertSame(54, $this->model->getPageHits());
    }
}