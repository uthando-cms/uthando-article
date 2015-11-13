<?php
return [
    'controllers' => [
        'invokables' => [
            'UthandoArticle\Controller\Article' => 'UthandoArticle\Controller\ArticleController',
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'UthandoArticle'                => 'UthandoArticle\Form\Article',
            'UthandoArticleFieldSet'        => 'UthandoArticle\Form\ArticleFieldSet',

            'UthandoArticleResourceList'    => 'UthandoArticle\Form\Element\ResourceList',
        ],
    ],
    'hydrators' => [
        'invokables' => [
            'UthandoArticle' => 'UthandoArticle\Hydrator\Article',
        ],
    ],
    'input_filters' => [
        'invokables' => [
            'UthandoArticle' => 'UthandoArticle\InputFilter\Article',
        ],
    ],
    'uthando_mappers' => [
        'invokables' => [
            'UthandoArticle' => 'UthandoArticle\Mapper\Article',
        ],
    ],
    'uthando_models' => [
        'invokables' => [
            'UthandoArticle' => 'UthandoArticle\Model\Article'
        ],
    ],
    'uthando_services' => [
        'invokables' => [
            'UthandoArticle' => 'UthandoArticle\Service\Article',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'UthandoArticleGetPost'     => 'UthandoArticle\View\GetPost',
            'UthandoArticleRecentPosts' => 'UthandoArticle\View\RecentPosts',
        ],
    ],
    'view_manager' => [
        'template_map' => include __DIR__ . '/../template_map.php'
    ],
    'router' => [
        'routes' => [
            'article' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/page/[:slug][/:model]',
                    'constraints' => [
                        'slug'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoArticle\Controller',
                        'controller'    => 'Article',
                        'action'        => 'view',
                        'force-ssl'     => 'http',
                        'model'         => false,
                    ],
                ],
            ],
        ],
    ],
];
