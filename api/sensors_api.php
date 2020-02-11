<?php
/*
Samsara API Sensors Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class sensors
 * @package samsara_php\api
 */
class sensors extends config {

    /**
     * $instance
     * Hold the class instance.
     *
     * @var null
     */
    private static $instance = null;

    /**
     * __construct
     *
     * industrial constructor.
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * sensorsGetCargoStatus
     *
     * endpoint: /sensors/cargo
     * Get cargo monitor status (empty / full) for requested sensors.
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
     * Group ID and list of sensor IDs to query.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'sensors'
     *      Array of integer <int64> Required
     *      List of sensor IDs to query.
     *
     * @param int|null $group_id
     * @param array $sensor_ids
     * @return bool|mixed
     */
    public function sensorsGetCargoStatus(int $group_id = null, array $sensor_ids)
    {

        $endpoint = '/sensors/cargo';

        $data = [
            'access_token' => $this->config['access_token'],
            'sensors' => $sensor_ids
        ];

        if(!empty($group_id)) {
            $tempData = [
                'groupId' => $group_id
            ];

            $data = $data + $tempData;
        }else{
            $tempData = [
                'groupId' => $this->config['group_id']
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * sensorsGetDoorStatus
     *
     * endpoint: /sensors/door
     * Get door monitor status (closed / open) for requested sensors.
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
     * Group ID and list of sensor IDs to query.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'sensors'
     *      Array of integer <int64> Required
     *      List of sensor IDs to query.
     *
     * @param int|null $group_id
     * @param array $sensor_ids
     * @return bool|mixed
     */
    public function sensorsGetDoorStatus(int $group_id = null, array $sensor_ids)
    {

        $endpoint = '/sensors/door';

        $data = [
            'access_token' => $this->config['access_token'],
            'sensors' => $sensor_ids
        ];

        if(!empty($group_id)) {
            $tempData = [
                'groupId' => $group_id
            ];

            $data = $data + $tempData;
        }else{
            $tempData = [
                'groupId' => $this->config['group_id']
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * sensorsGetHistory
     *
     * endpoint: /sensors/history
     * Get historical data for specified sensors.
     * This method returns a set of historical data for the specified sensors in the specified time range and at the specified time resolution.
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
     * Group ID, time range and resolution, and list of sensor ID, field pairs to query.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'startMs'
     *      integer Required
     *      Beginning of the time range, specified in milliseconds UNIX time.
     *
     *      'endMs'
     *      integer Required
     *      End of the time range, specified in milliseconds UNIX time.
     *
     *      'stepMs'
     *      integer Required
     *      Time resolution for which data should be returned, in milliseconds. Specifying 3600000 will return data at hour intervals.
     *
     *      'series'
     *      Array of object Required
     *      Sensor ID and field to query.
     *
     *          'field'
     *          string Required
     *          "ambientTemperature", "cargoPercent", "currentLoop1Raw", "currentLoop1Mapped", "currentLoop2Raw",
     *          "currentLoop2Mapped", "doorClosed", "humidity", "pmPowerTotal", "pmPhase1Power", "pmPhase2Power",
     *          "pmPhase3Power", "pmPhase1PowerFactor", "pmPhase2PowerFactor", "pmPhase3PowerFactor", "probeTemperature"
     *          Field to query.
     *
     *          'widgetId'
     *          integer <int64> Required
     *          Sensor ID to query.
     *
     *      'fillMissing'
     *      string
     *      "withNull", "withNull", "withPrevious"
     *
     * @param int|null $group_id
     * @param int $start_time
     * @param int $end_time
     * @param int $step_interval
     * @param array $series
     * @param string|null $fill_missing
     * @return bool|mixed
     */
    public function sensorsGetHistory(int $group_id = null, int $start_time, int $end_time, int $step_interval, array $series, string $fill_missing = null )
    {

        $endpoint = '/sensors/history';

        $data = [
            'access_token' => $this->config['access_token'],
            'startMs' => $start_time,
            'endMs' => $end_time,
            'stepMs' => $step_interval,
            'series' => [$series],
        ];

        if(!empty($fill_missing)) {
            $tempData = [
                'fillMissing' => $fill_missing
            ];

            $data = $data + $tempData;
        }

        if(!empty($group_id)) {
            $tempData = [
                'groupId' => $group_id
            ];

            $data = $data + $tempData;
        }else{
            $tempData = [
                'groupId' => $this->config['group_id']
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * sensorsGetHumidityStatus
     *
     * endpoint: /sensors/humidity
     * Get humidity for requested sensors. This method returns the current relative humidity for the requested sensors.
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
     * Group ID and list of sensor IDs to query.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'sensors'
     *      Array of integer <int64> Required
     *      List of sensor IDs to query.
     *
     * @param int|null $group_id
     * @param array $sensor_ids
     * @return bool|mixed
     */
    public function sensorsGetHumidityStatus(int $group_id = null, array $sensor_ids)
    {

        $endpoint = '/sensors/humidity';

        $data = [
            'access_token' => $this->config['access_token'],
            'sensors' => $sensor_ids
        ];

        if(!empty($group_id)) {
            $tempData = [
                'groupId' => $group_id
            ];

            $data = $data + $tempData;
        }else{
            $tempData = [
                'groupId' => $this->config['group_id']
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * sensorsGetList
     *
     * endpoint: /sensors/list
     * Get sensor objects. This method returns a list of the sensor objects in the Samsara Cloud and information about them.
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
     * Optional group ID if the organization has multiple groups (uncommon)..
     *
     *      'groupId'
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     * @param int|null $group_id
     * @param array $sensor_ids
     * @return bool|mixed
     */
    public function sensorsGetList(int $group_id = null)
    {

        $endpoint = '/sensors/list';

        $data = [
            'access_token' => $this->config['access_token'],
        ];

        if(!empty($group_id)) {
            $tempData = [
                'groupId' => $group_id
            ];

            $data = $data + $tempData;
        }else{
            $tempData = [
                'groupId' => $this->config['group_id']
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * sensorsGetTemperatureStatus
     *
     * endpoint: /sensors/temperature
     * Get temperature for requested sensors. This method returns the current ambient temperature (and probe temperature if applicable) for the requested sensors.
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
     * Group ID and list of sensor IDs to query.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'sensors'
     *      Array of integer <int64> Required
     *      List of sensor IDs to query.
     *
     * @param int|null $group_id
     * @param array $sensor_ids
     * @return bool|mixed
     */
    public function sensorsGetTemperatureStatus(int $group_id = null, array $sensor_ids)
    {

        $endpoint = '/sensors/temperature';

        $data = [
            'access_token' => $this->config['access_token'],
            'sensors' => $sensor_ids
        ];

        if(!empty($group_id)) {
            $tempData = [
                'groupId' => $group_id
            ];

            $data = $data + $tempData;
        }else{
            $tempData = [
                'groupId' => $this->config['group_id']
            ];

            $data = $data + $tempData;
        }

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
     * @return null|sensors
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new sensors();
        }

        return self::$instance;
    }

}