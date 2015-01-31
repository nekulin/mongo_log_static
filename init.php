<?php
$objMongoClient = new MongoClient("mongodb://127.0.0.1:27017");
$db = $objMongoClient->rt;

$objGearmanWorker = new GearmanWorker();
$objGearmanWorker->addServer('127.0.0.1', 4730);

$objGearmanClient = new GearmanClient();
$objGearmanClient->addServer('127.0.0.1', 4730);

$attrOperators = ["Op1", "Op2", "Op3", "Op4"];