<?php
namespace MyApp;
use Ratchet\Http\HttpServerInterface;
use Ratchet\ConnectionInterface;
use Psr\Http\Message\RequestInterface;

use Ratchet\Server\IoConnection;
use React\Socket\ConnectionInterface as ReactConn;

class HttpHandler implements HttpServerInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn, RequestInterface $request = null, ResponseInterface $response = null) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
		/* // With 1GB RAM RatChet is able to handle 1500000 Concurrent connection
		for($count=0; $count<1500000; $count++){
			$newConn = clone $conn;
			$newConn->resourceId = $count;
			$this->clients->attach($newConn); //echo "\n connection ID: ".$newConn->resourceId;
		}
		echo "\n Total no of concurrent connections: ".count($this->clients);
		*/
		//aboutInstance($newConn);
		//var_dump($request);
		//$conn->send("Server Responded");

    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
	
	
		
	
	public function aboutInstance($instance){
		
		echo get_class($instance)."\n";
	
		$count =0;
		$class_attributes = get_object_vars($instance);
		foreach($class_attributes as $var_nm){
			echo "\n".var_dump($var_nm);
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
}