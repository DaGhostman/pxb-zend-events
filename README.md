### pxb-zend-events

----

Bootstraps the `SharedEventManager` from ZF2 with events, based on those
available in the configuration files of other modules.

 __Example__:
 ```
 <?php

 return [
     'events' => [
        'event.name' => [
            [
                'identifiers' => 'handler_identifier',
                'callback' => 'MyAwesomeEventHandler',
                'priority' => 100 // This is optional, if not present defaults to 1
            ], [
                'identifiers' => ['id1', 'id2'],
                'callback' => 'MyOtherAwesomeHandler'
            ],
        ],
        'another.event => [ /* more event definitions */ ]
        // ....
     ]
 ];
 ```
This helps to pre-populate the event object with a set of events during runtime,
allowing early calls to them from the application, instead of having to wait for
and object to be instantiated and then defining them, which will happen in most
cases around the time of dispatch.

This is useful in cases such as logging errors (the app may crash before the
logger event is defined) if the app crashes too early.
