<?php
return
    [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'user',
            'except' => [],
            // 'patterns' => [
            // 'PATCH /update/' => 'fuck',
            // ],
            'extraPatterns' => [
                'POST,OPTIONS login' => 'login',
                'POST,OPTIONS logout' => 'logout',
            ],
        ],

        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'site',
            'except' => [],

        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'product',
            'except' => [],

        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'sub-category',
            'except' => [],

        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'category',
            'except' => [],
        ]
    ];
