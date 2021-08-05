<?php
//require 'vendor/autoload.php';
$entry=time();
/*
// To handling AJAX call with raw file data
header("Content-Type: application/json"); 
$content_raw = file_get_contents("php://input");  
$data = json_decode($content_raw);
//$data = json_decode(file_get_contents("php://input")); 
echo $data->title;
*/


  $entryData = array(
       'category' => $_POST['category'],
       'title'    => $_POST['title'],
       'article'  => $_POST['article'],
       'when'     => time()
    );



//    $pdo->prepare("INSERT INTO blogs (title, article, category, published) VALUES (?, ?, ?, ?)")
//        ->execute($entryData['title'], $entryData['article'], $entryData['category'], $entryData['when']);

 // This is our new stuff
 //$loop = React\EventLoop\Factory::create();
 //$context = new React\ZMQ\Context($loop);
  $context = new ZMQContext();
  $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
  $socket->connect("tcp://127.0.0.1:5555");
  $socket->send(json_encode($entryData));
 // $loop->run();
 
$exist=time();
echo "\n".$entry;
echo "\n".$exist;
echo "\n total Time: " . ($exist - $entry);


 
 /* //Testing GLOBALS variables available in php engine. These are not provided by web server rather than available in php interpreter
 echo "POST ************************************************";
 if( isset($_POST)) var_dump($_POST); 
 echo "GET ************************************************";
 if( isset($_GET)) var_dump($_POST);
 echo "FILES ************************************************";
 if( isset($_FILES)) var_dump($_FILES);
 echo "ENV ************************************************";
 if( isset($_ENV)) var_dump($_ENV);
 echo "GLOBALS ************************************************";
 if( isset($GLOBALS)) var_dump($GLOBALS);
 echo "SERVER ************************************************";
 if( isset($_SERVER)) var_dump($_SERVER);
 echo "REQUESR ************************************************";
 if( isset($_REQUEST)) var_dump($_REQUEST);
 echo "COOCIE ************************************************";
 if( isset($_COOCIE)) var_dump($_COOKIE);
 echo "SESSION ************************************************";
 if( isset($_SESSION)) var_dump($_SESSION);
 
 */