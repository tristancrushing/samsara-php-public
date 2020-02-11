<?php
/*
Samsara API Tags Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class tags
 * @package samsara_php\api
 */
class tags extends config {

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
     * tags constructor.
     */
    function __construct()
    {
        parent::__construct();

    }


    /**
     * tagsGetTags
     *
     * endpoint: /tags
     * Fetch all of the tags for a group.
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
     *      integer <int64>
     *      Optional group ID if the organization has multiple groups (uncommon).
     *
     * @param int|null $group_id
     * @return bool|mixed
     */
    public function tagsGetTags(int $group_id = null )
    {
        $endpoint = '/tags';
        $data = [
            'access_token' => $this->config['access_token']
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
     * tagsCreateTag
     *
     * endpoint: /tags
     * Create a new tag for the group.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body array of objects/arrays
     *
     *      'assets'
     *      Array of TaggedAssetBase
     *      The assets that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Asset being tagged.
     *          ]
     *
     *      'drivers'
     *      Array ofTaggedDriverBase
     *      The drivers that belong to this tag.
     *
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Driver being tagged.
     *          ]
     *
     *      'machines'
     *      Array of TaggedMachineBase
     *      The machines that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Machine being tagged.
     *          ]
     *
     *      'sensors'
     *      Array of TaggedSensorBase
     *      The sensors that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Sensor being tagged.
     *          ]
     *
     *      'vehicles'
     *      Array of TaggedVehicleBase
     *      The vehicles that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Vehicle being tagged.
     *          ]
     *
     *      'name'
     *      string Required
     *      Name of this tag.
     *
     *      'parentTagId'
     *      integer <int64>
     *      If this tag is part a hierarchical tag tree as a child tag, the parentTagId is the ID of this tag's parent tag.
     *
     * @param array $request_body
     * @return mixed
     */
    public function tagsCreateTag( array $request_body )
    {
        $endpoint = '/tags';
        $data = [
            'access_token' => $this->config['access_token']
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI("GET/POST", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * tagsGetTagById
     *
     * endpoint: /tags/{tag_id}
     * Fetch a tag by id.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'tag_id'
     *      integer <int64> Required
     *      ID of the tag. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $tag_id
     * @return mixed
     */
    public function tagsGetTagById( int $tag_id )
    {
        $endpoint = "/tags/{$tag_id}";
        $data = [
            'access_token' => $this->config['access_token']
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * tagsUpdateTag
     *
     * endpoint: /tags/{tag_id}
     * Update a tag with a new name and new members.
     * This API call would replace all old members of a tag with new members specified in the request body.
     * To modify only a few devices associated with a tag use the PATCH endpoint.
     *
     * [PARAMETERS]
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY] as $request_body array of objects/arrays
     *
     *      'assets'
     *      Array of TaggedAssetBase
     *      The assets that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Asset being tagged.
     *          ]
     *
     *      'drivers'
     *      Array ofTaggedDriverBase
     *      The drivers that belong to this tag.
     *
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Driver being tagged.
     *          ]
     *
     *      'machines'
     *      Array of TaggedMachineBase
     *      The machines that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Machine being tagged.
     *          ]
     *
     *      'sensors'
     *      Array of TaggedSensorBase
     *      The sensors that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Sensor being tagged.
     *          ]
     *
     *      'vehicles'
     *      Array of TaggedVehicleBase
     *      The vehicles that belong to this tag.
     *
     *          Array[
     *              'id'
     *              integer <int64> Required
     *              The ID of the Vehicle being tagged.
     *          ]
     *
     *      'name'
     *      string Required
     *      Name of this tag.
     *
     *      'parentTagId'
     *      integer <int64>
     *      If this tag is part a hierarchical tag tree as a child tag, the parentTagId is the ID of this tag's parent tag.
     *
     * @param int $tag_id
     * @param array $request_body
     * @return mixed
     */
    public function tagsUpdateTag( int $tag_id, array $request_body )
    {
        $endpoint = "/tags/{$tag_id}";
        $data = [
            'access_token' => $this->config['access_token']
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI("PUT", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * tagsPatchTag
     *
     * endpoint: /tags/{tag_id}
     * Add or delete specific members from a tag, or modify the name of a tag.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'tag_id'
     *      integer <int64> Required
     *      ID of the tag. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY]
     *
     *      'add'
     *      Array of arrays/objects add
     *      Specify devices, etc. that should be added to the tag.
     *
     *              'assets'
     *              Array of TaggedAssetBase
     *              The assets that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Asset being tagged.
     *                  ]
     *
     *              'drivers'
     *              Array ofTaggedDriverBase
     *              The drivers that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Driver being tagged.
     *                  ]
     *
     *              'machines'
     *              Array of TaggedMachineBase
     *              The machines that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Machine being tagged.
     *                  ]
     *
     *              'sensors'
     *              Array of TaggedSensorBase
     *              The sensors that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Sensor being tagged.
     *                  ]
     *
     *              'vehicles'
     *              Array of TaggedVehicleBase
     *              The vehicles that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Vehicle being tagged.
     *                  ]
     *
     *      'delete'
     *      Array of arrays/objects delete
     *      Specify devices, etc. that should be removed from the tag.
     *
     *              'assets'
     *              Array of TaggedAssetBase
     *              The assets that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Asset being tagged.
     *                  ]
     *
     *              'drivers'
     *              Array ofTaggedDriverBase
     *              The drivers that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Driver being tagged.
     *                  ]
     *
     *              'machines'
     *              Array of TaggedMachineBase
     *              The machines that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Machine being tagged.
     *                  ]
     *
     *              'sensors'
     *              Array of TaggedSensorBase
     *              The sensors that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Sensor being tagged.
     *                  ]
     *
     *              'vehicles'
     *              Array of TaggedVehicleBase
     *              The vehicles that belong to this tag.
     *
     *                  Array[
     *                      'id'
     *                      integer <int64> Required
     *                      The ID of the Vehicle being tagged.
     *                  ]
     *
     *      'name'
     *      string
     *      Updated name of this tag.
     *
     *      'parentTagId'
     *      integer <int64>
     *      If this tag is part a hierarchical tag tree as a child tag, the parentTagId is the ID of this tag's parent tag.
     *
     * @param int $tag_id
     * @param array $request_body
     * @return bool|mixed
     */
    public function tagsPatchTag(int $tag_id, array $request_body )
    {
        $endpoint = "/tags/{$tag_id}";
        $data = [
            'access_token' => $this->config['access_token']
        ];

        $data = $data + $request_body;

        // Make API Call
        $result = samsara::callAPI("PATCH", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * tagsDeleteTag
     *
     * endpoint: /tags/{tag_id}
     * Permanently deletes a tag.
     *
     * [PARAMETERS]
     *
     * Path Parameters
     *
     *      'tag_id'
     *      integer <int64> Required
     *      ID of the tag. Must contain only digits 0-9.
     *
     * Query Parameters
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $tag_id
     * @return bool|mixed
     */
    public function tagsDeleteTag(int $tag_id)
    {
        $endpoint = "/tags/{$tag_id}";
        $data = [
            'access_token' => $this->config['access_token']
        ];

        // Make API Call
        $result = samsara::callAPI("DELETE", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * getInstance
     *
     * The object is created from within the class itself
     * only if the class has no instance.
     *
     * @return null|tags
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new tags();
        }

        return self::$instance;
    }

}