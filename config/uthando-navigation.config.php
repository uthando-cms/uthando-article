<?php

return [
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