<?php

// http://socketo.me/docs/hello-world

use Ratchet\Server\IoServer;

// This path has error. Now i have solve this error at 22Aug2020. 
//First use namespace defined in composer.json. 
//Now at the place of path in composer.json use namespace where ever that path come.
use MyApp\Chat;    		


    require dirname(__DIR__) . '/vendor/autoload.php';

    $server = IoServer::factory(
        new Chat(),
        8080,
		'127.0.0.1'
    );

		
    $server->run();
	
	
	// To read attributes and behaviours of a class
	//aboutInstance($server);
	
	function aboutInstance($instance){
		
		echo get_class($instance)."\n";
	
		$count =0;
		$class_attributes = get_object_vars($instance);
		foreach($class_attributes as $var_nm){
			echo "\n ".var_dump($var_nm);
			$count = $count +1;
		}
		echo "\n Total no of Properties:".$count;
		echo "\n ******************************************************************************************************************************** ";
		$count =0;
		$class_attributes = get_class_methods($instance);
		foreach($class_attributes as $mtd_nm){
			echo " \n".$mtd_nm;
			$count = $count +1;
		}
		echo "\n Total no of methods:".$count;
	}

	