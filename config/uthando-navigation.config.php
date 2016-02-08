<?php

return [
    'navigation' => [
        'admin' => [
            'article' => [
                'label' => 'Article',
                'params' => [
                    'icon' => 'fa-file-text-o',
                ],
                'pages' => [
                    'list' => [
                        'label'     => 'List All Articles',
                        'action'    => 'list',
                        'route'     => 'admin/article',
                        'resource'  => 'menu:admin'
                    ],
                    'add' => [
                        'label'     => 'Add New Article',
                        'action'    => 'add',
                        'route'     => 'admin/article/edit',
                        'resource'  => 'menu:admin'
                    ],
                ],
                'route' => 'admin/article',
                'resource' => 'menu:admin'
            ],
        ],
    ],
];
