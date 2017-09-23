<?php


/**
 *  List for all triggers
 *  requirement PHP 7.0+
 */

namespace Event\Utility;

use EventTracker\{
    EventTerminateTracker,
    EventNotificationTracker,
    EventDatabaseTracker
};

class EventTrackerControl
{

    public $trackerControlPanel = [
        //general event
        '*' => [
            EventTerminateTracker::class,
            //EventNotificationTracker::class
        ],

        //specific event
        'database' => [

            '*' => [
                EventDatabaseTracker::class,
            ],

            // sub-event
            'create' => [
                EventNotificationTracker::class,
            ],

            'update' => [
                EventNotificationTracker::class,
            ]
        ],
    ];
}