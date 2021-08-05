<?php
//client.php:
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

require_once 'vendor/autoload.php';

$pdo = new PDO("mysql:dbname=commondb;host=localhost",'sunny','server');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_TIMEOUT, 3);

$sessionhandler = new PdoSessionHandler($pdo);
$storage = new NativeSessionStorage([], $sessionhandler);
$session = new Session($storage);
$session->set('foo', 'bar');
$session->set('baz', 'qux');

//aboutInstance($session);
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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>RatchetSessionTest</title>
        <script>
            console.log('trying to connect');
            let socket = new WebSocket('ws://localhost:8080');
            socket.onopen = function () {
                console.log('connected');
                this.send('Hello!');
            };
            socket.onmessage = function (msg) {
                console.log(msg.data);
            };
        </script>
    </head>
    <body>
        <p>HelloWorld</p>
    </body>
</html>