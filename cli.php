<?php
/**
 * Консолька добавления статики
 * User: nekulin
 * Date: 31.01.15
 * Time: 10:24
 */
include 'init.php';

$attrIp = [
    "5.44.32.0",
    "176.28.80.0",
    "77.244.112.0",
    "5.191.0.0",
];
$intCountIp = count($attrIp)-1;
$intCountOperators = count($attrOperators)-1;
for ($i=0; $i<100000; $i++) {
    $attrData = [
        "operator_id" => $attrOperators[rand(0, $intCountOperators)],
        "coutry_code" => "RU",
        "partner_id" => rand(0, 10),
        "user_agent" => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0",
        "subnets" => [$attrIp[rand(0, $intCountIp)]],
    ];
    $objGearmanClient->doBackground('add_log', serialize($attrData));
}