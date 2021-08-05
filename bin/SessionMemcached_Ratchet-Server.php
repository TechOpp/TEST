<?php
// Your shell script
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Session\SessionProvider;
use Symfony\Component\HttpFoundation\Session\Storage\Handler;

use MyApp\SessionPdoChat;

require dirname(__DIR__) . '/vendor/autoload.php';

	// $memcache = new Memcache;
    // $memcache->connect('localhost', 11211);
    $memcached = new Memcached;
    $memcached->addServer("127.0.0.1", 11211);

    $session = new SessionProvider(
        new WsServer(new SessionPdoChat())
      , new Handler\MemcachedSessionHandler($memcached)
    );
	
    $server = IoServer::factory(
			new HttpServer($session) ,
			8080
    );

    $server->run();