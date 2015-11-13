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
];
