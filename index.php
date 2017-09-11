<?php  

/**
 * base directory definition
 */
define('APP_PATH', __DIR__ );

/**
 * autoloading directories 
 */
require_once __DIR__ . '/autoloader.php';

$settings = require_once __DIR__ . '/config/settings.php';

$logName = $settings['logs']['name_prefix'] .'-'. date('Y-m-d') . '.log';
$absoluteFileName = $settings['logs']['absolute_dir'] . DIRECTORY_SEPARATOR . $logName;


$a = new \Event\EventData();
$b = new \EventTracker\EventCreateTracker();
$c = new \Event\Utility\MessageGenerator();

try {
	$bew  = new \Event\Evens();
} catch (Event\Exceptions\EventException $e) {
	echo $e->getMessage();
}


$fileInfo = new SplFileInfo($absoluteFileName);

$s = new \Event\Utility\Logger($fileInfo);
$s->write("jjslksjdfsf |");



/**
if(file_exists($absoluteFileName)){
	$fp = fopen($absoluteFileName, 'a');
	fwrite($fp, "sdfkljsdf|");
	fclose($fp);
}else{
	if(is_writeable($settings['logs']['absolute_dir'])){
		//检查当前目录的权限
		chmod($settings['logs']['absolute_dir'], 0755);
		$fp = fopen($absoluteFileName, 'a');
		fwrite($fp, "sdfkljsdf|");
		fclose($fp);
	}	
} **/