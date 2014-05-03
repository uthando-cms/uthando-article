<?php
return [
    'userAcl' => [
        'userRoles' => [
            'guest' => [
                'privileges' => [
                    'allow' => [
                        ['controller' => 'UthandoArticle\Controller\Article', 'action' => ['view']],
                    ],
                ],
            ],
            'registered' => [
                'privileges' => [
                    'allow' => [
                        ['controller' => 'UthandoArticle\Controller\Article', 'action' => [ 'view' ]],
                    ],
                ],
            ],
            'admin' => [
                'privileges' => [
                    'allow' => [
                        ['controller' => 'UthandoArticle\Controller\Article', 'action' => 'all'],
                    ],
                ],
            ],
        ],
        'userResources' => [
            'UthandoArticle\Controller\Article'
        ],
    ],
    'router' => [
        'routes' => [
            'article' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/page/[:slug]',
                    'constraints' => [
                        'slug'  => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoArticle\Controller',
                        'controller'    => 'Article',
                        'action'        => 'view',
                        'force-ssl'     => 'http'
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
    'view_manager' => [
        'template_map' => include __DIR__ . '/../template_map.php'
    ],
];
