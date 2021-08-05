<?php
// Your shell script
//server.php:
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\Session\SessionProvider;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

use MyApp\SessionPdoChat;
use MyApp\database\PDOClass;

require_once 'vendor/autoload.php';


//$pdo = new PDO("sqlite:src\database\session.db");
$pdo = new PDO("mysql:dbname=commondb;host=localhost",'sunny','server',  array(
    PDO::ATTR_PERSISTENT => true
));

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_TIMEOUT, 3);

$server = IoServer::factory(
			new HttpServer(
				new SessionProvider(
					new WsServer(new SessionPdoChat()),
					new PdoSessionHandler($pdo),
					['auto_start'=>1]
				)
			), 
			8080,
			'127.0.0.1'
		);
$server->run();


/*
calling Flow of control 
>>at starting of server

SPCServer constructor
WsServer constructor
SesssionServer constructor
HTTPServer constructor
IOServer Factory
IOServer constructor

>> at opening a connection

handleConnect called by IOServer when new open event come to Reactor via socket, Now this will call open method of app
HTTPServer onOpen called
SessionServer onOpen called
WsServer onOpen called
SPCServer onOpen called

*/