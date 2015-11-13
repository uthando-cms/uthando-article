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

use UthandoArticle\Hydrator\Article as ArticleHydrator;
use UthandoArticle\Model\Article as ArticleModel;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Class ArticleFieldSet
 *
 * @package UthandoArticle\Form
 */
class ArticleFieldSet extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ArticleHydrator())
            ->setObject(new ArticleModel());
    }

    public function init()
    {
        $elementArray = include __DIR__ . '/articleFieldElements.php';

        foreach ($elementArray as $name => $spec) {
            $spec['name'] = $name;
            $this->add($spec);
        }
    }

    public function getInputFilterSpecification()
    {
        return include __DIR__ . '/../InputFilter/articleInputFilterElements.php';
    }
} 