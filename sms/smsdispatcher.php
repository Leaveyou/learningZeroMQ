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
$responder->bind("tcp://*:5555");

$voteSystem = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$voteSystemConnectStatus = $voteSystem->connect("tcp://localhost:5556");

$confirmationSystem = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$confirmationSystemConnectStatus = $confirmationSystem->connect("tcp://localhost:5557");

while (true) {
    //  Wait for next request from client
    $message = $responder->recv();
    printf("Received request: [%s]\n", $message);
    $data = explode(":", $message);

    //call option increment
    $voteOption = $data[0];
    $phone = $data[1];
    $voteSystem->send($voteOption);
    //send confirmation
    $confirmationSystem->send($phone);

    $voteSystem->recv();
    $confirmationSystem->recv();

    //  Send reply back to client
    $responder->send("");
}


echo "done";
