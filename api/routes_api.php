<?
/*
Samsara API Routes Class
*/

namespace samsara_php\api;

use samsara_php\config;

class routes extends config {

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
     * routes constructor.
     */
    function __construct()
    {
        parent::__construct();

        // Pull in fleet_api for duplicate endpoints that fall under both fleet & assets api's to create a wrapper for existing methods
        $this::$fleet_api = \samsara_php\api\fleet::getInstance();
    }

    /**
     * routesGetDispatchRoutes
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
    public function routesGetDispatchRoutes( int $group_id = null, int $end_time, int $duration )
    {

        return $this::$fleet_api->fleetGetDispatchRoutes( $group_id, $end_time, $duration );

    }

    /**
     * routesAddDispatchRoute
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
    public function routesAddDispatchRoute( array $request_body )
    {

        return $this::$fleet_api->fleetAddDispatchRoute( $request_body );

    }

    /**
     * routesGetDispatchRoutesJobUpdates
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
    public function routesGetDispatchRoutesJobUpdates( int $group_id = null, int $sequence_id = null, string $include = null )
    {

        return $this::$fleet_api->fleetGetDispatchRoutesJobUpdates( $group_id, $sequence_id, $include );

    }

    /**
     * routesGetDispatchRouteById
     *
     * endpoint: /fleet/dispatch/routes/{route_id}
     * Fetch a dispatch route by id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'route_id' as $id
     *      integer <int64> Required
     *      ID of the dispatch route. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token'
     *      string Required
     *      Samsara API access token.
     *
     * @param int $id
     * @return bool|mixed
     */
    public function routesGetDispatchRouteById( int $id )
    {

        return $this::$fleet_api->fleetGetDispatchRouteById( $id );

    }

    /**
     * routesDeleteDispatchRouteById
     *
     * endpoint: /fleet/dispatch/routes/{route_id}
     * Delete a dispatch route and its associated jobs.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'route_id' as $id
     *      integer <int64> Required
     *      ID of the dispatch route. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $id
     * @return bool|mixed
     */
    public function routesDeleteDispatchRouteById( int $id )
    {

        return $this::$fleet_api->fleetDeleteDispatchRouteById( $id );

    }

    /**
     * routesGetDispatchRouteHistory
     *
     * endpoint: /fleet/dispatch/routes/{route_id}/history
     * Fetch the history of a dispatch route.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'route_id'
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
     * @param int|null $id
     * @param int $start_time
     * @param int $end_time
     * @return bool|mixed
     */
    public function routesGetDispatchRouteHistory( int $id, int $start_time = null, int $end_time = null )
    {

        return $this::$fleet_api->fleetGetDispatchRouteHistory( $id, $start_time, $end_time );

    }

    /**
     * routesGetDriverDispatchRoutes
     *
     * endpoint: /fleet/drivers/{driver_id}/dispatch/routes
     * Deactivate a driver with the given id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'driverId' as $id
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
     * @param int $id
     * @param int $end_time
     * @param int $duration
     * @return bool|mixed
     */
    public function routesGetDriverDispatchRoutes(int $id, int $end_time, int $duration )
    {

        return $this::$fleet_api->fleetGetDispatchRouteHistory( $id, $end_time, $duration );

    }

    /**
     * routesAddDriverDispatchRoutes
     *
     * endpoint: /fleet/drivers/{driver_id}/dispatch/routes
     * Create a new dispatch route for the driver with driver_id.
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
    public function routesAddDriverDispatchRoutes( int $id, array $request_body )
    {

        return $this::$fleet_api->fleetAddDriverDispatchRoutes( $id, $request_body );

    }

    /**
     * routesGetDispatchRoutesByVehicleId
     *
     * endpoint: /fleet/vehicles/{vehicle_id}/dispatch/routes
     * Fetch all of the dispatch routes for a given vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicle_id' as $id
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
     * @param int $id
     * @param int|null $end_time
     * @param int|null $duration
     * @return bool|mixed
     */
    public function routesGetDispatchRoutesByVehicleId(int $id, int $end_time = null, int $duration = null )
    {

        return $this::$fleet_api->fleetGetDispatchRoutesByVehicleId( $id, $end_time, $duration );

    }

    /**
     * routesCreateDispatchRoutesByVehicleId
     *
     * endpoint: /fleet/vehicles/{vehicle_id}/dispatch/routes
     * Fetch all of the dispatch routes for a given vehicle.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'vehicle_id' as $id
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
     * @param int $id
     * @param array $request_body
     * @return bool|mixed
     */
    public function routesCreateDispatchRoutesByVehicleId(int $id, array $request_body )
    {

        return $this::$fleet_api->fleetCreateDispatchRoutesByVehicleId( $id, $request_body );

    }

    /**
     * getInstance
     *
     * The object is created from within the class itself
     * only if the class has no instance.
     *
     * @return null|routes
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new routes();
        }

        return self::$instance;
    }

}