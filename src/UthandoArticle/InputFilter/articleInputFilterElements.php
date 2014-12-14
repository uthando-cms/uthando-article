<?php

return [
    'title' => [
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
    ],
    'slug' => [
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
    ],
    'description' => [
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
    ],
    'resource' => [
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
    ],
];