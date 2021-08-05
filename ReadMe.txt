With 1GB RAM to PHP RatChet is able to handle 1500000 Concurrent connection. To set memory limit in php.ini at line 399
wordpress may run on 1B if there is not too many plug in.
;A wordpress need minimum memory to work
;memory_limit = 1B
; A Laravel App need minimum memory to work
;memory_limit = 14M
;memory_limit = 14336K
;memory_limit = 14680064B

 
ReactPHP is basically an architecture (Design Pattern) To provide non-blocking event-driven application development in php.
RatChet is a framework in php based on ReactPHP to develop following type of applications in php
1. Simple Messaging Application on events like OnOpen, OnMessage, OnClose
2. Http Application on Request Response 
3. Web Socket Application based on OnOpen, OnMessage, OnClose, OnError 
4. WAMP Application on pub/sub and RPC + rRPC

Component Class 			|	Event triggered by Client (JavaScript)
I/O (socket transport) 		|	open 	close 	data 													error
HTTP Protocol Handler 		|	open 	close 	data 													error
Session Provider 			|	open 	close 	data 													error
WebSocket Protocol Handler 	|	open 	close 	data 													error
WAMP Protocol Handler 		|	open 	close 	publish 	subscribe 	unsubscribe 	call 	prefix 	error
(your) Application 			|	open 	close 	publish 	subscribe 	unsubscribe 	call 	prefix 	error

RatChet also provide following features to applications
=> IPBlockList
=> OrigineCheck
=> Router
=> FlashPolicy


// http://socketo.me/docs/hello-world
This is a socket programming app writing in PHP to handle real time communication .
This is a core websocket server of PHP application 

To run this app in Browser Mode:

this app is in two mode
Come to the app root directory
run the server script as:
> php bin\chat-server.php

1. Open JavaScriot console OR, visite : https://jsconsole.com/
2. run following code in console

var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};

3. Now send message to other connected client as
 conn.send('Hello World!');

Now Open client as visit the page: file:///D:/WEB_SERVERS/PHP_Apps/RatchetApp/bin/index.html
 on the console of this page see the massages

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
To run this app in Console Mode
 
Modifide the server (bin\chat-server.php) for console code, Now run the script as from root directory as
> php bin\chat-server.php

Now open 2 other console and run the command below as:
> telnet localhost 8080


now write on any console see the message on other console