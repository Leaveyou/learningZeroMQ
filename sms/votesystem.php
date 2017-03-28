<?php
/*
*  Hello World server
*  Binds REP socket to tcp://*:5555
*  Expects "Hello" from client, replies with "World"
* @author Ian Barber <ian(dot)barber(at)gmail(dot)com>
*/


ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);
error_reporting(E_ALL);


$context = new ZMQContext(1);

//  Socket to talk to clients
$responder = new ZMQSocket($context, ZMQ::SOCKET_REP);
$responder->bind("tcp://*:5556");
$storage = [

];

while (true) {
    //  Wait for next request from client
    $message = $responder->recv();
    $storage[$message]++;
    sleep(3);
    print_r($storage);
    //  Send reply back to client
    $responder->send("");
}

echo "done";
