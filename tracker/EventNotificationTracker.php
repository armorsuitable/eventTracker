<?php
/**
 *
 */

namespace EventTracker;


use Event\Event;

class EventNotificationTracker extends EventGeneralTracker
{
    public function capture(Event $event)
    {
        var_dump("Notification tracker". $event->data);
    }
}