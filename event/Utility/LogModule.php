<?php
/**
 *
 */

namespace Event\Utility;

use SplFileInfo;

/**
 * Class LogModule
 * @package Event\Utility
 */
class LogModule
{
    /**
     * build SplFileInfo
     * @param $logPath
     * @return SplFileInfo
     */
    public function startUp($logPath)
    {
        ConfigReader::parser($logPath);

        $logName = ConfigReader::read('logs.name_prefix');
        $logName .= '-'. date('Y-m-d') . '.log';

        $absoluteFileName = ConfigReader::read('logs.absolute_dir')
            . DIRECTORY_SEPARATOR . $logName;

        return new SplFileInfo($absoluteFileName);
    }
}