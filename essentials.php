<?php
// Version: 1.0.1

if (!function_exists('pre')) {
    function pre($data, $die = 0) {
        if( !empty( $data ) ){
            echo '<pre>' . print_r($data, 1) . '</pre>';
            if ($die)
                die;
        }
    }
}

if (!function_exists('cf_log')) {
    function cf_log($data, $filename = 'log_cronjob', $fileext = 'txt' ){
        $filePath = dirname(__FILE__) . '/logs/' . $filename.'.'.$fileext;
        $data = print_r($data, true);
        $data .= ' -- -- -- ' . current_time('mysql');
        $data .= '<br>';
        ob_start();
        pre( $data );
        $data = ob_get_clean();
        $myfile = file_put_contents($filePath, (string) $data . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}