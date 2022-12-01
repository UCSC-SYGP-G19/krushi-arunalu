<?php

/**
 * @file
 * Custom logger class to log errors and other messages to a file
 */

namespace app\helpers;

use DateTime;
use DateTimeZone;
use Exception;

class Logger
{
    // Function to log messages to a file
    /**
     * @throws Exception
     */
    public static function log($type, $message): void
    {
        $tz = 'Asia/Colombo';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); // first argument "must" be a string
        $dt->setTimestamp($timestamp); // adjust the object to correct timestamp

        $filePath = './logs/' . $dt->format('Y-m-d') . '.log';
        if (file_exists($filePath)) {
            $file = fopen($filePath, 'a');
        } else {
            $file = fopen($filePath, 'w');
        }

        if ($file) {
            $log = $dt->format('Y-m-d H:i:s') . "  -  [$type]  " . $message . "\n";
            fwrite($file, $log);
            fclose($file);
        }
    }
}
