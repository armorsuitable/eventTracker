<?php 


namespace Event\Utility;

/**
 * Class ConfigReader
 * @package Event\Utility
 */
class ConfigReader
{
    /**
     * @var
     */
    protected static $configMap;

    /**
     * @param $parserPath
     * @return bool|mixed
     */
    public static function parser($parserPath)
    {
        if(!file_exists($parserPath)){
            return false;
        }

        self::$configMap = require $parserPath;

        if(empty(self::$configMap)){
            return false;
        }

        return self::$configMap;
    }

    /**
     * @param $key
     * @param array $options
     * @return bool|mixed|null
     */
    public static function read($key, $options = [])
    {
        if (empty(self::$configMap) || !$key) {
            return false;
        }

        if (!empty($options) && isset($options['env'])) {
            return self::env($key);
        }

        if (mb_strpos($key, '.') !== 0) {
            $groupConfig = explode('.', $key);

            $readMap = self::$configMap[$groupConfig[0]];

            if (!is_array($readMap)) {
                return $readMap;
            }

            foreach ($readMap as $configName => $configValue) {
                if ($groupConfig[1] === $configName) {
                    return $configValue;
                }
            }
        }

        return self::$configMap[$key];
    }

    /**
     * @param $configKey
     * @return bool|mixed|null
     */
    public static function env($configKey)
    {
        $envFilePath = APP_PATH . DIRECTORY_SEPARATOR . '.env';

        if(!file_exists($envFilePath)){
            return false;
        }

        $fileObject = new \SplFileObject($envFilePath);

        if($fileObject->getSize() < 0){
            // empty for configure file
            return false;
        }

        $configEnvMap = [];

        // 读取配置文件项 would be optimize
        while(!$fileObject->eof()) {
            $configLine  = $fileObject->fgets();

            if($configLine){
                $readLine = explode('=', $configLine);

                if(isset($readLine[1])){
                    $configEnvMap[$readLine[0]] = trim($readLine[1]);
                }
            }
        }


        if(array_key_exists($configKey, $configEnvMap)){
            return $configEnvMap[$configKey];
        }

        return null;
    }
}