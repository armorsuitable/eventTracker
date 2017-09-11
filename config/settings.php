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
		'name_prefix'  => 'eventDebug',
		'absolute_dir' => dirname( __DIR__ ). DIRECTORY_SEPARATOR .'logs',
		'log_type'  => 'json', //string/array',
		'interval'  =>  'daily' //month/all',
	],
];