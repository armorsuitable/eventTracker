<?php
/**
 *
 */

namespace Event;


use Event\Exceptions\EventException;
use Event\Utility\ConfigReader;
use Event\Utility\Logger;

/**
 * Class EventDispatcher
 * @package Event
 */
class EventDispatcher
{
    /**
     * @var array
     */
    protected $trackers = [];

    /**
     * @var bool
     */
    protected $eventDebugMode;

    /**
     * EventDispatcher constructor.
     * @param Event $event
     * @param Logger $logger
     * @throws EventException
     */
    public function __construct(Event $event, Logger $logger)
    {
        $eventType = $event->type;

        $debugMode = ConfigReader::read('event.debug');
        // debug-mode, it could be modified via .env
        if(! in_array($debugMode, ["TRUE","FALSE"])){
            throw new EventException("event.debug.mode: {$debugMode} could not allowed !",200);
        }

        $this->eventDebugMode = $debugMode === "TRUE" ? true : false;

        // fetch the type of event
        $eventTypes = explode(':', $eventType);
        $this->trackers = $this->getEventTrackers($eventTypes);

        //has event (sub-event)
        if(mb_strpos($eventType, ':') === false){
            throw new EventException("event-type  {$eventType} format could not recognize!", 200);
        }

        $logLine = mb_strtolower("EVENT");

        foreach($this->trackers as $trackerItem){

            if($this->eventDebugMode){
                $logLine = 'Dispatching event ID : '.$event->id. '; Sending to :'.$trackerItem."\n";
                $logLine .= 'Dispatching event: '. $event. "\n";
                $logLine .= microtime() . ' - ';
            }

            // starting....

            if(class_exists($trackerItem)){
                call_user_func_array([new $trackerItem, 'capture'],[$event]);
            }
            // end

            if($this->eventDebugMode){
                $logLine .= microtime() . "\n";
                $this->storeTraceRecord($logger, $logLine);
            }
        }
    }


    /**
     * @param $eventType
     * @return array
     * @throws EventException
     */
    protected function getEventTrackers($eventType)
    {
        $generalTrackers = [];
        $eventTypeTrackers = [];
        $subEventTypeTrackers = [];

        $controlPanel = ConfigReader::read('event.trackers');

        if(!$controlPanel){
            throw new EventException("event.trackers not config", 200);
        }

        $trackers = (new $controlPanel)->trackerControlPanel;

        // general events
        if(isset($trackers['*'])){
            $generalTrackers = $trackers['*'];
        }

        //specific events
        if(isset( $trackers[ $eventType[0] ]['*']) ){
            $eventTypeTrackers = $trackers[$eventType[0]]['*'];
        }

        // sub-events
        if(isset( $trackers[ $eventType[0] ][ $eventType[1] ])){
            $subEventTypeTrackers = $trackers[ $eventType[0] ][ $eventType[1] ];
        }

        return array_unique(
            array_merge($generalTrackers, $eventTypeTrackers, $subEventTypeTrackers)
        );
    }


    /**
     * @param $logger
     * @param $record
     */
    public function storeTraceRecord($logger, $record)
    {
        if($logger instanceof Logger){
            $logger->write($record);
        }
    }
}