<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticle\InputFilter
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoArticle\InputFilter;

use Zend\InputFilter\InputFilter;

/**
 * Class Article
 *
 * @package UthandoArticle\InputFilter
 */
class Article extends InputFilter
{
    public function init()
    {
        $elementArray = include __DIR__ . '/articleInputFilterElements.php';

        foreach ($elementArray as $name => $spec) {
            $spec['name'] = $name;
            $this->add($spec);
        }
    }
}
