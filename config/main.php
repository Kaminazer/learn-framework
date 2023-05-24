<?php

return [
    'appName' => 'LearnFramework',
    'appHost' => 'learn-framework.loc',
    'components' => [
        'router' => [
            'class' => \Core\Services\Routing\Router::class,
        ],
        'logger' => [
            'class' => \Core\Services\Logging\Logger::class
        ]
    ],
];