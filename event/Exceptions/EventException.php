<?php  

namespace Event\Exceptions;
/**
 * 	
 */
class EventException extends \Exception
{
    public function __construct($exceptionCode)
    {
        parent::__construct("[ Event Customize Exception ...]", $exceptionCode);
    }
    /**
     * [getErrorMessage description]
     * @return [type] [description]
     */
    protected function getErrorMessage()
    {
    }
}