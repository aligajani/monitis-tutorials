<?php

require_once('monitis/utils/Request.class.php');
require_once('monitis/MApi.class.php');
require_once('monitis/monitors/MBase.class.php');
require_once('monitis/monitors/MExternalMonitor.class.php');
require_once('monitis/monitors/MInternalMonitor.class.php');

$apiKey = '3QNVSREQ5FJGH646H603D1M3BN';
$secretKey = '2LHCFKN6SR9Q61SNANT21E58NH';


// Obtain a list of all external monitors as set on the dashboard
$externalMonitorInstance = new MExternalMonitor($apiKey, $secretKey);
$externalMonitors = $externalMonitorInstance->requestMonitors();

// Print a list of them with their corresponding ids
foreach ($externalMonitors as $e) {
    foreach ($e as $i) {
        print_r($i['type'] . ', ' . $i['id']);
        echo PHP_EOL;
    }
}

$httpMonitorResponse = $externalMonitorInstance->requestMonitorResults(1158002, null,null,null, MInternalMonitor::PERIOD_LAST_24_HOURS, 0);
foreach ($httpMonitorResponse as $location) {
    print_r($location);
}

$pingMonitorResponse = $externalMonitorInstance->requestMonitorResults(1157880, null,null,null, MInternalMonitor::PERIOD_LAST_24_HOURS, 0);
foreach ($pingMonitorResponse as $location) {
    print_r($location);
}