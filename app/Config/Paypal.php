<?php

namespace Config;
use CodeIgniter\Config\BaseConfig;
/** set your paypal credential **/
class Paypal extends BaseConfig
{
    public $paypalClientId = 'AeNJA4G2wIUYx7o4Y64wUob_fRA89tS5sG7FWMPgguIaQb5c6DRjFSGc6-Mtw3KQxJEOCMt9Y4tXrKMr';
    public $paypalSecret = 'EIiayEzm0E1rCU195Ua5bBvMHDQzxO4pts4XVjNIwczuWGSmB1bOkg5VTRtJZU_j9m0xng3aA8gs0_ce';

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
