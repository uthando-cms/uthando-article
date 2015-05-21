<?php
return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoArticle\Controller\Article' => ['action' => ['view']],
                            ],
                            'resources' => ['article:guest'],
                        ],
                    ],
                ],
                'registered' => [
                    'privileges' => [
                        'allow' => [
                            'resources' => ['article:user'],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoArticle\Controller\Article' => ['action' => 'all'],
                            ],
                            'resources' => ['article:admin'],
                        ],
                    ],
                ],
            ],
            'resources' => [
                'UthandoArticle\Controller\Article',
                'article:guest',
                'article:user',
                'article:admin',
            ],
        ],
    ],
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
            'admin' => [
                'child_routes' => [
                    'article' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/article',
                            'constraints'   => [
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'UthandoArticle\Controller',
                                'controller'    => 'Article',
                                'action'        => 'index',
                                'force-ssl'     => 'ssl'
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'edit' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'         => '/[:action[/id/[:id]]]',
                                    'constraints'   => [
                                        'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id'		=> '\d+'
                                    ],
                                    'defaults'      => [
                                        'action'        => 'edit',
                                        'force-ssl'     => 'ssl'
                                    ],
                                ],
                            ],
                            'page' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'         => '/page/[:page]',
                                    'constraints'   => [
        								'page' => '\d+'
							        ],
							        'defaults'      => [
								        'action'        => 'list',
								        'page'          => 1,
								        'force-ssl'     => 'ssl'
					                ],
				                ],
			                ],
		                ],
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'admin' => [
            'article' => [
                'label' => 'Article',
                'pages' => [
                    'list' => [
                        'label'     => 'List All Articles',
                        'action'    => 'list',
                        'route'     => 'admin/article',
                        'resource'  => 'menu:user'
                    ],
                    'add' => [
                        'label'     => 'Add New Article',
                        'action'    => 'add',
                        'route'     => 'admin/article/edit',
                        'resource'  => 'menu:user'
                    ],
                ],
                'route' => 'admin/article',
                'resource' => 'menu:user'
            ],
        ],
    ],
];
