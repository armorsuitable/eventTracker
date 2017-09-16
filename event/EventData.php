<?php  

namespace Event;

use Event\Utility\ConfigReader, Event\Exceptions\EventException;

class EventData
{
    protected $dataStream = NULL;

    /**
     * EventData constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->dataStream = $data;
    }

    /**
     * @param $fetchKey
     * @return null
     * @throws EventException
     */
    public function __get($fetchKey)
    {
        if(!$fetchKey == ConfigReader::read('data.stream_name')){
            throw new EventException("get attribute {$fetchKey} was not defined",100);
        }

        if(isset($this->dataStream[$fetchKey])) {
            return $this->dataStream[$fetchKey];
        }

        return $this->dataStream;
    }

    public function __toString()
    {
        return json_encode($this->dataStream);
    }
}