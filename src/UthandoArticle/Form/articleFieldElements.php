<?php

return [
    'articleId' => [
        'type' => 'hidden',
    ],
    'userId' => [
        'type' => 'hidden',
    ],
    'title' => [
        'type' => 'text',
        'options' => [
            'label'     => 'Title:',
            'required'  => true,
        ],
        'attributes' => [
            'placeholder' => 'Article Title:',
            'class' => 'form-control',
        ],
    ],
    'slug' => [
        'type' => 'text',
        'options' => [
            'label'       => 'Slug:',
            'required'    => false,
            'inline-help' => 'If you leave this blank the the title will be used for the slug.'
        ],
        'attributes' => [
            'placeholder' => 'Slug:',
            'class' => 'form-control',
        ],
    ],
    'content' => [
        'type' => 'textarea',
        'options' => [
            'label' => 'HTML Content:'
        ],
        'attributes' => [
            'placeholder' => 'HTML Content:',
            'class'       => 'editable-textarea form-control',
            'id'          => 'article-content-textarea',
            'rows'        => 25,
        ],
    ],
    'description' => [
        'type' => 'text',
        'options' => [
            'label' => 'Description:',
        ],
        'attributes' => [
            'placeholder' => 'Description:',
            'class' => 'form-control',
        ],
    ],
    'pageHits' => [
        'type' => 'hidden',
    ],
    'resource' => [
        'type' => 'UthandoArticleResourceList',
        'options' => [
            'label' => 'Permissions:',
            'required' => false,
        ],
        'attributes' => [
            'class' => 'form-control',
        ],
    ],
    'dateCreated' => [
        'type' => 'hidden',
    ],
    'dateModified' => [
        'type' => 'hidden',
    ]
];