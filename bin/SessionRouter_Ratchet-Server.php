<?php
// Your shell script
use Ratchet\Session\SessionProvider;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\HttpFoundation\Session\Storage\Handler;
use Ratchet\App;
use MyApp\ChatForSession;
//use MyApp\MemcacheSessionHandler;

require dirname(__DIR__) . '/vendor/autoload.php';

    $memcached = new Memcached;
    $memcached->addServer("127.0.0.1", 11211);

    $sessionApp = new SessionProvider(
        new WsServer(new ChatForSession())
      , new Handler\MemcachedSessionHandler($memcached)
    );

    $server = new App('localhost');         						//creating IOServer. This server creation is done by Ratchet Framework provider  
	// Add as many route you want 
	$server->route('/sessDemo', $sessionApp, ['*'], 'localhost');  // Protocol of this method is: $server->route($path, ComponentInterface $controller, array $allowedOrigins = array(), $httpHost = null)
	$server->route('/sessDemo2', $sessionApp, ['*'], 'localhost');
	//aboutInstance($server->routes);
	//var_dump($server->routes->all());
	
    $server->run();
	
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