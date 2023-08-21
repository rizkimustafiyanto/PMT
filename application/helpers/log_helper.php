<?php

function writeToLog($logMessage, $operation)
{
    date_default_timezone_set('Asia/Jakarta');
    $logData = date('Y-m-d H:i:s') . ' [' . $operation . '] ' . $logMessage . PHP_EOL;
    $logFilePath = APPPATH . 'logs/log.txt';
    file_put_contents($logFilePath, $logData, FILE_APPEND);
}
