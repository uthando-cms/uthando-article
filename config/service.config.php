<?php

return [
    'shared' => [
        'UthandoArticle\Form\Article'           => false,
    ],
    'invokables' => [
        'UthandoArticle\Form\Article'           => 'UthandoArticle\Form\Article',
        'UthandoArticle\InputFilter\Article'    => 'UthandoArticle\InputFilter\Article',
        'UthandoArticle\Mapper\Article'         => 'UthandoArticle\Mapper\Article',
        'UthandoArticle\Service\Article'        => 'UthandoArticle\Service\Article'
    ]
];