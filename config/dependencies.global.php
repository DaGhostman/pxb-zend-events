<?php

use PXB\Module\Zend\Events\Factory\EventManagerFactory;
use Zend\EventManager\SharedEventManager;

return [
    'dependencies' => [
        'factories' => [
            SharedEventManager::class => EventManagerFactory::class
        ]
    ],
];
