<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticle\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoArticle\Form;

use Zend\Form\Form;

/**
 * Class Article
 *
 * @package UthandoArticle\Form
 */
class Article extends Form
{
    public function init()
    {
        $elementArray = include __DIR__ . '/articleFieldElements.php';

        foreach ($elementArray as $name => $spec) {
            $spec['name'] = $name;
            $this->add($spec);
        }
    }
}
