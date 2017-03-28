<?php

$it = 1;
while ($it <= $argv[1]) {
    exec("php smsclient.php", $output);
    echo print_r($output, true) . PHP_EOL;
    $it++;
}