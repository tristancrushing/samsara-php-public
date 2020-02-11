<?php
/*
Samsara API Industrial Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class industrial
 * @package samsara_php\api
 */
class industrial extends config {

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
     * industrialGetData
     *
     * endpoint: /industrial/data
     * Fetch all of the data inputs for a group.
     *
     * [PARAMETERS]
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'group_id' as $group_id
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'startMs' as $start_time
     *      integer <int64>
     *      Timestamp in unix milliseconds representing the start of the period to fetch, inclusive. Used in combination with endMs. defaults to nowMs.
     *
     *      'endMs' as $end_time
     *      integer <int64>
     *      Timestamp in unix milliseconds representing the end of the period to fetch, inclusive. Used in combination with startMs. Defaults to nowMs.
     *
     * @param int|null $group_id
     * @param int|null $start_time
     * @param int|null $end_time
     * @return bool|mixed
     */
    public function industrialGetData(int $group_id = null, int $start_time = null, int $end_time = null)
    {
        $endpoint = '/industrial/data';

        $data = ['access_token' => $this->config['access_token']];

        if(!empty($group_id)) {
            $tempData = [
                'group_id' => $group_id
            ];

            $data = $data + $tempData;
        }else{
            $tempData = [
                'group_id' => $this->config['group_id']
            ];

            $data = $data + $tempData;
        }

        // If $start_time is not null add to $data array
        if(!empty($start_time)) {
            $tempData = [
                'startMs' => $start_time
            ];

            $data = $data + $tempData;
        }

        // If $end_time is not null add to $data array
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
     * industrialGetDataByDataInputId
     *
     * endpoint: /industrial/data/{data_input_id}
     * Fetch datapoints from a given data input.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'data_input_id' as $data_input_id
     *      integer <int64> Required
     *      ID of the data input. Must contain only digits 0-9.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs' as $start_time
     *      integer <int64>
     *      Timestamp in unix milliseconds representing the start of the period to fetch, inclusive. Used in combination with endMs. defaults to nowMs.
     *
     *      'endMs' as $end_time
     *      integer <int64>
     *      Timestamp in unix milliseconds representing the end of the period to fetch, inclusive. Used in combination with startMs. Defaults to nowMs.
     *
     * @param int $data_input_id
     * @param int|null $start_time
     * @param int|null $end_time
     * @return bool|mixed
     */
    public function industrialGetDataByDataInputId(int $data_input_id, int $start_time = null, int $end_time = null)
    {

        $endpoint = "/industrial/data/{$data_input_id}";

        $data = ['access_token' => $this->config['access_token']];

        // If $start_time is not null add to $data array
        if(!empty($start_time)) {
            $tempData = [
                'startMs' => $start_time
            ];

            $data = $data + $tempData;
        }

        // If $end_time is not null add to $data array
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
     * industrialGetCameras
     *
     * endpoint: /industrial/vision/cameras
     * Fetch all cameras.
     *
     * [PARAMETERS]
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @return bool|mixed
     */
    public function industrialGetCameras()
    {

        $endpoint = '/industrial/vision/cameras';

        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }


    /**
     * industrialGetProgramsByCameraId
     *
     * endpoint: /industrial/vision/cameras/{camera_id}/programs
     * Fetch configured programs on the camera.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'camera_id' as $camera_id
     *      integer <int64> Required
     *      The camera_id should be valid for the given accessToken.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $camera_id
     * @return bool|mixed
     */
    public function industrialGetProgramsByCameraId(int $camera_id)
    {

        $endpoint = "/industrial/vision/cameras/{$camera_id}/programs";

        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * industrialGetVisionRunByCameraId
     *
     * endpoint: /industrial/vision/run/camera/{camera_id}
     * Fetch the latest run for a camera or program by default. If startedAtMs is supplied, fetch the specific run that corresponds to that start time.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'camera_id' as $camera_id
     *      integer <int64> Required
     *      The camera_id should be valid for the given accessToken.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'program_id' as $program_id
     *      integer <int64>
     *      The configured program's ID on the camera.
     *
     *      'startedAtMs' as $start_time
     *      integer <int64>
     *      EndMs is an optional param. It will default to the current time.
     *
     *      'include' as $include
     *      string
     *      Include is a filter parameter. Accepts 'pass', 'reject' or 'no_read'.
     *
     *      'limit' as $limit
     *      integer <int64>
     *      Limit is an integer value from 1 to 1,000.
     *
     * @param int $camera_id
     * @param int|null $program_id
     * @param int|null $start_time
     * @param string|null $include
     * @param int|null $limit
     * @return bool|mixed
     */
    public function industrialGetVisionRunByCameraId(int $camera_id, int $program_id = null, int $start_time = null, string $include = null, int $limit = null)
    {

        $endpoint = "/industrial/vision/run/camera/{$camera_id}";

        $data = ['access_token' => $this->config['access_token']];

        // If $program_id is not null add to $data array
        if(!empty($program_id)) {
            $tempData = [
                'program_id' => $program_id
            ];

            $data = $data + $tempData;
        }

        // If $start_time is not null add to $data array
        if(!empty($start_time)) {
            $tempData = [
                'startedAtMs' => $start_time
            ];

            $data = $data + $tempData;
        }

        // If $include is not null add to $data array
        if(!empty($include)) {
            $tempData = [
                'include' => $include
            ];

            $data = $data + $tempData;
        }

        // If $limit is not null add to $data array
        if(!empty($limit)) {
            $tempData = [
                'limit' => $limit
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * industrialGetVisionRuns
     *
     * endpoint: /industrial/vision/runs
     * Fetch runs.
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
     *      integer <int64> Required
     *      DurationMs is a required param. This works with the EndMs parameter. Indicates the duration in which the visionRuns will be fetched
     *
     *      'endMs' as $end_time
     *      integer <int64>
     *      EndMs is an optional param. It will default to the current time.
     *
     * @param int $start_time
     * @param int|null $end_time
     * @return bool|mixed
     */
    public function industrialGetVisionRuns(int $start_time, int $end_time = null)
    {

        $endpoint = '/industrial/vision/runs';

        $data = [
            'access_token' => $this->config['access_token'],
            'durationMs' => $start_time
        ];

        // If $end_time is not null add to $data array
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
     * industrialGetMachinesHistory
     *
     * endpoint: /machines/history
     * Get historical data for machine objects. This method returns a set of historical data for all machines in a group
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
     *
     * Group ID and time range to query for events
     *
     *      'groupId' as $group_id
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'startMs' as $start_time
     *      integer Required
     *      Beginning of the time range, specified in milliseconds UNIX time.
     *
     *      'endMs' as $end_time
     *      integer Required
     *      End of the time range, specified in milliseconds UNIX time.
     *
     * @param int $group_id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function industrialGetMachinesHistory(int $group_id = null, int $start_time, int $end_time)
    {

        $endpoint = '/machines/history';

        $data = [
            'access_token' => $this->config['access_token'],
            'startMs' => $start_time,
            'endMs' => $end_time
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
        $result = samsara::callAPI('GET/POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * industrialGetMachinesList
     *
     * endpoint: /machines/list
     * Get machine objects. This method returns a list of the machine objects in the Samsara Cloud and information about them.
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
     *
     * Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'groupId' as $group_id
     *      integer <int64> Required
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     * @param int $group_id
     * @return bool|mixed
     */
    public function industrialGetMachinesList(int $group_id = null)
    {

        $endpoint = '/machines/list';

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
        $result = samsara::callAPI('GET/POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }


    /**
     * getInstance
     *
     * The object is created from within the class itself
     * only if the class has no instance.
     *
     * @return null|industrial
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new industrial();
        }

        return self::$instance;
    }
    
}