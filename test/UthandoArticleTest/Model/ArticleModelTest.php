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

use UthandoArticle\Model\Article as ArticleModel;
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
}