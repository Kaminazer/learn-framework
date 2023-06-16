<?php

return [
    'appName' => 'LearnFramework',
    'appHost' => 'learn-framework.loc',
    'components' => [
                    'router' => [
                        //'class' => \Core\Services\Routing\Router::class,
                        'factory' => \Core\Services\Routing\RouterFactory::class,
//                        'factory' => \App\Services\Routing\RouterFactory::class
                    ],
                    'logger' => [
                        //'class' => \Core\Services\Logging\Logger::class
                        //'factory' => \Core\Services\Logging\LoggerFactory::class,
                        'factory' => \App\Services\Logger\NazarLoggerFactory::class,
                        'params' => [
                            'fileName' => __DIR__ . '/../logs/log1.log',
                        ]
                    ],
                    'temp' => [
                        //'class' => \Core\Services\Temp\Test::class,
                        'factory' => \Core\Services\Temp\TestFactory::class,
                        'params' => [
                            'size' => 25
                        ]
                    ],
    ],
];