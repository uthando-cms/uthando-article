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
        $this->add([
            'name' => 'articleId',
            'required'      => false,
            'filters'       => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators'    => [

            ],
        ]);

        $this->add([
            'name' => 'userId',
            'required'      => true,
            'filters'       => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators'    => [

            ],
        ]);

        $this->add([
            'name' => 'title',
            'required'      => true,
            'filters'       => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
                ['name' => 'UthandoCommon\Filter\Ucwords'],
            ],
            'validators'    => [
                ['name' => 'StringLength', 'options' => [
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
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
                ['name' => 'UthandoCommon\Filter\Slug'],
            ],
            'validators'    => [
                ['name' => 'StringLength', 'options' => [
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
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ],
            'validators' => [
                ['name'    => 'StringLength','options' => [
                    'encoding' => 'UTF-8',
                    'max'      => 255,
                ]],
            ],
        ]);

        $this->add([
            'name' => 'layout',
            'required' => false,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ],
            'validators' => [
                ['name'    => 'StringLength','options' => [
                    'encoding' => 'UTF-8',
                    'max'      => 255,
                ]],
            ],
        ]);

        $this->add([
            'name' => 'lead',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ],
            'validators' => [
                ['name'    => 'StringLength','options' => [
                    'encoding' => 'UTF-8',
                ]],
            ],
        ]);

        $this->add([
            'name' => 'description',
            'required'      => true,
            'filters'       => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators'    => [
                ['name' => 'StringLength', 'options' => [
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
                ['name'    => 'StripTags'],
                ['name'    => 'StringTrim'],
            ],
            'validators' => [
                ['name'    => 'StringLength','options' => [
                    'encoding' => 'UTF-8',
                    'min'      => 2,
                    'max'      => 50,
                ]],
            ],
        ]);
    }
}
