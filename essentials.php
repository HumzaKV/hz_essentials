<?php
if (!function_exists('cf_log')) {
    function cf_log($data, $filename = 'log_cronjob.txt')
    {
        $filePath = dirname(__FILE__) . '/logs/' . $filename;
        $data     = print_r($data, true);
        $data .= ' -- -- -- ' . current_time('mysql');
        $myfile = file_put_contents($filePath, (string) $data . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}

if (!function_exists('pre')) {
    function pre($data, $die = 0) {
        if( !empty( $data ) ){
            echo '<pre>' . print_r($data, 1) . '</pre>';
            if ($die)
                die;
        }
    }
}