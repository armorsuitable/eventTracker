<?php 

namespace Event\Utility;

use SplFileInfo;
use DateTime;

/**
 * Class Logger
 * @package Event\Utility
 */
class Logger
{
    /**
     * @var
     */
    protected $fileObject;

    /**
     * @var SplFileInfo
     */
    protected $fileInfo;

	/**
	 * 附加日志路径作为初始化参数的 SplFileInfo 对象
	 * @param SplFileInfo $fileInfo
	 */
	public function __construct(SplFileInfo $fileInfo)
	{
		$this->fileInfo = $fileInfo;
	}


    /**
     * @param $data
     * @return int
     */
    public function write($data)
	{
		$logRecordPrefix = $this->getLogLabelTime();
		$logRecordType = ConfigReader::read('logs.log_type');

		$storeLine = $logRecordPrefix ." :[{$logRecordType}]: ". $data . "\n";

		if(! $this->fileExists()){
			file_put_contents($this->fileInfo->getPathname(), $storeLine);
		}

		if(! $this->isWriteAble()) {
			throw new \RuntimeException($this->fileInfo->getPathname(). "is not writeable!");
		}

		$this->fileObject = $this->fileInfo->openFile('a');
		return $this->fileObject->fwrite($storeLine);
	}

    /**
     * @return mixed
     */
    protected function fileExists()
    {
		return $this->fileInfo->isFile();
	}

    /**
     * @return bool
     */
    protected function isWriteAble()
    {
		return $this->fileInfo->isWritable();
	}

    /**
     * @return string
     */
    protected function getLogLabelTime()
	{
		return (new DateTime("NOW"))->format("Y-m-d H:i:s");
	}
}