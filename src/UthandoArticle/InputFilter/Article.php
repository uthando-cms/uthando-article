<?php
namespace UthandoArticle\InputFilter;

use Zend\InputFilter\InputFilter;

class Article extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'          => 'title',
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
            'name'          => 'slug',
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
    }
}
