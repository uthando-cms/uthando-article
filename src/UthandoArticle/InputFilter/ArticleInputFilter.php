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

use UthandoCommon\Filter\Slug;
use UthandoCommon\Filter\Ucwords;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

/**
 * Class Article
 *
 * @package UthandoArticle\InputFilter
 */
class ArticleInputFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'articleId',
            'required'      => false,
            'filters'       => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $this->add([
            'name' => 'userId',
            'required'      => true,
            'filters'       => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $this->add([
            'name' => 'title',
            'required'      => true,
            'filters'       => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
                ['name' => Ucwords::class],
            ],
            'validators'    => [
                ['name' => StringLength::class, 'options' => [
                    'encoding' => 'UTF-8',
                    'min' => 2,
                    'max' => 255
                ]],
            ],
        ]);

        $this->add([
            'name' => 'slug',
            'required'      => true,
            'filters'       => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
                ['name' => Slug::class],
            ],
            'validators'    => [
                ['name' => StringLength::class, 'options' => [
                    'encoding' => 'UTF-8',
                    'min' => 2,
                    'max' => 255
                ]],
            ],
        ]);

        $this->add([
            'name' => 'image',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name'    => StringLength::class,'options' => [
                    'encoding' => 'UTF-8',
                    'max'      => 255,
                ]],
            ],
        ]);

        $this->add([
            'name' => 'layout',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name'    => StringLength::class,'options' => [
                    'encoding' => 'UTF-8',
                    'max'      => 255,
                ]],
            ],
        ]);

        $this->add([
            'name' => 'lead',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name'    => StringLength::class,'options' => [
                    'encoding' => 'UTF-8',
                ]],
            ],
        ]);

        $this->add([
            'name' => 'description',
            'required'      => true,
            'filters'       => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators'    => [
                ['name' => StringLength::class, 'options' => [
                    'encoding' => 'UTF-8',
                    'min' => 30,
                    'max' => 255
                ]],
            ],
        ]);

        $this->add([
            'name' => 'resource',
            'required'   => false,
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name'    => StringLength::class,'options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 2,
                    'max'      => 50,
                ]],
            ],
        ]);
    }
}
