<?php


namespace Event;


use Event\Utility\ConfigReader;

abstract class EventCore
{
    protected $eventStream = NULL;

    public function __construct(EventData $eventData = NULL, $generator = 'SYSTEM', $eventType = '')
    {
        $event = [];

        $event['id'] = $this->getEventHashID($eventData);
        $event['type'] = $eventType;
        $event['stream'] = $eventData;
        // attachment information
        $event['generatedBy'] = $generator;
        $event['timestamp'] = time();

        $this->eventStream = $event;
    }

    public function __toString()
    {
        $outPutStream = $this->eventStream;
        $outPutStream['stream'] = json_decode(($this->eventStream['stream']), true);

        return json_encode($outPutStream);
    }

    protected function getEventHashID($data)
    {
        $hashStr = strtoupper(hash('ripemd128', $data));

        $idSeries = [
            ConfigReader::read('data.id_upstream'),
            ConfigReader::read('data.id_downstream')
        ];

        $eventHashId = $hashStr . '-' . mt_rand($idSeries[0],$idSeries[1]);
        return $eventHashId;
    }
}