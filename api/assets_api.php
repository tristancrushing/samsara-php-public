<?php
/*
Samsara API Assets Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class assets
 * @package samsara_php\api
 */
class assets extends config {

    /**
     * Hold the class instance.
     *
     * @var null
     */
    private static $instance = null;

    private static $fleet_api;

    /**
     * __construct
     *
     * assets constructor.
     */
    function __construct()
    {

        parent::__construct();

        // Pull in fleet_api for duplicate endpoints that fall under both fleet & assets api's to create a wrapper for existing methods
        $this::$fleet_api = \samsara_php\api\fleet::getInstance();

    }

    /**
     * assetsGetAssets
     *
     * endpoint: /fleet/assets
     * Fetch all of the assets for the group.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'groupId'
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     * @param int|null $group_id
     * @return mixed
     */
    public function assetsGetAssets( int $group_id = null )
    {

        return $this::$fleet_api->fleetGetAssets( $group_id );

    }

    /**
     * assetsGetAssetsLocations
     *
     * endpoint: /fleet/assets/locations
     * Fetch all of the assets for the group.
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'group_id'
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     * @param int|null $group_id
     * @return mixed
     */
    public function assetsGetAssetsLocations( int $group_id = null )
    {

        return $this::$fleet_api->fleetGetAssetsLocations( $group_id );

    }

    /**
     * assetsGetAssetsLocationHistoryById
     *
     * endpoint: /fleet/assets/{assetId}/locations
     * Fetch the historical locations for the asset.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'asset_id' as $asset_id
     *      integer <int64> Required
     *      ID of the asset. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token'
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs'
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the start of the period to fetch, inclusive. Used in combination with endMs.
     *
     *      'endMs'
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the end of the period to fetch, inclusive. Used in combination with startMs.
     *
     * @param $asset_id
     * @param int $startTime
     * @param int $endTime
     * @return bool|mixed
     */
    public function assetsGetAssetsLocationHistoryById( int $asset_id, int $startTime, int $endTime )
    {

        return $this::$fleet_api->fleetGetAssetsLocationHistoryById( $asset_id, $startTime, $endTime );

    }

    /**
     * assetsGetAssetsReeferStatsById
     *
     * endpoint: /fleet/assets/{assetId}/reefer
     * Fetch the reefer-specific stats of an asset.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *      'asset_id' as $asset_id
     *      integer <int64> Required
     *      ID of the asset. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs' as $startTime
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the start of the period to fetch, inclusive. Used in combination with endMs.
     *
     *      'endMs' as $endTime
     *      integer <int64> Required
     *      Timestamp in milliseconds representing the end of the period to fetch, inclusive. Used in combination with startMs.
     *
     * @param int $asset_id
     * @param int $startTime
     * @param int $endTime
     * @return bool|mixed
     */
    public function assetsGetAssetsReeferStatsById( int $asset_id, int $startTime, int $endTime )
    {

        return $this::$fleet_api->fleetGetAssetsReeferStatsById( $asset_id, $startTime, $endTime );

    }

    /**
     * The object is created from within the class itself
     * only if the class has no instance.
     *
     * @return null|assets
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new assets();
        }

        return self::$instance;
    }

}