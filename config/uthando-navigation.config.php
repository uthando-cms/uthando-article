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
                        'label'     => 'Edit Article',
                        'action'    => 'edit',
                        'route'     => 'admin/article',
                        'resource'  => 'menu:admin',
                        'visible'   => false,
                    ],
                    'add' => [
                        'label'     => 'Add New Article',
                        'action'    => 'add',
                        'route'     => 'admin/article/edit',
                        'resource'  => 'menu:admin',
                        'visible'   => false,
                    ],
                ],
                'route' => 'admin/article',
                'resource' => 'menu:admin',
            ],
        ],
    ],
];
