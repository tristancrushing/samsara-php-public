<?php
/*
Samsara API Fleet Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class fleet
 * @package samsara_php\api
 */
class fleet extends config
{

    /**
     * Hold the class instance.
     * @var null
     */
    private static $instance = null;

    /**
     * fleet constructor.
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * getAddresses
     *
     * endpoint: /addresses
     * Fetch all addresses/geofences for the organization. An address contains either a circle or polygon geofence describing the address boundaries.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @return mixed
     */
    public function getAddresses()
    {
        $endpoint = '/addresses';
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * getAddressById
     *
     * endpoint: /addresses/{addressId}
     * Fetch all addresses/geofences for the organization. An address contains either a circle or polygon geofence describing the address boundaries.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'addressId' as $address_id
     *      integer <int64> Required
     *      ID of the address/geofence
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $address_id
     * @return bool|mixed
     */
    public function getAddressById( int $address_id )
    {
        $endpoint = "/addresses/{$address_id}";
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * deleteAddressById
     *
     * endpoint: /addresses/{addressId}
     * Delete an address.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'addressId' as $address_id
     *      integer <int64> Required
     *      ID of the address/geofence
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $address_id
     * @return bool|mixed
     */
    public function deleteAddressById( int $address_id )
    {
        $endpoint = "/addresses/{$address_id}";
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI('DELETE', $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * updateAddressById
     *
     * endpoint: /addresses/{addressId}
     * Update the name, formatted address, geofence, notes, or tag and contact Ids for an address.
     * The set of tags or contacts associated with this address will be updated to exactly match the list of IDs passed in.
     * To remove all tags or contacts from an address, pass an empty list; to remove notes, pass an empty string
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'addressId' as $address_id
     *      integer <int64> Required
     *      ID of the address/geofence
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY]  as $request_body with the following keys
     *
     * Update parts of an address's value. If the geofence 'circle' or 'polygon' key is specified, the update will change the type of geofence accordingly.
     * Must be an array with at least one of the following array keys
     *
     *      'contactIds' | Can be a null array, but must be included in the each address of the addresses array
     *      array of numbers <int64> [REQUIRED CAN BE EMPTY ARRAY]
     *      A list of IDs for contact book entries.
     *
     *      'formattedAddress'
     *      string [REQUIRED]
     *      The full address associated with this address/geofence, as it might be recognized by maps.google.com
     *
     *      'geofence' | The geofence that defines this address and its bounds. This can either be a circle, or a polygon
     *      - only one key should be provided, depending on the geofence type.
     *      address geofence [REQUIRED]
     *
     *              'circle' | Information about a circular geofence. This field is only populated if the geofence is a circle
     *
     *              'polygon' | Information about a polygon geofence. This field is only populated if the geofence is a polygon.
     *
     *      'name' | The name of this address/geofence
     *      string [REQUIRED]
     *
     *      'notes' | Notes associated with an address.
     *      string [REQUIRED CAN BE NULL]
     *
     *      'tagIds' | A list of tag IDs.
     *      array of numbers <int64> [REQUIRED CAN BE EMPTY ARRAY]
     *
     * @param int $address_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function updateAddressById( int $address_id, array $request_body )
    {
        $endpoint = "/addresses/{$address_id}";
        $data = ['access_token' => $this->config['access_token']];
        // combine $data array and $addresses array into single $data array
        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('PATCH', $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * addAddresses
     *
     * endpoint: /addresses
     * Add one or more addresses to the organization
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY]  as $request_body with the following keys
     *
     * List of addresses/geofences to add. Geofences can be circular or a polygon. For each address, only one of 'circle' or 'polygon' should be provided.
     * If both are provided, the geofence will be saved as a polygon.
     *
     * $addresses must be an array of objects/arrays to contain all of the following array/object keys.
     *
     *      'contactIds' | Can be a null array, but must be included in the each address of the addresses array
     *      array of numbers <int64> [REQUIRED CAN BE EMPTY ARRAY]
     *      A list of IDs for contact book entries.
     *
     *      'formattedAddress'
     *      string [REQUIRED]
     *      The full address associated with this address/geofence, as it might be recognized by maps.google.com
     *
     *      'geofence' | The geofence that defines this address and its bounds. This can either be a circle, or a polygon
     *      - only one key should be provided, depending on the geofence type.
     *      address geofence [REQUIRED]
     *
     *              $circle | Information about a circular geofence. This field is only populated if the geofence is a circle
     *
     *              $polygon | Information about a polygon geofence. This field is only populated if the geofence is a polygon.
     *
     *      'name' | The name of this address/geofence
     *      string [REQUIRED]
     *
     *      'notes' | Notes associated with an address.
     *      string [REQUIRED CAN BE NULL]
     *
     *      'tagIds' | A list of tag IDs.
     *      array of numbers <int64> [REQUIRED CAN BE EMPTY ARRAY]
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function addAddresses( array $request_body )
    {
        $endpoint = '/addresses';
        $data = ['access_token' => $this->config['access_token']];
        // combine $data array and $addresses array into single $data array
        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * getContacts
     *
     * endpoint: /contacts
     * Fetch all contacts for the organization.
     * @return mixed
     */
    public function getContacts()
    {
        $endpoint = '/contacts';
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * getContactById
     *
     * endpoint: /contacts/{contact_id}
     * Fetch a contact by its id.
     *
     * @param int $contact_id
     * @return bool|mixed
     */
    public function getContactById( int $contact_id )
    {
        $endpoint = "/contacts/{$contact_id}";
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * fleetAddAddress
     *
     * endpoint: /fleet/add_address
     * This method adds an address book entry to the specified group.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY]  as $request_body with the following keys
     *
     * List of addresses/geofences to add. Geofences can be circular or a polygon. For each address, only one of 'circle' or 'polygon' should be provided.
     * If both are provided, the geofence will be saved as a polygon.
     *
     *      'address' | Can not be null
     *      string [REQUIRED]
     *      The address of the entry to add, as it would be recognized if provided to maps.google.com.
     *
     *      'groupId'
     *      integer <int64> [REQUIRED] | If missing from array default `group_id` from config class will be added.
     *      Group ID to query.
     *
     *      'name'   | Name of the location to add to the address book.
     *      string [REQUIRED]
     *
     *      'radius'  | Notes associated with an address.
     *      integer [REQUIRED]
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetAddAddress( array $request_body )
    {

        $endpoint = '/fleet/add_address';
        $data = ['access_token' => $this->config['access_token']];

        // combine $data array and $addresses array into single $data array
        $data = $data + $request_body;

        // check to see if group_id key is in array, if not add default group_id from config class
        // @todo move into checkFleetAddress private function
        if(array_key_exists('group_id', $data)) {
            $group_id = ['groupId' => $this->config['group_id']];
            $data = $data = $group_id;
        }

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetAssets
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
    public function fleetGetAssets( int $group_id = null )
    {

        $endpoint = '/fleet/assets';
        $data = ['access_token' => $this->config['access_token']];

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetAssetsLocations
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
    public function fleetGetAssetsLocations( int $group_id = null )
    {

        $endpoint = '/fleet/assets/locations';
        $data = ['access_token' => $this->config['access_token']];

        // If $group_id is not null add to $data array
        // If $group_id is not null add to $data array
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

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetAssetsLocationHistoryById
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
    public function fleetGetAssetsLocationHistoryById( int $asset_id, int $startTime, int $endTime )
    {

        $endpoint = "/fleet/assets/{$asset_id}/locations";
        $data = [
            'access_token' => $this->config['access_token'],
            'startMs' => $startTime,
            'endMs' => $endTime
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetAssetsReeferStatsById
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
    public function fleetGetAssetsReeferStatsById( int $asset_id, int $startTime, int $endTime )
    {

        $endpoint = "/fleet/assets/{$asset_id}/reefer";
        $data = [
            'access_token' => $this->config['access_token'],
            'startMs' => $startTime,
            'endMs' => $endTime
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDispatchRoutes
     *
     * endpoint: /fleet/dispatch/routes
     * Fetch all of the dispatch routes for the group.
     *
     * [PARAMETERS]
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'group_id'
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'end_time'
     *      integer <int64>
     *      Time in unix milliseconds that represents the oldest routes to return. Used in combination with duration. Defaults to now.
     *
     *      'duration' | actually means start_date time stamp in milliseconds.
     *      integer <int64>
     *      Time in milliseconds that represents the duration before end_time to query. Defaults to 24 hours.
     *
     * @param int|null $group_id
     * @param int $end_time
     * @param int $duration | @todo let samasara know this is actually equivalent to a start date and not a duration.
     * @return bool|mixed
     */
    public function fleetGetDispatchRoutes( int $group_id = null, int $end_time, int $duration )
    {

        $endpoint = '/fleet/dispatch/routes';
        $data = [
            'access_token' => $this->config['access_token'],
            'end_time' => $end_time,
            'duration' => $duration
        ];

        // If $group_id is not null add to $data array
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

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetAddDispatchRoute
     *
     * endpoint: /fleet/dispatch/routes
     * Create a new dispatch route.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'dispatch_jobs'
     *      Array opf DispatchJobCreate Required
     *      The dispatch jobs to create for this route.
     *
     *      'driver_id'
     *      integer <int64>
     *      ID of the driver assigned to the dispatch route. Note that driver_id and vehicle_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     *      'group_id'
     *      integer <int64>
     *      ID of the group if the organization has multiple groups (optional).
     *
     *      'name'
     *      string Required
     *      Descriptive name of this route.
     *
     *      'scheduled_end_ms'
     *      integer <int64>
     *      The time in Unix epoch milliseconds that the last job in the route is scheduled to end.
     *
     *      'scheduled_meters'
     *      integer <int64>
     *      The distance expected to be traveled for this route in meters.
     *
     *      'scheduled_start_ms'
     *      integer <int64> Required
     *      The time in Unix epoch milliseconds that the route is scheduled to start.
     *
     *      'start_location_address'
     *      string
     *      The address of the route's starting location, as it would be recognized if provided to maps.google.com. Optional if a valid start location address ID is provided.
     *
     *      'start_location_address_id'
     *      integer <int64>
     *      ID of the start location associated with an address book entry. Optional if valid values are provided for start location address or latitude/longitude. If a valid start location address ID is provided, address/latitude/longitude will be used from the address book entry. Name of the address book entry will only be used if the start location name is not provided.
     *
     *      'start_location_lat'
     *      number <double>
     *      Latitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_lng'
     *      number <double>
     *      Longitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_name'
     *      string
     *      The name of the route's starting location. If provided, it will take precedence over the name of the address book entry.
     *
     *      'trailer_id'
     *      integer <int64>
     *      ID of the trailer assigned to the dispatch route. Note that trailers can only be assigned to routes that have a Vehicle or Driver assigned to them.
     *
     *      'vehicle_id'
     *      integer <int64>
     *      ID of the vehicle assigned to the dispatch route. Note that vehicle_id and driver_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetAddDispatchRoute( array $request_body )
    {

        $endpoint = '/fleet/dispatch/routes';
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDispatchRoutesJobUpdates
     *
     * endpoint: /fleet/dispatch/routes/job_updates
     * Fetch all updates to a job including route data in the last 24 hours or subsequent to an sequence ID.
     * Returns a maximum of 500 job updates. If more than 500 job updates are available,
     * another request made with the prior request's sequence_id will return the next set of available job updates.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'group_id'
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     *      'sequence_id'
     *      string
     *      Sequence ID from the response payload of the last request. Defaults to fetching updates from last 24 hours.
     *
     *      'include'
     *      string
     *      Optionally set include=route to include route object in response payload.
     *
     * @param int|null $group_id
     * @param int $sequence_id
     * @param string $include
     * @return bool|mixed
     */
    public function fleetGetDispatchRoutesJobUpdates( int $group_id = null, int $sequence_id = null, string $include = null )
    {

        $endpoint = '/fleet/dispatch/routes/job_updates';
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // If $group_id is not null add to $data array
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

        // If $sequence_id is not null add to $data array
        if(!empty($sequence_id)) {
            $tempData = [
                'sequence_id' => $sequence_id
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

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDispatchRouteById
     *
     * endpoint: /fleet/dispatch/routes/{route_id}
     * Fetch a dispatch route by id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'route_id' as $route_id
     *      integer <int64> Required
     *      ID of the dispatch route. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token'
     *      string Required
     *      Samsara API access token.
     *
     * @param int $route_id
     * @return bool|mixed
     */
    public function fleetGetDispatchRouteById( int $route_id )
    {
        $endpoint = "/fleet/dispatch/routes/{$route_id}";
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * fleetUpdateDispatchRouteById
     * @todo testing is not enabled on this method
     *
     * endpoint: /fleet/dispatch/routes/{route_id}
     * Update a dispatch route and its associated jobs.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'route_id' as $route_id
     *      integer <int64> Required
     *      ID of the dispatch route. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'dispatch_jobs'
     *      Array of DispatchJob Required
     *      The dispatch jobs associated with this route.
     *
     *      'id'
     *      integer <int64> Required
     *      ID of the Samsara dispatch route.
     *
     *      'actual_end_ms'
     *      integer <int64>
     *      The time in Unix epoch milliseconds that the route actually ended.
     *
     *      'actual_start_ms'
     *      integer <int64>
     *      The time in Unix epoch milliseconds that the route actually started.
     *
     *      'driver_id'
     *      integer <int64>
     *      ID of the driver assigned to the dispatch route. Note that driver_id and vehicle_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     *      'group_id'
     *      integer <int64>
     *      ID of the group if the organization has multiple groups (optional).
     *
     *      'name'
     *      string Required
     *      Descriptive name of this route.
     *
     *      'odometer_end_meters'
     *      integer <int64>
     *      Odometer reading at the end of the route. Will not be returned if Route is not completed or if Odometer information is not available for the relevant vehicle.
     *
     *      'odometer_start_meters'
     *      integer <int64>
     *      Odometer reading at the start of the route. Will not be returned if Route has not started or if Odometer information is not available for the relevant vehicle.
     *
     *      'scheduled_end_ms'
     *      integer <int64> Required
     *      The time in Unix epoch milliseconds that the last job in the route is scheduled to end.
     *
     *      'scheduled_meters'
     *      integer <int64>
     *      The distance expected to be traveled for this route in meters.
     *
     *      'scheduled_start_ms'
     *      integer <int64> Required
     *      The time in Unix epoch milliseconds that the route is scheduled to start.
     *
     *      'start_location_address'
     *      string
     *      The address of the route's starting location, as it would be recognized if provided to maps.google.com. Optional if a valid start location address ID is provided.
     *
     *      'start_location_address_id'
     *      integer <int64>
     *      ID of the start location associated with an address book entry. Optional if valid values are provided for start location address or latitude/longitude. If a valid start location address ID is provided, address/latitude/longitude will be used from the address book entry. Name of the address book entry will only be used if the start location name is not provided.
     *
     *      'start_location_lat'
     *      number <double>
     *      Latitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_lng'
     *      number <double>
     *      Longitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_name'
     *      string
     *      The name of the route's starting location. If provided, it will take precedence over the name of the address book entry.
     *
     *      'trailer_id'
     *      integer <int64>
     *      ID of the trailer assigned to the dispatch route. Note that trailers can only be assigned to routes that have a Vehicle or Driver assigned to them.
     *
     *      'vehicle_id'
     *      integer <int64>
     *      ID of the vehicle assigned to the dispatch route. Note that vehicle_id and driver_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     * @param int $route_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetUpdateDispatchRouteById( int $route_id, array $request_body )
    {
        $endpoint = "/fleet/dispatch/routes/{$route_id}";
        $data = ['access_token' => $this->config['access_token']];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('PUT', $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * fleetDeleteDispatchRouteById
     * @todo testing is not enabled on this method
     *
     * endpoint: /fleet/dispatch/routes/{route_id}
     * Delete a dispatch route and its associated jobs.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'route_id' as $route_id
     *      integer <int64> Required
     *      ID of the dispatch route. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $route_id
     * @return bool|mixed
     */
    public function fleetDeleteDispatchRouteById( int $route_id )
    {
        $endpoint = "/fleet/dispatch/routes/{$route_id}";
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI('DELETE', $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * fleetGetDispatchRouteHistory
     *
     * endpoint: /fleet/dispatch/routes/{route_id}/history
     * Fetch the history of a dispatch route.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'route_id' as $route_id
     *      integer <int64> Required
     *      ID of the route with history. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'start_time'
     *      integer <int64>
     *      Timestamp representing the start of the period to fetch, inclusive. Used in combination with end_time. Defaults to 0.
     *
     *      'end_time'
     *      integer <int64>
     *      Timestamp representing the end of the period to fetch, inclusive. Used in combination with start_time. Defaults to nowMs.
     *
     * @param int|null $route_id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function fleetGetDispatchRouteHistory( int $route_id, int $start_time = null, int $end_time = null )
    {

        $endpoint = "/fleet/dispatch/routes/{$route_id}/history";
        $data = [
            'access_token' => $this->config['access_token'],
            'start_time' => $start_time,
            'end_time' => $end_time
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDrivers
     *
     * endpoint: /fleet/drivers
     * Get all the drivers for the specified group.
     *
     * [PARAMETERS]
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Group ID to query.
     *
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function fleetGetDrivers( int $group_id = null )
    {

        $endpoint = '/fleet/drivers';
        $data = [ 'access_token' => $this->config['access_token'] ];

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetAddDrivers
     *
     * endpoint: /fleet/drivers/create
     * Create a new driver.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     * Driver creation body
     *
     *      `password`
     *      string Required
     *      Driver's password for the driver app.
     *
     *      `tagIds`
     *      number <int64>
     *      A list of tag IDs.
     *
     *      `eldAdverseWeatherExemptionEnabled`
     *      boolean
     *      Flag indicating this driver may use Adverse Weather exemptions in ELD logs.
     *
     *      `eldBigDayExemptionEnabled`
     *      boolean
     *      Flag indicating this driver may use Big Day excemptions in ELD logs.
     *
     *      `eldDayStartHour`
     *      integer
     *      0 indicating midnight-to-midnight ELD driving hours, 12 to indicate noon-to-noon driving hours.
     *
     *      `eldExempt`
     *      boolean
     *      Flag indicating this driver is exempt from the Electronic Logging Mandate.
     *
     *      `eldExemptReason`
     *      string
     *      Reason that this driver is exempt from the Electronic Logging Mandate (see eldExempt).
     *
     *      `eldPcEnabled`
     *      boolean
     *      false
     *      Flag indicating this driver may select the Personal Conveyance duty status in ELD logs.
     *
     *      `eldYmEnabled`
     *      boolean
     *      false
     *      Flag indicating this driver may select the Yard Move duty status in ELD logs.
     *
     *      `externalIds`
     *      externalIds
     *      Dictionary of external IDs (string key-value pairs)
     *
     *      `groupId`
     *      integer <int64>
     *      ID of the group if the organization has multiple groups (uncommon).
     *
     *      `licenseNumber`
     *      string
     *      Driver's state issued license number.
     *
     *      `licenseState`
     *      string
     *      Abbreviation of state that issued driver's license.
     *
     *      `name`
     *      string Required
     *      Driver's name.
     *
     *      `notes`
     *      string
     *      Notes about the driver.
     *
     *      `phone`
     *      string
     *      Driver's phone number. Please include only digits, ex. 4157771234
     *
     *      `username`
     *      string
     *      Driver's login username into the driver app.
     *
     *      `vehicleId`
     *      integer <int64>
     *      ID of the vehicle assigned to the driver for static vehicle assignments. (uncommon).
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetAddDrivers( array $request_body )
    {

        $endpoint = '/fleet/drivers/create';
        $data = [ 'access_token' => $this->config['access_token'] ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDriverDocuments
     *
     * endpoint: /fleet/drivers/documents
     * Fetch all of the documents.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'endMs' as $end_time
     *      integer <int64>
     *      Time in unix milliseconds that represents the oldest documents to return. Used in combination with durationMs. Defaults to now.
     *
     *      `durationMs` as $duration | @todo let samasara know this is actually equivalent to a start date and not a duration.
     *      integer <int64>
     *      Time in milliseconds that represents the duration before endMs to query. Defaults to 24 hours.
     *
     * @param int|null $end_time
     * @param int|null $duration
     * @return bool|mixed
     */
    public function fleetGetDriverDocuments( int $end_time = null, int $duration = null )
    {

        $endpoint = '/fleet/drivers/documents';
        $data = [ 'access_token' => $this->config['access_token'] ];

        // If $end_time is not null add to $data array
        if(!empty($end_time)) {
            $tempData = [
                'endMs' => $end_time
            ];

            $data = $data + $tempData;
        }

        // If $duration is not null add to $data array
        if(!empty($duration)) {
            $tempData = [
                'durationMs' => $duration
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data );

        return $result;

    }

    /**
     * fleetGetDriverDocumentTypes
     *
     * endpoint: /fleet/drivers/document_types
     * Fetch all of the document types
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @return bool|mixed
     */
    public function fleetGetDriverDocumentTypes()
    {

        $endpoint = '/fleet/drivers/document_types';
        $data = [ 'access_token' => $this->config['access_token'] ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }


    /**
     * fleetGetInactiveDrivers
     *
     * endpoint: /fleet/drivers/inactive
     * Fetch all deactivated drivers for the group.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      `group_id`
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function fleetGetInactiveDrivers(int $group_id = null )
    {

        $endpoint = '/fleet/drivers/inactive';
        $data = [ 'access_token' => $this->config['access_token'] ];

        // If $group_id is not null add to $data array
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

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetInactiveDriverById
     *
     * endpoint: /fleet/drivers/inactive/{driver_id or external_id}
     * Fetch all deactivated drivers for the group.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *      `driver_id` or `external_id` as $driver_id
     *      string [REQUIRED]
     *      ID of the driver. This must be either the numeric ID generated by Samsara or the external ID of the driver.
     *      Driver ID must contain only digits 0-9. External IDs are customer specified key-value pairs and must contain only alphanumeric characters.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $driver_id
     * @return bool|mixed
     */
    public function fleetGetInactiveDriverById(string $driver_id )
    {

        $endpoint = "/fleet/drivers/inactive/{$driver_id}";
        $data = [ 'access_token' => $this->config['access_token'] ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetActivateInactiveDriverById
     *
     * endpoint: /fleet/drivers/inactive/{driver_id or external_id}
     * Reactivate the inactive driver having id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *      `driver_id` or `external_id` as $driver_id
     *      string [REQUIRED]
     *      ID of the driver. This must be either the numeric ID generated by Samsara or the external ID of the driver.
     *      Driver ID must contain only digits 0-9. External IDs are customer specified key-value pairs and must contain only alphanumeric characters.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class.
     *      string [REQUIRED]
     *      Samsara API access token.
     *
     * [REQUEST BODY] | automatically included.
     *
     * Driver reactivation body
     *
     *      'reactivate'
     *      boolean [REQUIRED]
     *      True indicates that this driver should be reactivated.
     *
     * @param int $driver_id
     * @return bool|mixed
     */
    public function fleetActivateInactiveDriverById( int $driver_id )
    {

        $endpoint = "/fleet/drivers/inactive/{$driver_id}";
        $data = [
            // When combining query parameters and request body parameters in data, query params must be first.
            // Query Params
            'access_token' => $this->config['access_token'],
            // Request Params
            'reactivate' => true
        ];

        // Make API Call
        $result = samsara::callAPI('PUT', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }


    /**
     * fleetGetDriversSummary
     *
     * endpoint: /fleet/drivers/summary
     * Reactivate the inactive driver having id.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class.
     *      string [REQUIRED]
     *      Samsara API access token.
     *
     *      'snap_to_day_bounds'
     *      boolean
     *      Snap query result to HOS day boundaries.
     *
     * [REQUEST BODY]
     * Org ID and time range to query.
     *
     *      `endMs`
     *      integer <int64> [REQUIRED]
     *      End time (ms) of queried time period. Must be greater than startMs.
     *
     *      `orgId`
     *      integer <int64> [REQUIRED]
     *      Org ID to query.
     *
     *      `startMs`
     *      integer <int64> [REQUIRED]
     *      Start time (ms) of queried time period.
     *
     *
     * @param bool $snap_to_day
     * @param int $org_id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function fleetGetDriversSummary( bool $snap_to_day = false, int $org_id , int $start_time, int $end_time )
    {

        $endpoint = '/fleet/drivers/summary';
        $query_params = 2;
        $data = [
            // When combining query parameters and request body parameters in data, query params must be first.
            // Query Params
            'access_token' => $this->config['access_token'],
            'snap_to_day_bounds' => $snap_to_day,
            // Request Params
            'orgId' => $org_id,
            'startMs' => $start_time,
            'endMs' => $end_time
        ];

        // Make API Call
        $result = samsara::callAPI('GET/POST', $this->config['base_url'] . $endpoint, $data, $query_params);

        return $result;

    }

    /**
     * fleetGetDriverSafetyScoreById
     *
     * endpoint: /fleet/drivers/{driverId}/safety/score
     * Fetch the safety score for the driver.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driverId' as $driver_id
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
     * @param int $driver_id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function fleetGetDriverSafetyScoreById( int $driver_id, int $start_time, int $end_time )
    {

        $endpoint = "/fleet/drivers/{$driver_id}/safety/score";
        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'startMs' => $start_time,
            'endMs' => $end_time
        ];

        // Make API Call
        $result = samsara::callAPI( null, $this->config['base_url'] . $endpoint, $data );

        return $result;

    }

    /**
     * fleetGetDriverById
     *
     * endpoint: /fleet/drivers/{driver_id or external_id}
     * Fetch driver by id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driverId' as $driver_id
     *      integer <int64> Required
     *      ID of the driver. This must be either the numeric ID generated by Samsara or the external ID of the driver.
     *      Driver ID must contain only digits 0-9. External IDs are customer specified key-value pairs and must contain only alphanumeric characters.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class.
     *      string [REQUIRED]
     *      Samsara API access token.
     *
     * @param int $driver_id
     * @return bool|mixed
     */
    public function fleetGetDriverById( int $driver_id )
    {

        $endpoint = "/fleet/drivers/{$driver_id}";
        $data = [ 'access_token' => $this->config['access_token'] ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetUpdateDriverById
     *
     * endpoint: /fleet/drivers/{driver_id or external_id}
     * Update a driver by id or by external id
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driverId' as $driver_id
     *      integer <int64> Required
     *      ID of the driver. This must be either the numeric ID generated by Samsara or the external ID of the driver.
     *      Driver ID must contain only digits 0-9. External IDs are customer specified key-value pairs and must contain only alphanumeric characters.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class.
     *      string [REQUIRED]
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     * Driver update body
     *
     *      'tagIds '
     *      number <int64>
     *      A list of tag IDs.
     *
     *      'eldAdverseWeatherExemptionEnabled'
     *      boolean
     *      Flag indicating this driver may use Adverse Weather exemptions in ELD logs.
     *
     *      'eldBigDayExemptionEnabled'
     *      boolean
     *      Flag indicating this driver may use Big Day excemptions in ELD logs.
     *
     *      'eldDayStartHour'
     *      integer
     *      0 indicating midnight-to-midnight ELD driving hours, 12 to indicate noon-to-noon driving hours.
     *
     *      'eldExempt'
     *      boolean
     *      Flag indicating this driver is exempt from the Electronic Logging Mandate.
     *
     *      'eldExemptReason'
     *      string
     *      Reason that this driver is exempt from the Electronic Logging Mandate (see eldExempt).
     *
     *      'eldPcEnabled'
     *      boolean
     *      false
     *      Flag indicating this driver may select the Personal Conveyance duty status in ELD logs.
     *
     *      'eldYmEnabled'
     *      boolean
     *      false
     *      Flag indicating this driver may select the Yard Move duty status in ELD logs.
     *
     *      'externalIds'
     *      externalIds
     *      Dictionary of external IDs (string key-value pairs)
     *
     *      'groupId'
     *      integer <int64>
     *      ID of the group if the organization has multiple groups (uncommon).
     *
     *      'licenseNumber'
     *      string
     *      Driver's state issued license number.
     *
     *      'licenseState'
     *      string
     *      Abbreviation of state that issued driver's license.
     *
     *      'name'
     *      string Required
     *      Driver's name.
     *
     *      'notes'
     *      string
     *      Notes about the driver.
     *
     *      'phone'
     *      string
     *      Driver's phone number. Please include only digits, ex. 4157771234
     *
     *      'username'
     *      string
     *      Driver's login username into the driver app.
     *
     *      'vehicleId'
     *      integer <int64>
     *      ID of the vehicle assigned to the driver for static vehicle assignments. (uncommon).
     *
     * @param int $driver_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetUpdateDriverById(int $driver_id, array $request_body )
    {

        $endpoint = "/fleet/drivers/{$driver_id}";
        $data = [ 'access_token' => $this->config['access_token'] ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('PATCH', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetDeactivateDriverById
     *
     * endpoint: /fleet/drivers/{driver_id or external_id}
     * Deactivate a driver with the given id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driverId' as $driver_id
     *      integer <int64> Required
     *      ID of the driver. This must be either the numeric ID generated by Samsara or the external ID of the driver.
     *      Driver ID must contain only digits 0-9. External IDs are customer specified key-value pairs and must contain only alphanumeric characters.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class.
     *      string [REQUIRED]
     *      Samsara API access token.
     *
     * @param int $driver_id
     * @return bool|mixed
     */
    public function fleetDeactivateDriverById( int $driver_id )
    {

        $endpoint = "/fleet/drivers/{$driver_id}";
        $data = [ 'access_token' => $this->config['access_token'] ];

        // Make API Call
        $result = samsara::callAPI('DELETE', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDriverDispatchRoutesById
     *
     * endpoint: /fleet/drivers/{driver_id}/dispatch/routes
     * Fetch all of the dispatch routes for a given driver.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driverId' as $driver_id
     *      integer <int64> Required
     *      ID of the driver with the associated routes. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class.
     *      string [REQUIRED]
     *      Samsara API access token.
     *
     *      'end_time'
     *      integer <int64>
     *      Time in unix milliseconds that represents the oldest routes to return. Used in combination with duration. Defaults to now.
     *
     *      'duration'
     *      integer <int64>
     *      Time in milliseconds that represents the duration before end_time to query. Defaults to 24 hours.
     *
     * @param int $driver_id
     * @param int $end_time
     * @param int $duration
     * @return bool|mixed
     */
    public function fleetGetDriverDispatchRoutesById(int $driver_id, int $end_time, int $duration )
    {

        $endpoint = "/fleet/drivers/{$driver_id}/dispatch/routes";
        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'end_time' => $end_time,
            'duration' => $duration
        ];

        // Make API Call
        $result = samsara::callAPI( null, $this->config['base_url'] . $endpoint, $data );

        return $result;

    }

    /**
     * fleetAddDriverDispatchRoutes
     *
     * endpoint: /fleet/drivers/{driver_id}/dispatch/routes
     * Create a new dispatch route for the driver with driver_id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driver_id' as $driver_id
     *      integer <int64> Required
     *      ID of the driver with the associated routes. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'dispatch_jobs'
     *      Array opf DispatchJobCreate Required
     *      The dispatch jobs to create for this route.
     *
     *      'driver_id'
     *      integer <int64>
     *      ID of the driver assigned to the dispatch route. Note that driver_id and vehicle_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     *      'group_id'
     *      integer <int64>
     *      ID of the group if the organization has multiple groups (optional).
     *
     *      'name'
     *      string Required
     *      Descriptive name of this route.
     *
     *      'scheduled_end_ms'
     *      integer <int64>
     *      The time in Unix epoch milliseconds that the last job in the route is scheduled to end.
     *
     *      'scheduled_meters'
     *      integer <int64>
     *      The distance expected to be traveled for this route in meters.
     *
     *      'scheduled_start_ms'
     *      integer <int64> Required
     *      The time in Unix epoch milliseconds that the route is scheduled to start.
     *
     *      'start_location_address'
     *      string
     *      The address of the route's starting location, as it would be recognized if provided to maps.google.com. Optional if a valid start location address ID is provided.
     *
     *      'start_location_address_id'
     *      integer <int64>
     *      ID of the start location associated with an address book entry. Optional if valid values are provided for start location address or latitude/longitude. If a valid start location address ID is provided, address/latitude/longitude will be used from the address book entry. Name of the address book entry will only be used if the start location name is not provided.
     *
     *      'start_location_lat'
     *      number <double>
     *      Latitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_lng'
     *      number <double>
     *      Longitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_name'
     *      string
     *      The name of the route's starting location. If provided, it will take precedence over the name of the address book entry.
     *
     *      'trailer_id'
     *      integer <int64>
     *      ID of the trailer assigned to the dispatch route. Note that trailers can only be assigned to routes that have a Vehicle or Driver assigned to them.
     *
     *      'vehicle_id'
     *      integer <int64>
     *      ID of the vehicle assigned to the dispatch route. Note that vehicle_id and driver_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     * @param int $driver_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetAddDriverDispatchRoutes( int $driver_id, array $request_body )
    {

        $endpoint = "/fleet/drivers/{$driver_id}/dispatch/routes";
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetAddDocumentByDriverId
     *
     * endpoint: /fleet/drivers/{driver_id}/documents
     * Create a driver document for the given driver.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driver_id' as $driver_id
     *      integer <int64> Required
     *      ID of the driver with the associated routes. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     * To create a document for a given document type, the document type's uuid needs to be passed in to documentTypeUuid. The list of fields passed in should match the document type’s list of field types in the correct order. In other words, a field's valueType and value (i.e. only one of: stringValue, numberValue, or photoValue) at index i should match with the document field type’s valueType at index i.
     *
     *      'documentTypeUuid'
     *      string Required
     *      Universally unique identifier for the document type this document is being created for.
     *
     *      'fields'
     *      DocumentField Required
     *      List of fields and associated values for a given document.
     *      The fields must be listed in the order that that they appear in the specified document type.
     *      Today stringValue and numberValue are the two supported document upload field types.
     *
     *      'dispatchJobId'
     *      integer <int64>
     *      ID of the Samsara dispatch job for which the document is submitted
     *
     *      'notes'
     *      string
     *      Notes submitted with this document.
     *
     * @param int $driver_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetAddDocumentByDriverId(int $driver_id, array $request_body )
    {

        $endpoint = "/fleet/drivers/{$driver_id}/documents";
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI("GET/POST", $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDocumentByDriverIdAndDocumentId
     *
     * endpoint: /fleet/drivers/{driver_id}/documents/{document_id}
     * Fetches a single document submission by driver.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driver_id' as $driver_id
     *      integer <int64> Required
     *      ID of the driver with the associated routes. Must contain only digits 0-9.
     *
     *      'document_id' as $document_id
     *      string Required
     *      ID of document.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access tokenn
     *
     * @param int $driver_id
     * @param string $document_id
     * @return bool|mixed
     */
    public function fleetGetDocumentByDriverIdAndDocumentId(int $driver_id, string  $document_id )
    {

        $endpoint = "/fleet/drivers/{$driver_id}/documents/{$document_id}";
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }


    /**
     * fleetGetHOSLogsByDriverId
     *
     * endpoint: /fleet/drivers/{driver_id:[0-9]+}/hos_daily_logs
     * Get summarized daily HOS charts for a specified driver.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driver_id'
     *      integer <int64> Required
     *      ID of the driver with the associated routes. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] the following are included automatically in $request_body
     *
     *      'driverId'
     *      integer <int64> Required
     *      Driver ID to query.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Group ID to query.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'endMs'
     *      integer Required
     *      End of the time range, specified in milliseconds UNIX time.
     *
     *      'startMs'
     *      integer Required
     *      Beginning of the time range, specified in milliseconds UNIX time.
     *
     * @param int $driver_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetGetHOSLogsByDriverId(int $driver_id, array $request_body )
    {

        $endpoint = "/fleet/drivers/{$driver_id}/hos_daily_logs";
        $data = [
            'access_token' => $this->config['access_token'],
            'driverId' => $driver_id,
            'groupId' => $this->config['group_id']
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('GET/POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetHOSAuthLogs
     *
     * endpoint: /fleet/hos_authentication_logs
     * Get the HOS (hours of service) signin and signout logs for the specified driver. Only signout logs include location information.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'driverId'
     *      integer <int64> Required
     *      Driver ID to query.
     *
     *      'endMs'
     *      integer Required
     *      End of the time range, specified in milliseconds UNIX time.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Group ID to query.
     *
     *      'startMs'
     *      integer Required
     *      Beginning of the time range, specified in milliseconds UNIX time.
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetGetHOSAuthLogs(array $request_body )
    {

        $endpoint = '/fleet/hos_authentication_logs';
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetHOSLogs
     *
     * endpoint: /fleet/hos_logs
     * Get the HOS (hours of service) logs for the specified driver. This method returns all the HOS statuses that the driver was in during this time period.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'driverId'
     *      integer <int64> Required
     *      Driver ID to query.
     *
     *      'endMs'
     *      integer Required
     *      End of the time range, specified in milliseconds UNIX time.
     *
     *      'groupId'
     *      integer <int64> Required
     *      Group ID to query.
     *
     *      'startMs'
     *      integer Required
     *      Beginning of the time range, specified in milliseconds UNIX time.
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetGetHOSLogs(array $request_body )
    {

        $endpoint = '/fleet/hos_logs';
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetHOSLogSummary
     *
     * endpoint: /fleet/hos_logs_summary
     * Get the current HOS status for all drivers in the group.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'groupId'
     *      integer <int64> Required
     *      Group ID to query.
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetGetHOSLogSummary()
    {

        $endpoint = '/fleet/hos_logs_summary';
        $data = [
            'access_token' => $this->config['access_token'],
            'groupId' => $this->config['group_id']
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetVehicleList
     *
     * endpoint: /fleet/list
     * Get list of the vehicles. This method returns a list of the vehicles in the Samsara Cloud and information about them.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startingAfter'
     *      string
     *      Pagination parameter indicating the cursor position to continue returning results after.
     *      Used in conjunction with the 'limit' parameter. Mutually exclusive with 'endingBefore' parameter.
     *
     *      'endingBefore'
     *      string
     *      Pagination parameter indicating the cursor position to return results before. Used in conjunction with the 'limit' parameter.
     *      Mutually exclusive with 'startingAfter' parameter.
     *
     *      'limit'
     *      number <int64>
     *      Pagination parameter indicating the number of results to return in this request. Used in conjunction with either 'startingAfter' or 'endingBefore'.
     *
     *      'groupId' | If not included, 'group_id' from config class will be used
     *      @todo Let Samsara know that the change in naming conventions causes confusion when building out api functionality
     *      integer <int64> Required
     *      Group ID to query.
     *
     * @param string|null $startingAfter
     * @param string|null $endingBefore
     * @param int|null $limit
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function fleetGetVehicleList( string $startingAfter = null, string $endingBefore = null, int $limit = null, int $group_id = null )
    {

        $endpoint = '/fleet/list';

        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // If $startingAfter is not null add to $data array
        if(!empty($startingAfter)) {
            $tempData = [
                'startingAfter' => $startingAfter
            ];

            $data = $data + $tempData;
        }

        // If $endingBefore is not null add to $data array
        if(!empty($endingBefore)) {
            $tempData = [
                'endingBefore' => $endingBefore
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

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetLocations
     *
     * endpoint: /fleet/locations
     * Get current location of vehicles in a group. This method returns the current location in latitude and longitude of all vehicles in a requested group.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'groupId' | If not included, 'group_id' from config class will be used
     *      @todo Let Samsara know that the change in naming conventions causes confusion when building out api functionality
     *      integer <int64> Required
     *      Group ID to query.
     *
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function fleetGetLocations( int $group_id = null )
    {

        $endpoint = '/fleet/locations';
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetMaintenanceDVIRs
     *
     * endpoint: //fleet/maintenance/dvirs
     * Get DVIRs for the org within provided time constraints
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'end_ms'
     *      integer Required
     *      time in millis until the last dvir log.
     *
     *      'duration_ms'
     *      integer Required
     *      time in millis which corresponds to the duration before the end_ms.
     *
     *      'groupId'
     *      integer
     *      Group ID to query.
     *
     * @param int $end_ms
     * @param int $duration_ms
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function fleetGetMaintenanceDVIRs(int $end_ms, int $duration_ms, int $group_id = null )
    {

        $endpoint = '/fleet/maintenance/dvirs';

        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // If $end_ms is not null add to $data array
        if(!empty($end_ms)) {
            $tempData = [
                'end_ms' => $end_ms
            ];

            $data = $data + $tempData;
        }

        // If $duration_ms is not null add to $data array
        if(!empty($duration_ms)) {
            $tempData = [
                'duration_ms' => $duration_ms
            ];

            $data = $data + $tempData;
        }

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetAddMaintenanceDVIRs
     *
     * endpoint: /fleet/maintenance/dvirs
     * Create a new dvir, marking a vehicle or trailer, safe or unsafe.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     * DVIR creation body
     *
     *      'inspectionType' "mechanic"
     *      string Required
     *      Only type 'mechanic' is currently accepted.
     *
     *      'mechanicNotes'
     *      string
     *      Any notes from the mechanic.
     *
     *      'odometerMiles'
     *      integer
     *      The current odometer of the vehicle.
     *
     *      'previousDefectsCorrected'
     *      boolean
     *      Whether any previous defects were corrected. If this vehicle or trailer was previously marked unsafe, and this DVIR marks it as safe, either previousDefectsCorrected or previousDefectsIgnored must be true.
     *
     *      'previousDefectsIgnored'
     *      boolean
     *      Whether any previous defects were ignored. If this vehicle or trailer was previously marked unsafe, and this DVIR marks it as safe, either previousDefectsCorrected or previousDefectsIgnored must be true.
     *
     *      'safe'
     *      string Required
     *      "safe", "unsafe"
     *      Whether or not this vehicle or trailer is safe to drive.
     *
     *      'trailerId'
     *      integer
     *      Id of trailer being inspected. Either vehicleId or trailerId must be provided.
     *
     *      'userEmail'
     *      string Required
     *      The Samsara login email for the person creating the DVIR. The email must correspond to a Samsara user's email.
     *
     *      'vehicleId'
     *      integer
     *      Id of vehicle being inspected. Either vehicleId or trailerId must be provided.
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetAddMaintenanceDVIRs( array $request_body )
    {

        $endpoint = '/fleet/maintenance/dvirs';
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetMaintenanceList
     *
     * endpoint: /fleet/maintenance/list
     * Get list of the vehicles with any engine faults or check light data.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'groupId' | If not included, 'group_id' from config class will be used
     *      @todo Let Samsara know that the change in naming conventions causes confusion when building out api functionality
     *      integer <int64> Required
     *      Group ID to query.
     *
     *
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function fleetGetMaintenanceList( int $group_id = null )
    {

        $endpoint = '/fleet/maintenance/list';

        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetSetMetaData
     *
     * endpoint: /fleet/set_data
     * This method enables the mutation of metadata for vehicles in the Samsara Cloud.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body with the following keys
     *
     *      'vehicles'
     *      Array of objects Required
     *      A vehicle object.
     *
     *              Array [
     *                      'id'
     *                      id (integer) <int64> Required
     *                      ID of the vehicle.
     *
     *                      'name'
     *                      name (string)
     *                      Name of the vehicle.
     *
     *                      'note'
     *                      note (string)
     *                    ]
     *
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetSetMetaData( array $request_body )
    {

        $endpoint = '/fleet/set_data';
        $data = [
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI('POST', $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetTrailersAssignments
     *
     * endpoint: /fleet/trailers/assignments
     * Fetch trailer assignment data for all trailers in your organization.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs' as $start_time
     *      integer <int64>
     *      Timestamp in Unix epoch miliseconds representing the start of the period to fetch. Omitting both startMs and endMs only returns current assignments.
     *
     *      'endMs' as $end_time
     *      integer <int64>
     *      Timestamp in Unix epoch miliseconds representing the end of the period to fetch. Omitting endMs sets endMs as the current time
     *
     *      'limit' as $limit
     *      number <int64>
     *      Pagination parameter indicating the number of results to return in this request. Used in conjunction with either 'startingAfter' or 'endingBefore'.
     *
     *      'startingAfter' as $startingAfter
     *      string
     *      Pagination parameter indicating the cursor position to continue returning results after. Used in conjunction with the 'limit' parameter.
     *      Mutually exclusive with 'endingBefore' parameter.
     *
     *      'endingBefore' as $endingBefore
     *      string
     *      Pagination parameter indicating the cursor position to return results before. Used in conjunction with the 'limit' parameter.
     *      Mutually exclusive with 'startingAfter' parameter.
     *
     * @param int|null $start_time
     * @param int|null $end_time
     * @param int|null $limit
     * @param string|null $startingAfter
     * @param string|null $endingBefore
     * @return bool|mixed
     */
    public function fleetGetTrailersAssignments( int $start_time = null, int $end_time = null, int $limit = null, string $startingAfter = null, string $endingBefore =  null )
    {

        $endpoint = '/fleet/trailers/assignments';

        $data = [
            'access_token' => $this->config['access_token'],
        ];

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

        // If $limit is not null add to $data array
        if(!empty($limit)) {
            $tempData = [
                'limit' => $limit
            ];

            $data = $data + $tempData;
        }

        // If $startingAfter is not null add to $data array
        if(!empty($startingAfter)) {
            $tempData = [
                'startingAfter' => $startingAfter
            ];

            $data = $data + $tempData;
        }

        // If $endingBefore is not null add to $data array
        if(!empty($endingBefore)) {
            $tempData = [
                'endingBefore' => $endingBefore
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetAssignmentsTrailerById
     * @todo testing is not enabled on this method
     *
     * endpoint: /fleet/trailers/{trailerId}/assignments
     * Fetch trailer assignment data for all trailers in your organization.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'trailerId' as $trailer_id
     *      integer <int64> Required
     *      ID of trailer. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs' as $start_time
     *      integer <int64>
     *      Timestamp in Unix epoch milliseconds representing the start of the period to fetch.
     *      Omitting both startMs and endMs only returns current assignments.
     *
     *      'endMs' as $end_time
     *      integer <int64>
     *      Timestamp in Unix epoch milliseconds representing the end of the period to fetch.
     *      Omitting endMs sets endMs as the current time.
     *
     * @param int $trailer_id
     * @param int|null $start_time
     * @param int|null $end_time
     * @return bool|mixed
     */
    public function fleetGetAssignmentsTrailerById( int $trailer_id, int $start_time = null, int $end_time = null )
    {

        $endpoint = "/fleet/trailers/{$trailer_id}/assignments";

        $data = [
            'access_token' => $this->config['access_token'],
        ];

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
     * fleetGetTrips
     *
     * endpoint: /fleet/trips
     * Get historical trips data for specified vehicle. This method returns a set of historical trips data for the specified vehicle in the specified time range.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'groupId' as $group_id
     *      integer <int64> Required
     *      Group ID to query.
     *
     *      'vehicleId' as $vehicle_id
     *      integer <int64> Required
     *      Vehicle ID to query.
     *
     *      'startMs' as $start_time
     *      integer Required
     *      Beginning of the time range, specified in milliseconds UNIX time. Limited to a 90 day window with respect to startMs and endMs
     *
     *      'endMs' as $end_time
     *      integer Required
     *      End of the time range, specified in milliseconds UNIX time.
     *
     * @param int $group_id
     * @param int $vehicle_id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function fleetGetTrips( int $group_id, int $vehicle_id, int $start_time, int $end_time )
    {

        $endpoint = '/fleet/trips';
        $data = [
            'access_token' => $this->config['access_token'],
            'vehicleId' => $vehicle_id,
            'startMs' => $start_time,
            'endMs' => $end_time
        ];

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetVehicleLocations
     *
     * endpoint: /fleet/vehicles/locations
     * Fetch locations for a given vehicle between a start/end time. The maximum query duration is 30 minutes.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs'
     *      integer Required
     *      Time in Unix epoch milliseconds for the start of the query (cannot exceed 30 minutes)
     *
     *      'endMs'
     *      integer Required
     *      Time in Unix epoch milliseconds for the end of the query (cannot exceed 30 minutes)
     *
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function fleetGetVehicleLocations( int $start_time, int $end_time )
    {

        $endpoint = '/fleet/vehicles/locations';
        $data = [
            'access_token' => $this->config['access_token'],
            'startMs' => $start_time,
            'endMs' => $end_time
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetVehicleStats
     *
     * endpoint: /fleet/vehicles/stats
     * Fetch engine state and aux input data for all vehicles in the group between a start/end time.
     * Data returned may be affected by device connectivity and processing time.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs'
     *      integer Required
     *      Time in Unix epoch milliseconds for the start of the query.
     *
     *      'endMs'
     *      integer Required
     *      Time in Unix epoch milliseconds for the end of the query.
     *
     *      'series'
     *      string
     *      "engineState" "auxInput1" "auxInput2"
     *      Comma-separated list of stat types. Options are engineState, auxInput1, and auxInput2. If this parameter is excluded, all 3 stat types will be returned. Example: series=engineState,auxInput2
     *
     *      'tagIds'
     *      string
     *      Comma-separated list of tag ids. Example: tagIds=1,2,3
     *
     *      'startingAfter'
     *      string
     *      Pagination parameter indicating the cursor position to continue returning results after.
     *      Used in conjunction with the 'limit' parameter. Mutually exclusive with 'endingBefore' parameter.
     *
     *      'endingBefore'
     *      string
     *      Pagination parameter indicating the cursor position to return results before. Used in conjunction with the 'limit' parameter.
     *      Mutually exclusive with 'startingAfter' parameter.
     *
     *      'limit'
     *      number <int64>
     *      Pagination parameter indicating the number of results to return in this request. Used in conjunction with either 'startingAfter' or 'endingBefore'.
     *
     * @param int $start_time
     * @param int $end_time
     * @param string|null $series
     * @param int|null $tagIds
     * @param string|null $startingAfter
     * @param string|null $endingBefore
     * @param int|null $limit
     * @return bool|mixed
     */
    public function fleetGetVehicleStats( int $start_time, int $end_time, string $series = null, int $tagIds = null, string $startingAfter = null, string $endingBefore = null, int $limit = null )
    {

        $endpoint = '/fleet/vehicles/stats';

        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'startMs' => $start_time,
            'endMs' => $end_time
        ];

        // If $series is not null add to $data array
        if(!empty($series)) {
            $tempData = [
                'series' => $series
            ];

            $data = $data + $tempData;
        }

        // If $tagIds is not null add to $data array
        if(!empty($tagIds)) {
            $tempData = [
                'tagIds' => $tagIds
            ];

            $data = $data + $tempData;
        }

        // If $startingAfter is not null add to $data array
        if(!empty($startingAfter)) {
            $tempData = [
                'startingAfter' => $startingAfter
            ];

            $data = $data + $tempData;
        }

        // If $endingBefore is not null add to $data array
        if(!empty($endingBefore)) {
            $tempData = [
                'endingBefore' => $endingBefore
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     *
     * fleetGetVehicleSafetyScoreById
     *
     * endpoint: /fleet/vehicles/{vehicleId}/safety/score
     * Fetch the safety score for the vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicleId' as $vehicle_id
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
     * @param int $vehicle_id
     * @param int $start_time
     * @param int $end_time
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function fleetGetVehicleSafetyScoreById(int $vehicle_id, int $start_time, int $end_time, int $group_id = null)
    {

        $endpoint = "/fleet/vehicles/{$vehicle_id}/safety/score";

        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'startMs' => $start_time,
            'endMs' => $end_time
        ];

        // If $group_id is not null add to $data array
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
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetVehicleSafetyHarshEventsById
     *
     * endpoint: /fleet/vehicles/{vehicleId}/safety/harsh_event
     * Fetch harsh event details for a vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicleId' as $vehicle_id
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
     * @param int $vehicle_id
     * @param int $timestamp
     * @return bool|mixed
     */
    public function fleetGetVehicleSafetyHarshEventsById(int $vehicle_id, int $timestamp )
    {

        $endpoint = "/fleet/vehicles/{$vehicle_id}/safety/harsh_event";

        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'vehicleId' => $vehicle_id,
            'timestamp' => $timestamp
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetVehicleById
     *
     * endpoint: /fleet/vehicles/{vehicle_id or external_id}
     * Gets a specific vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicle_id_or_external_id' as $vehicle_id
     *      string Required
     *      ID of the vehicle. This must be either the numeric ID generated by Samsara or the external ID of the vehicle.
     *      Vehicle ID must contain only digits 0-9.
     *      External IDs are customer specified key-value pairs and must contain only alphanumeric characters.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param string $vehicle_id
     * @return bool|mixed
     */
    public function fleetGetVehicleById(string $vehicle_id )
    {

        $endpoint = "/fleet/vehicles/{$vehicle_id}";

        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'vehicleId' => $vehicle_id,
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetUpdateVehicleById
     *
     * endpoint: /fleet/vehicles/{vehicle_id or external_id}
     * Gets a specific vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicle_id_or_external_id' as $vehicle_id
     *      string Required
     *      ID of the vehicle. This must be either the numeric ID generated by Samsara or the external ID of the vehicle.
     *      Vehicle ID must contain only digits 0-9.
     *      External IDs are customer specified key-value pairs and must contain only alphanumeric characters.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body | array with the following keys.
     *
     *      'externalIds' | array of key value pairs of external ids
     *      <Additional Properties> => string
     *
     *      'harsh_accel_setting'
     *      integer <string>
     *      "Passenger" "Light Truck" "Heavy" "Off" "Auto"
     *      Harsh Event Detection Setting
     *
     *      0: Passenger
     *      1: Light Truck
     *      2: Heavy
     *      3: Off
     *      4: Automatic
     *
     *      'name'
     *      string
     *      Name
     *
     * @param string $vehicle_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetUpdateVehicleById(string $vehicle_id, array $request_body )
    {

        $endpoint = "/fleet/vehicles/{$vehicle_id}";

        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'vehicleId' => $vehicle_id,
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetDispatchRoutesByVehicleId
     *
     * endpoint: /fleet/vehicles/{vehicle_id}/dispatch/routes
     * Fetch all of the dispatch routes for a given vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicle_id' as $vehicle_id
     *      integer <int64> Required
     *      ID of the vehicle with the associated routes. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'end_time'
     *      integer <int64>
     *      Time in unix milliseconds that represents the oldest routes to return. Used in combination with duration. Defaults to now.
     *
     *      'duration'
     *      integer <int64>
     *      Time in milliseconds that represents the duration before end_time to query. Defaults to 24 hours.
     *
     * @param int $vehicle_id
     * @param int|null $end_time
     * @param int|null $duration
     * @return bool|mixed
     */
    public function fleetGetDispatchRoutesByVehicleId(int $vehicle_id, int $end_time = null, int $duration = null )
    {

        $endpoint = "/fleet/vehicles/{$vehicle_id}/dispatch/routes";

        // Set $query_params to 1
        $query_params = 1;
        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
        ];

        // If $end_time is not null add to $data array
        if(!empty($end_time)) {
            $tempData = [
                'end_time' => $end_time
            ];

            $data = $data + $tempData;
        }

        // If $duration is not null add to $data array
        if(!empty($duration)) {
            $tempData = [
                'duration' => $duration
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetCreateDispatchRoutesByVehicleId
     *
     * endpoint: /fleet/vehicles/{vehicle_id}/dispatch/routes
     * Fetch all of the dispatch routes for a given vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicle_id' as $vehicle_id
     *      integer <int64> Required
     *      ID of the vehicle with the associated routes. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body | array with the following keys.
     *
     *      'dispatch_jobs'
     *      DispatchJobCreate Required
     *      The dispatch jobs to create for this route.
     *
     *      array [
     *
     *              'destination_address'
     *              string
     *              The address of the job destination, as it would be recognized if provided to maps.google.com. Optional if a valid destination address ID is provided.
     *
     *              'destination_address_id'
     *              integer <int64>
     *              ID of the job destination associated with an address book entry. Optional if valid values are provided for destination address and latitude/longitude. If a valid destination address ID is provided, address/latitude/longitude will be used from the address book entry. Name of the address book entry will only be used if the destination name is not provided.
     *
     *              'destination_lat'
     *              number <double>
     *              Latitude of the destination in decimal degrees. Optional if a valid destination address ID is provided.
     *
     *              'destination_lng'
     *              number <double>
     *              Longitude of the destination in decimal degrees. Optional if a valid destination address ID is provided.
     *
     *              'destination_name'
     *              string
     *              The name of the job destination. If provided, it will take precedence over the name of the address book entry.
     *
     *              'notes'
     *              string
     *              Notes regarding the details of this job.
     *
     *              'scheduled_arrival_time_ms'
     *              integer <int64> Required
     *              The time at which the assigned driver is scheduled to arrive at the job destination.
     *
     *              'scheduled_departure_time_ms'
     *              integer <int64>
     *              The time at which the assigned driver is scheduled to depart from the job destination.
     *
     *      ]
     *
     *      'driver_id'
     *      integer <int64>
     *      ID of the driver assigned to the dispatch route. Note that driver_id and vehicle_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     *      'group_id'
     *      integer <int64>
     *      ID of the group if the organization has multiple groups (optional).
     *
     *      'name'
     *      string Required
     *      Descriptive name of this route.
     *
     *      'scheduled_end_ms'
     *      integer <int64>
     *      The time in Unix epoch milliseconds that the last job in the route is scheduled to end.
     *
     *      'scheduled_meters'
     *      integer <int64>
     *      The distance expected to be traveled for this route in meters.
     *
     *      'scheduled_start_ms'
     *      integer <int64> Required
     *      The time in Unix epoch milliseconds that the route is scheduled to start.
     *
     *      'start_location_address'
     *      string
     *      The address of the route's starting location, as it would be recognized if provided to maps.google.com. Optional if a valid start location address ID is provided.
     *
     *      'start_location_address_id'
     *      integer <int64>
     *      ID of the start location associated with an address book entry. Optional if valid values are provided for start location address and latitude/longitude. If a valid start location address ID is provided, address/latitude/longitude will be used from the address book entry. Name of the address book entry will only be used if the start location name is not provided.
     *
     *      'start_location_lat'
     *      number <double>
     *      Latitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_lng'
     *      number <double>
     *      Longitude of the start location in decimal degrees. Optional if a valid start location address ID is provided.
     *
     *      'start_location_name'
     *      string
     *      The name of the route's starting location. If provided, it will take precedence over the name of the address book entry.
     *
     *      'trailer_id'
     *      integer <int64>
     *      ID of the trailer assigned to the dispatch route. Note that trailers can only be assigned to routes that have a Vehicle or Driver assigned to them.
     *
     *      'vehicle_id'
     *      integer <int64>
     *      ID of the vehicle assigned to the dispatch route. Note that vehicle_id and driver_id are mutually exclusive. If neither is specified, then the route is unassigned.
     *
     * @param int $vehicle_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function fleetCreateDispatchRoutesByVehicleId(int $vehicle_id, array $request_body )
    {

        $endpoint = "/fleet/vehicles/{$vehicle_id}/dispatch/routes";

        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * fleetGetVehicleLocationsByVehicleId
     *
     * endpoint: /fleet/vehicles/{vehicle_id}/locations
     * Fetch locations for a given vehicle between a start/end time. The maximum query duration is one hour.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicle_id' as $vehicle_id
     *      integer <int64> Required
     *      ID of the vehicle with the associated routes. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     *      'startMs' as $start_time
     *      integer <int64> Required
     *      Time in Unix epoch milliseconds for the start of the query (cannot exceed 1 hour)
     *
     *      'endMs' as $end_time
     *      integer <int64> Required
     *      Time in Unix epoch milliseconds for the end of the query (cannot exceed 1 hour)
     *
     * @param int $vehicle_id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function fleetGetVehicleLocationsByVehicleId(int $vehicle_id, int $start_time, int $end_time)
    {

        $endpoint = "/fleet/vehicles/{$vehicle_id}/locations";

        $data = [
            // Query Params
            'access_token' => $this->config['access_token'],
            'startMs' => $start_time,
            'endMs' => $end_time
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;

    }

    /**
     * The object is created from within the class itself
     * only if the class has no instance.
     * @return null|fleet
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new fleet();
        }

        return self::$instance;
    }

}
