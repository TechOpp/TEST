<?php
namespace MyApp;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface {
    //public function onSubscribe(ConnectionInterface $conn, $topic) {    }  //this is define below
    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
		//ToDo nothing
    }
    public function onOpen(ConnectionInterface $conn) {
		//ToDo nothing
		echo "\n Connection Open";
    }
    public function onClose(ConnectionInterface $conn) {
		//ToDo nothing
    }
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        // In this application if clients send data it's because the user hacked around in console
        //$conn->close();
		echo "\n onPublish Fire  ";
	 $topic->broadcast("GOOD");
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
		//ToDo nothing
    }

	/**
     * A lookup of all the topics clients have subscribed to
     */
    protected $subscribedTopics = array();
	
    public function onSubscribe(ConnectionInterface $conn, $topic) {
		$topic->broadcast("Hellooooooooooo");
			echo "\n onSubscribe Fire";
	   $this->subscribedTopics[$topic->getId()] = $topic;
    }

    /**
     * @param string JSON'ified string we'll receive from ZeroMQ
     */
    public function onBlogEntry($entry) {
		echo "\n onBlogEntry Fire...";
		print_r($entry);
        $entryData = json_decode($entry, true);

        // If the lookup topic object isn't set there is no one to publish to
        if (!array_key_exists($entryData['category'], $this->subscribedTopics)) {
            return;
        }

        $topic = $this->subscribedTopics[$entryData['category']];

        // re-send the data to all the clients subscribed to that category
        $topic->broadcast($entryData);
    }

 
}