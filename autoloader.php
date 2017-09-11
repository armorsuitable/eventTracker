<?php
 
 /**
  *  
  *  定制化, 自动加载规则 可以兼容 PSR-4 及扩展 PSR - 4 规则等 
  */
 
spl_autoload_register(function ($className){

	/**
	 * [$requireFile description]
	 * @var null
	 */
	$requireFile = NULL;
	$eventDirectory = APP_PATH. DIRECTORY_SEPARATOR .'event';
	
	/**
	 * Tracker Directory
	 */
	if(preg_match('/^EventTracker/', $className)){
		$realPath = str_replace('EventTracker', 'tracker', $className);
		$requireFile = APP_PATH. DIRECTORY_SEPARATOR . str_replace('\\', '/', $realPath) . '.php';
	}

	/**
	 * Event Directory
	 */
	if(preg_match('/^Event\\\\(\w+)$/', $className, $matches)){
		$requireFile = $eventDirectory . DIRECTORY_SEPARATOR . $matches[1] . '.php';
	}
	
	if(preg_match('/^Event\\\\Exceptions\\\\(\w+)$/', $className, $matches)){
		$exceptionDirectory = $eventDirectory . DIRECTORY_SEPARATOR . 'Exceptions';
		$requireFile =  $exceptionDirectory . DIRECTORY_SEPARATOR . $matches[1] . '.php' ;
	}

	if(preg_match('/^Event\\\\Utility\\\\(\w+)$/', $className, $matches)){
		$exceptionDirectory = $eventDirectory . DIRECTORY_SEPARATOR . 'Utility';
		$requireFile =  $exceptionDirectory . DIRECTORY_SEPARATOR . $matches[1] . '.php' ;
	}

	/**
	 * 
	 */
	if (!is_null($requireFile) && file_exists($requireFile)) {
		require_once $requireFile;
	}else{
		throw new \Event\Exceptions\EventException(100);
	}
	// not in scope , ignore ...
});

