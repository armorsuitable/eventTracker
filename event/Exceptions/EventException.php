<?php  

namespace Event\Exceptions;
/**
 * 	
 */
class EventException extends \Exception
{
    public function __construct($messageString, $exceptionCode)
    {
        parent::__construct("[ Event Customize Exception ...]- [ {$messageString} ]", $exceptionCode);
    }
    /**
     * [getErrorMessage description]
     * @return [type] [description]
     */
    protected function getErrorMessage()
    {
    }
}