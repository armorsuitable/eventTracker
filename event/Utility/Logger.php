<?php 

namespace Event\Utility;

use SplFileInfo;
use SplFileObject;
use DateTime;

class Logger
{
	protected $fileObject;

	protected $fileInfo;

	/**
	 * 附加日志路径作为初始化参数的 SplFileInfo 对象
	 * @param SplFileInfo $fileInfo
	 */
	public function __construct(SplFileInfo $fileInfo)
	{
		$this->fileInfo = $fileInfo;
	}

	public function write($data)
	{
		$logRecordPrefix = $this->getLogLabelTime();

		if(! $this->fileExists()){
			//file_put_contents()
		}

		if(! $this->isWriteAble()) {

		}

		$this->fileObject = $this->fileInfo->openFile('a');
		$this->fileObject->fwrite($logRecordPrefix . ' : [ log-type ] ' .$data . "\n");
	}

	protected function fileExists()
	{
		return $this->fileInfo->isFile();
	}

	protected function isWriteAble()
	{
		return $this->fileInfo->isWritable();
	}

	protected function getLogLabelTime()
	{
		$dateTimeObject = new DateTime("NOW");
		return $dateTimeObject->format("Y-m-d H:i:s");
	}
}