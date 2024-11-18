<?php

namespace Config;
use CodeIgniter\Config\BaseConfig;
/** set your paypal credential **/
class Paypal extends BaseConfig
{
    public $paypalClientId = '-';
    public $paypalSecret = '666+++66+9966999';

    /**
     * SDK configuration
     */
    /**
     * Available option 'sandbox' or 'live'
     */
    public $paypalSettings = array(
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 1000,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => 'App/Logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE',
    );
}
