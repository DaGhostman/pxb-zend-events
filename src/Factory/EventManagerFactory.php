<?php
/**
 * Created by PhpStorm.
 * User: ddimitrov
 * Date: 26/01/16
 * Time: 00:26
 */

namespace PXB\Module\Zend\Events\Factory;


use Interop\Container\ContainerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\SharedEventManager;

class EventManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $eventManager = $container->has(SharedEventManager::class) ?
            $container->get(SharedEventManager::class) : new SharedEventManager();


        if (array_key_exists('events', $config)) {
            foreach ($config['events'] as $event => $handlers) {
                if (empty($handlers)) {
                    continue;
                }

                foreach ($handlers as $handler) {
                    if (!array_key_exists('callback', $handler)) {
                        throw new \RuntimeException(sprintf(
                            'Handler for event "%s" not defined.',
                            $event
                        ));
                    }

                    if (!array_key_exists('identifier', $handler)) {
                        throw new \RuntimeException(sprintf(
                            'Unknown identifiers for event "%s" callback: "%s"',
                            $event,
                            $handler['callback']
                        ));
                    }

                    $eventManager->attach(
                        $handler['identifier'],
                        $event,
                        $container->get($handler['callback']),
                        array_key_exists('priority', $handler) ? $handler['priority'] : 1
                    );
                }
            }
        }

        return $eventManager;
    }
}
