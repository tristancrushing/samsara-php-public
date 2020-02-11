<?php
/*
Samsara API utilities Class
*/

namespace samsara_php\api;

use samsara_php\config;
use \Datetime;

/**
 * Class utilities
 * @package samsara_php\api
 */
class utilities extends config {

    /**
     *
     * Hold the class instance.
     *
     * @var null
     */
    private static $instance = null;

    /**
     * utilities constructor.
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * @param string $datetime
     * @return bool|false|int
     */
    public function getMillisecondsFromDateTime(string $datetime)
    {
        try {

            // If string is DateTime convert to milliseconds and return
            if(DateTime::createFromFormat('Y-m-d H:i:s', $datetime) !== FALSE) {
                return strtotime($datetime)*1000;
            }

            // If string is NOT DateTime throw new exception
            if(DateTime::createFromFormat('Y-m-d H:i:s', $datetime) === FALSE) {
                throw new \Exception("Provided string '{$datetime}' is not a DateTime format, please provide a valid DateTime string.");
            }

        }

        catch(\Exception $e) {
            echo 'Exception: ' . $e->getMessage() . '</br>';
        }

        return false; // return false if exception is thrown.

    }

    /**
     *
     * The object is created from within the class itself
     * only if the class has no instance.
     *
     * @return null|utilities
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new utilities();
        }

        return self::$instance;
    }

}