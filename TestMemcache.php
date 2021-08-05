<?php
/*
$memcache = new Memcache;
 $memcache->connect("localhost",11211); # You might need to set "localhost" to "127.0.0.1"
 echo "Server's version: " . $memcache->getVersion() . "<br />\n";
 $tmp_object = new stdClass;
 $tmp_object->str_attr = "test";
 $tmp_object->int_attr = 123;
 $memcache->set("key",$tmp_object,false,10);
 echo "Store data in the cache (data will expire in 10 seconds)<br />\n";
 echo "Data from the cache:<br />\n";
 var_dump($memcache->get("key"));

*/


$mem_var = new Memcached();
$mem_var->addServer("127.0.0.1", 11211);
$response = $mem_var->get("Bilbo");
if ($response) {
//&nbsp; &nbsp; 
echo $response;
} else {
echo "Adding Keys (K) for Values (V), You can then grab Value (V) for your Key (K) \m/ (-_-) \m/ ";
$mem_var->set("Bilbo", "Here s Your (Ring) Master stored in MemCached (^_^)") or die(" Keys Couldn't be Created : Bilbo Not Found :'( ");
}
?>