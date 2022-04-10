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

        ]
    ];
