<?php

/**
 * @file
 * Custom logger class to log errors and other messages to a file
 */

namespace app\helpers;

class Logger
{
    // Function to log messages to a file
    public static function log($type, $message): void
    {
        $filePath = './logs/' . date('Y-m-d') . '.log';
        if (file_exists($filePath)) {
            $file = fopen($filePath, 'a');
        } else {
            $file = fopen($filePath, 'w');
        }

        if ($file) {
            $log = date('Y-m-d H:i:s') . " - " . "[$type]  - " . $message . "\n";
            fwrite($file, $log);
            fclose($file);
        }
    }
}
