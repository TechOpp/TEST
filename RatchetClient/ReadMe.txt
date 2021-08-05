To run this app in Console Mode
 
Modifide the server (bin\chat-server.php) for console code, Now run the script as from root directory as
> php bin\chat-server.php

Now open 2 other console and run the command below as:
> telnet localhost 8080


This app basically running two server in backaed. one is main web socket server and second when request come to post-server.php script then ZeroMQ server.
As a client it use authbahn.js, It support WAMP connection means pub/sub and rRPC two macanisum in one.

When we install ZQM library to php there is two things.
one is the core library(extention) of ZMQ for PHP should be present in ext folder of ActivePHP. These are php_zmq.dll & php_zmq.pdb.
And second. Since php ZMQ is develop on native ZMQ library, and this is not default availabe in OS library. so that must be availabe in path explicilty download. means libzmq.dll & libzmq.pdb should be in path. 
