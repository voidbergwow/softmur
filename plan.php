<?php
$filename = __DIR__ . DIRECTORY_SEPARATOR . 'kill.txt';
$file = fopen($filename, 'r') or die('unable to open file');

$resa = 0;
$murders = [];
while (!feof($file)) {
    $resa++;
    $line = explode(';', fgets($file));

    $m = [];
    $m['name'] = $line[0];
    $m['target'] = $line[1];
    $m['place'] = $line[2];
    $m['time'] = trim($line[3]);

    $murders[] = $m;
    // echo fgets($file) . '<br>';
}

fclose($file);
