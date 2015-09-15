<?php

namespace UthandoArticleTest\Framework;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ControllerTestCase extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../TestConfig.php.dist'
        );
        parent::setUp();
    }
}