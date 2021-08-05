<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;

use MyApp\HttpHandler;    		

    require dirname(__DIR__) . '/vendor/autoload.php';
	
    $server = IoServer::factory(
			new HttpServer(  
				new HttpHandler()) ,
			8080
    );
	
    $server->run();
	
