<?php
/*
Samsara API Safety Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class safety
 * @package samsara_php\api
 */
class safety extends config {

    /**
     * $instance
     * Hold the class instance.
     *
     * @var null
     */
    private static $instance = null;

    private static $fleet_api;

    /**
     * __construct
     *
     * safety constructor.
     */
    function __construct()
    {
        parent::__construct();

        // Pull in fleet_api for duplicate endpoints that fall under both fleet & assets api's to create a wrapper for existing methods
        $this::$fleet_api = \samsara_php\api\fleet::getInstance();

    }

    /**
     * safetyGetDriverSafetyScoreById
     *
     * endpoint: /fleet/drivers/{driverId}/safety/score
     * Fetch the safety score for the driver.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driverId' as $id
     *      integer <int64> Required
     *      ID of the driver. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class.
     *      string [REQUIRED]
     *      Samsara API access token.
     *
     *      'startMs' as $start_time
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the start of the period to fetch, inclusive. Used in combination with endMs.
     *
     *      'endMs' as $end_time
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the end of the period to fetch, inclusive. Used in combination with startMs.
     *
     * @param int $id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function safetyGetDriverSafetyScoreById( int $id, int $start_time, int $end_time )
    {

        return $this::$fleet_api->fleetGetDriverSafetyScoreById($id, $start_time, $end_time);

    }

    /**
     * safetyGetVehicleSafetyHarshEventsById
     *
     * endpoint: /fleet/vehicles/{vehicleId}/safety/harsh_event
     * Fetch harsh event details for a vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicleId' as $id
     *      integer <int64> Required
     *      ID of the vehicle. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'timestamp' as $timestamp
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the timestamp of a harsh event.
     *
     * @param int $id
     * @param int $timestamp
     * @return bool|mixed
     */
    public function safetyGetVehicleSafetyHarshEventsById(int $id, int $timestamp )
    {

        return $this::$fleet_api->fleetGetVehicleSafetyHarshEventsById($id, $timestamp);

    }

    /**
     * safetyGetVehicleSafetyScoreById
     *
     * endpoint: /fleet/vehicles/{vehicleId}/safety/score
     * Fetch the safety score for the vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicleId' as $id
     *      integer <int64> Required
     *      ID of the vehicle. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs' as $start_time
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the start of the period to fetch, inclusive. Used in combination with endMs.
     *
     *      'endMs' as $end_time
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the end of the period to fetch, inclusive. Used in combination with startMs.
     *
     *      'groupId'
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     * @param int $id
     * @param int $start_time
     * @param int $end_time
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function safetyGetVehicleSafetyScoreById(int $id, int $start_time, int $end_time, int $group_id = null)
    {

        return $this::$fleet_api->fleetGetVehicleSafetyScoreById($id, $start_time, $end_time, $group_id);

    }

    /**
     * getInstance
     *
     * The object is created from within the class itself
     * only if the class has no instance.
     *
     * @return null|safety
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new safety();
        }

        return self::$instance;
    }

}