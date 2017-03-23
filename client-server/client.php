<?php
/*
*  Hello World client
*  Connects REQ socket to tcp://localhost:5555
*  Sends "Hello" to server, expects "World" back
* @author Ian Barber <ian(dot)barber(at)gmail(dot)com>
*/

ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);
error_reporting(E_ALL);


ob_implicit_flush(true);

header("content-type: text/plain");
ob_get_clean();
$pid = getmypid();
echo "PID: " . $pid . "\n";




$context = new ZMQContext();

//  Socket to talk to server
echo "Connecting to hello world server…\n";
$requester = new ZMQSocket($context, ZMQ::SOCKET_REQ);

$connectStatus = $requester->connect("tcp://localhost:5555");


$mode = 0;
//$mode = ZMQ::MODE_DONTWAIT;
$index = 0;

while (true) {

    $response = $requester->send("Hello, I'm " . $index, $mode);
    echo "Sending request  " . $index++  . " ... \n";
    sleep(2);
    $reply = $requester->recv();
    printf ("Received reply: [%s]\n", $reply);
}


