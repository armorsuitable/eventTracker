<?php  

/**
 * base directory definition
 */
define('APP_PATH', __DIR__ );

/**
 * autoload directories
 */
require_once __DIR__ . '/autoloader.php';

$settings = \Event\Utility\ConfigReader::parser( APP_PATH . '/config/settings.php');

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

