<?php

namespace PXB\Module\Zend\Events;

use Zend\EventManager\SharedEventManager;

class EventModuleConfig
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    SharedEventManager::class => Factory\EventManagerFactory::class
                ]
            ],
        ];
    }
}
