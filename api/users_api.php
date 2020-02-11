<?php
/*
Samsara API Users Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class users
 * @package samsara_php\api
 */
class users extends config {


    /**
     * Hold the class instance.
     *
     * @var null
     */
    private static $instance = null;

    /**
     * __construct
     *
     * users constructor.
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * usersGetUserRoles
     *
     * endpoint: /user_roles
     * Get all roles in the organization.
     *
     * [PARAMETERS]
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @return mixed
     */
    public function usersGetUserRoles()
    {
        $endpoint = '/user_roles';
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * usersGetUsers
     *
     * endpoint: /users
     * List all users in the organization.
     *
     * [PARAMETERS]
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @return mixed
     */
    public function usersGetUsers()
    {
        $endpoint = '/users';
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }


    /**
     * usersAddUser
     *
     * endpoint: /users
     * Add a user to the organization
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
     * User properties. Only one of organizationRoleId or tagRoles is required.
     *
     *      'authType' as $auth_type
     *      string Required
     *      "default", "saml"
     *      The authentication type the user uses to authenticate. To use SAML this organization must have a configured SAML integration.
     *
     *      'name' as $name
     *      string Required
     *      The first and last name of the user.
     *
     *      'organizationRoleId' as $org_role_id
     *      string
     *      The id of the role the user is assigned to at the organization level. This will be blank for users that only have access to specific tags.
     *
     *      'tagRoles'
     *      Array of object
     *      If specified, the user will be an administrator for these tags. If left blank, the user has access to the entire organization.
     *
     *          'roleId' as $role_id
     *          string
     *          The id of the role
     *
     *          'tagId' as $tag_id
     *          number <int64>
     *          The id of the tag to grant this user access to.
     *
     *      'email' as $email
     *      string Required
     *      The email address of this user.
     *
     * @param string $auth_type
     * @param string $name
     * @param string $org_role_id
     * @param string|null $role_id
     * @param int|null $tag_id
     * @param string $email
     * @return bool|mixed
     */
    public function usersAddUser(string $auth_type, string $name, string $org_role_id, string $role_id = null, int $tag_id = null, string $email)
    {
        $endpoint = '/users';
        $data = [
            'access_token' => $this->config['access_token'],
            'authType' => $auth_type,
            'name' => $name,
            'organizationRoleId' => $org_role_id,
            'email' => $email
        ];

        // Check if $role_id is empty, if not add it to $tagRoles
        if(!empty($role_id)) {
            $tagRoles['roleId'] = $role_id;
        }else{
            $tagRoles['roleId'] = null;
        }

        // Check if $tag_id is empty, if not add it to $tagRoles
        if(!empty($tag_id)) {
            $tagRoles['tagId'] = $tag_id;
        }else{
            $tagRoles['tagId'] = null;
        }

        // Check if $tagRoles is empty, if not add it to $data array
        if( !empty($tagRoles) && ( !empty($tagRoles['roleId']) ||  !empty($tagRoles['tagId']) ) ) {
            $tempData = [
                'tagRoles' => [$tagRoles]
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }


    /**
     * usersGetUserById
     *
     * endpoint: /users/{userId}
     * Get a user by user id.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'userId' as $user_id
     *      integer <int64> Required
     *      ID of the user. Must contain only digits 0-9.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $user_id
     * @return bool|mixed
     */
    public function usersGetUserById(int $user_id)
    {
        $endpoint = "/users/{$user_id}";
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }


    /**
     * usersUpdateUserById
     *
     * endpoint: /users/{user_id}
     * Update some fields on a user. Only fields to be changed need to be supplied.
     * Note that if you change an object or collection, you must supply the complete collection.
     * For example, to add a tag role to a user, you must specify all tag roles that the user should have.
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
     * User properties. Note that when updating tagRoles, the complete list of tag roles must be supplied for the user.
     * To delete all tag roles set the value to null or an empty array.
     *
     *      'authType' as $auth_type
     *      string Required
     *      "default", "saml"
     *      The authentication type the user uses to authenticate. To use SAML this organization must have a configured SAML integration.
     *
     *      'name' as $name
     *      string Required
     *      The first and last name of the user.
     *
     *      'organizationRoleId' as $org_role_id
     *      string
     *      The id of the role the user is assigned to at the organization level. This will be blank for users that only have access to specific tags.
     *
     *      'tagRoles'
     *      Array of object
     *      If specified, the user will be an administrator for these tags. If left blank, the user has access to the entire organization.
     *
     *          'roleId' as $role_id
     *          string
     *          The id of the role
     *
     *          'tagId' as $tag_id
     *          number <int64>
     *          The id of the tag to grant this user access to.
     *
     * @param int $user_id
     * @param string $auth_type
     * @param string|null $name
     * @param string|null $org_role_id
     * @param string|null $role_id
     * @param int|null $tag_id
     * @return bool|mixed
     */
    public function usersUpdateUserById(int $user_id, string $auth_type, string $name = null, string $org_role_id = null, string $role_id = null, int $tag_id = null)
    {
        $endpoint = "/users/{$user_id}";

        $data = [
            'access_token' => $this->config['access_token'],
            'authType' => $auth_type,
        ];

        // Check if $name is empty, if not add it to $data array
        if(!empty($name)) {
            $tempData = [
                'name' => $name
            ];

            $data = $data + $tempData;
        }

        // Check if $org_role_id is empty, if not add it to $data array
        if(!empty($org_role_id)) {
            $tempData = [
                'organizationRoleId' => $org_role_id
            ];

            $data = $data + $tempData;
        }

        // Check if $role_id is empty, if not add it to $tagRoles
        if(!empty($role_id)) {
            $tagRoles['roleId'] = $role_id;
        }else{
            $tagRoles['roleId'] = null;
        }

        // Check if $tag_id is empty, if not add it to $tagRoles
        if(!empty($tag_id)) {
            $tagRoles['tagId'] = $tag_id;
        }else{
            $tagRoles['tagId'] = null;
        }

        // Check if $tagRoles is empty, if not add it to $data array
        if( !empty($tagRoles) && ( !empty($tagRoles['roleId']) ||  !empty($tagRoles['tagId']) ) ) {
            $tempData = [
                'tagRoles' => [$tagRoles]
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("PATCH", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * usersDeleteUserById
     *
     * endpoint: /users/{userId}
     * Remove a user from the organization by user id.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'userId' as $user_id
     *      integer <int64> Required
     *      ID of the user. Must contain only digits 0-9.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @return mixed
     * @return bool|mixed
     */
    public function usersDeleteUserById(int $user_id)
    {
        $endpoint = "/users/{$user_id}";
        $data = ['access_token' => $this->config['access_token']];

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
     * @return null|users
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new users();
        }

        return self::$instance;
    }

}