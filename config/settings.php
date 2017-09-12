<?php

return [
	'type' => [
		'create' , 'update' , 'delete'
	],

	'level' => [ 
		'info', 
		'notice' , 
		'warning', 
		'error' , 
		'fatal'
	],

	'logs' => [
	    //
		'name_prefix'  => Event\Utility\ConfigReader::env('LOG_NAME_PREFIX'),
        //
		'absolute_dir' => dirname( __DIR__ ). DIRECTORY_SEPARATOR .'logs',
        //    string , array, json ',
		'log_type'  => Event\Utility\ConfigReader::env('LOG_CONTENT_TYPE'),
        //   all , month ,  daily',
		'interval'  =>  Event\Utility\ConfigReader::env('LOG_INTERVAL'),
	],
];