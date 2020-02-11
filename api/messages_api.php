<?php
/*
Samsara API Messages Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class messages
 * @package samsara_php\api
 */
class messages extends config {

    /**
     * Hold the class instance.
     *
     * @var null
     */
    private static $instance = null;

    /**
     * __construct
     *
     * messages constructor.
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * messagesGetMessages
     *
     * endpoint: /fleet/messages
     * Get all messages.
     *
     * [PARAMETERS]
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'durationMs' as $start_time
     *      integer <int64>
     *      Time in milliseconds that represents the duration before endMs to query. Defaults to 24 hours.
     *
     *      'endMs' as $end_time
     *      integer <int64>
     *      Time in unix milliseconds that represents the end of time range of messages to return. Used in combination with durationMs. Defaults to now.
     *
     * @param int|null $start_time
     * @param int|null $end_time
     * @return bool|mixed
     */
    public function messagesGetMessages(int $start_time = null, int $end_time = null)
    {
        $endpoint = '/fleet/messages';
        $data = [
            'access_token' => $this->config['access_token']
        ];

        // If $start_time not empty add $start_time to $data array.
        if(!empty($start_time)) {
            $tempData = [
                'durationMs' => $start_time
            ];

            $data = $data + $tempData;
        }

        // If $end_time not empty add $end_time to $data array.
        if(!empty($end_time)) {
            $tempData = [
                'endMs' => $end_time
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * messagesGetMessages
     *
     * endpoint: /fleet/messages
     * Send a message to a list of driver ids.
     *
     * [PARAMETERS]
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY]
     * Text to send to a list of driverIds
     *
     *      'driverIds' as $driver_ids
     *      number <int64> Required
     *      IDs of the drivers for whom the messages are sent to.
     *
     *      'text' as $text
     *      string Required
     *      The text sent in the message.
     *
     * @param int|null $start_time
     * @param int|null $end_time
     * @return bool|mixed
     */
    public function messagesSendMessages(array $driver_ids, string $text )
    {
        $endpoint = '/fleet/messages';
        $data = [
            'access_token' => $this->config['access_token'],
            'driverIds' => $driver_ids,
            'text' => $text
        ];

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * getInstance
     *
     * The object is created from within the class itself
     * only if the class has no instance.
     *
     * @return null|messages
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new messages();
        }

        return self::$instance;
    }

}