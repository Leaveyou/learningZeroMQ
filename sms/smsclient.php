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
//echo "PID: " . $pid . "\n";


$context = new ZMQContext();
//  Socket to talk to server
echo "Connecting to hello world server…\n";
$requester = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$connectStatus = $requester->connect("tcp://localhost:5555");

$phone = uniqid();
$option = rand(1, 10);
$start = microtime(true);
$response = $requester->send($option . ":" . $phone);
$reply = $requester->recv();
echo (microtime(true) - $start) . PHP_EOL;


