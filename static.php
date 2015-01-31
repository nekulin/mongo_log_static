<?php
include 'init.php';

error_reporting(E_ALL | E_STRICT) ;
ini_set('display_errors', 'On');

$objStatisticCollection = $db->statistic;
$attrMatch = [];
if ($_POST['partner_id']!='') {
    $attrMatch['partner_id'] = new MongoInt64($_POST['partner_id']);
}
if ($_POST['coutry_code']!='') {
    $attrMatch['coutry_code'] = $_POST['coutry_code'];
}
if ($_POST['operator_id']!='') {
    $attrMatch['operator_id'] = new MongoInt64($_POST['operator_id']);
}
$attrMatch['date'] = [
    '$gte' => new MongoTimestamp(strtotime($_POST['date_from'])),
    '$lt' => new MongoTimestamp(strtotime($_POST['date_to'])),
];
$attrResult = $objStatisticCollection->aggregate([
    [
        '$match' => $attrMatch,
    ],
    [
        '$group' => [
            '_id' => [
                'partner_id' => '$partner_id',
                'year' => [
                    '$year' => '$date',
                ],
                'month' => [
                    '$month' => '$date',
                ],
                'day' => [
                    '$dayOfYear' => '$date',
                ],
                'hour' => [
                    '$hour' => '$date',
                ],
            ],
            'count' => [
                '$sum' => 1,
            ],
            'ip_unique' => [
                '$addToSet' => '$ip',
            ],
        ],
    ],
    [
        '$sort' => [
            'count' => -1,
        ],
    ],
]);
echo json_encode($attrResult);