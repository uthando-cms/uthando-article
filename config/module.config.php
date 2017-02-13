<?php
return [
    'controllers' => [
        'invokables' => [
            'UthandoArticle\Controller\Article' => \UthandoArticle\Mvc\Controller\ArticleController::class,
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'UthandoArticle'                => \UthandoArticle\Form\Article::class,

            'UthandoArticleResourceList'    => UthandoArticle\Form\Element\ResourceList::class,
        ],
    ],
    'hydrators' => [
        'invokables' => [
            'UthandoArticle' => \UthandoArticle\Hydrator\Article::class,
        ],
    ],
    'input_filters' => [
        'invokables' => [
            'UthandoArticle' => \UthandoArticle\InputFilter\Article::class,
        ],
    ],
    'uthando_mappers' => [
        'invokables' => [
            'UthandoArticle' => \UthandoArticle\Mapper\Article::class,
        ],
    ],
    'uthando_models' => [
        'invokables' => [
            'UthandoArticle' => \UthandoArticle\Model\Article::class
        ],
    ],
    'uthando_services' => [
        'invokables' => [
            'UthandoArticle' => \UthandoArticle\Service\Article::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'UthandoArticleGetPost'     => \UthandoArticle\View\GetPost::class,
            'UthandoArticleRecentPosts' => \UthandoArticle\View\RecentPosts::class,
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
