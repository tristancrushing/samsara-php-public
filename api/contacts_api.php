<?php
/*
Samsara API Contacts Class
*/

namespace samsara_php\api;

use samsara_php\config;

/**
 * Class contacts
 * @package samsara_php\api
 */
class contacts extends config {

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
     * contacts constructor.
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * contactsGetContacts
     *
     * endpoint: /contacts
     * List all contacts for the organization.
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
    public function contactsGetContacts()
    {
        $endpoint = '/contacts';
        $data = ['access_token' => $this->config['access_token']];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * contactsAddContact
     *
     * endpoint: /contacts
     * Add a contact to the organization.
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
     * Add a contact.
     *
     *      'firstName' as $first_name
     *      string
     *      First name of the contact.
     *
     *      'lastName' as $last_name
     *      string
     *      Last name of the contact.
     *
     *      'email' as $email
     *      string
     *      Email address of the contact.
     *
     *      'phone' as $phone_number
     *      string
     *      Phone number of the contact.
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $phone_number
     * @return bool|mixed
     */
    public function contactsAddContact(string $first_name, string $last_name, string $email, string $phone_number)
    {
        $endpoint = '/contacts';

        $data = [
            'access_token' => $this->config['access_token'],
            'firstName' => $first_name,
            'lastName' => $last_name,
            'email' => $email,
            'phone' => $phone_number
        ];

        // Make API Call
        $result = samsara::callAPI("POST", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * contactsGetContactById
     *
     * endpoint: /contacts/{contact_id}
     * Fetch a contact by its id.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'contact_id' as $contact_id
     *      integer <int64> Required
     *      ID of the contact. Must contain only digits 0-9.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $contact_id
     * @return bool|mixed
     */
    public function contactsGetContactById(int $contact_id)
    {
        $endpoint = "/contacts/{$contact_id}";

        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // Make API Call
        $result = samsara::callAPI(null, $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * contactsUpdateContactById
     *
     * endpoint: /contacts/{contact_id}
     * Update the name, phone number or email of a contact using the contact id. Only fields to be changed need to be supplied.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'contact_id' as $contact_id
     *      integer <int64> Required
     *      ID of the contact. Must contain only digits 0-9.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * [REQUEST BODY]
     *
     * Update the email, first name, last name, or phone number of a contact using the contact_id.
     *
     *      'firstName'
     *      string
     *      First name of the contact.
     *
     *      'lastName'
     *      string
     *      Last name of the contact.
     *
     *      'email'
     *      string
     *      Email address of the contact.
     *
     *      'phone'
     *      string
     *      Phone number of the contact.
     *
     * @param int $contact_id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $phone_number
     * @return bool|mixed
     */
    public function contactsUpdateContactById(int $contact_id, string $first_name = '', string $last_name = '', string $email = '', string $phone_number = '')
    {
        $endpoint = "/contacts/{$contact_id}";

        $data = [
            'access_token' => $this->config['access_token'],
        ];

        // If $first_name not empty add $first_name to $data array.
        if(!empty($first_name)) {
            $tempData = [
                'firstName' => $first_name
            ];

            $data = $data + $tempData;
        }

        // If $last_name not empty add $last_name to $data array.
        if(!empty($last_name)) {
            $tempData = [
                'lastName' => $last_name
            ];

            $data = $data + $tempData;
        }

        // If $email not empty add $email to $data array.
        if(!empty($email)) {
            $tempData = [
                'email' => $email
            ];

            $data = $data + $tempData;
        }

        // If $phone_number not empty add $phone_number to $data array.
        if(!empty($phone_number)) {
            $tempData = [
                'phone' => $phone_number
            ];

            $data = $data + $tempData;
        }

        // Make API Call
        $result = samsara::callAPI("PATCH", $this->config['base_url'] . $endpoint, $data);

        return $result;
    }

    /**
     * contactsDeleteContactById
     *
     * endpoint: /contacts/{contact_id}
     * Delete a contact by its id.
     *
     * [PARAMETERS]
     *
     * [Path Parameters]
     *
     *      'contact_id' as $contact_id
     *      integer <int64> Required
     *      ID of the contact. Must contain only digits 0-9.
     *
     * [Query Parameters]
     *
     *      'access_token' | automatically included from config class
     *      string Required
     *      Samsara API access token.
     *
     * @param int $contact_id
     * @return bool|mixed
     */
    public function contactsDeleteContactById(int $contact_id)
    {
        $endpoint = "/contacts/{$contact_id}";

        $data = [
            'access_token' => $this->config['access_token'],
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
     * @return null|contacts
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new contacts();
        }

        return self::$instance;
    }

}