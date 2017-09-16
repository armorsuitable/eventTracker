<?php  

/**
 * base directory definition, must be needed 
 */
define('APP_PATH', __DIR__ );

/**
 * autoload directories
 */
require_once __DIR__ . '/autoloader.php';


$logModule = new \Event\Utility\LogModule();
$fileInfo = $logModule->startUp(APP_PATH . '/config/settings.php');

// example
$data = [
    'u_names' => 'Elliot-Gill-Blob',
    'u_key' => 'n892n2r2em0dk9m3e2dx9ce3dn-sdf4xv',
    'u_bills' => '￥10031.45',
    'pass_code' => '#0430404945#',
    '..' => '....'
];

$eventDt = new Event\EventData($data);

// Event event, eventGenerator, eventType
$event = new \Event\Event($eventDt,'tracker','database:create');

// 事件分发开始
$dispatchers = new \Event\EventDispatcher($event,
    new \Event\Utility\Logger($fileInfo));



//  自定义 try-catch 事件异常信息

//try {
//	$bew  = new \Event\Evens();
//} catch (Event\Exceptions\EventException $e) {
//	echo $e->getMessage();
//}
