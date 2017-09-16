<?php
/**
 *  requirement PHP7.0 +
 */

namespace EventTracker;

use Event\Event;

abstract class EventGeneralTracker
{
    abstract public function capture(Event $event);
}