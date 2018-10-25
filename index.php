<?php

require __DIR__ . '/vendor/autoload.php';

use ApiClient\Resource\Producer;
use ApiClient\Client;

$client = new Client("http://grzegorz.demos.i-sklep.pl/rest_api/");
$client->authorize("rest", "vKTUeyrt1!");

$producer_resource = new Producer($client);

try {
    $producers = $producer_resource->getAll();
}catch (\Exception $e){
    echo $e->getMessage();
}

foreach ($producers as $producer){
    echo $producer->name.'<br>';
}

