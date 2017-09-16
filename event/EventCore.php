<?php


namespace Event;


use Event\Utility\ConfigReader;

/**
 * Class EventCore
 * @package Event
 */
abstract class EventCore
{
    /**
     * @var array|null
     */
    protected $eventStream = NULL;

    /**
     * EventCore constructor.
     * @param EventData $eventData
     * @param string $generator
     * @param string $eventType
     */
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

    /**
     * @return string
     */
    public function __toString()
    {
        $outPutStream = $this->eventStream;
        $outPutStream['stream'] = json_decode(($this->eventStream['stream']), true);

        return json_encode($outPutStream);
    }

    public function __get($field)
    {
        $streamMap = [
            'id'   => 'id',
            'type' => 'type',
            'data' => 'stream',
            'user' => 'generatedBy',
            'timestamp' => 'timestamp'
        ];

        if(! in_array($field, array_keys($streamMap))){
            return false;
        }

        return $this->eventStream[$streamMap[$field]];
    }

    /**
     * @param $data
     * @return string
     */
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