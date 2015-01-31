<?php
/**
 * Воркер для добавления
 * User: nekulin
 * Date: 31.01.15
 * Time: 10:44
 */
include 'init.php';

$objStatisticCollection = $db->statistic;
$objGearmanWorker->addFunction("add_log", function(GearmanJob $job) use ($objStatisticCollection) {
    $attrParam = unserialize($job->workload());
    foreach ($attrParam['subnets'] as $strIp) {
        $objStatisticCollection->insert([
            "partner_id" => new MongoInt64($attrParam["partner_id"]),
            "operator_id" => new MongoInt64($attrParam["operator_id"]),
            "ip" => $strIp,
            "date" => new MongoTimestamp(time()-(rand(10, 999999))),
            "coutry_code" => $attrParam["coutry_code"],
        ]);
    }
});
while($objGearmanWorker->work()) {}