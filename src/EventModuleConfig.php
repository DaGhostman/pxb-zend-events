<?php

namespace PXB\Module\Zend\Events;

use Zend\Expressive\ConfigManager\PhpFileProvider as ConfigProvider;

class EventModuleConfig
{
    public function __invoke()
    {
        return new ConfigProvider(__DIR__ . '/../config/{{,*.}global,{,*.}local}.php');
    }
}
