<?php

/*
Samsara API Samsara Class
*/

namespace samsara_php\api;

include '../config.php';

use samsara_php\config;

class samsara extends config {

    // Hold the class instance
    private static $instance = null;

    // Hold API Part class instance
    public static $assets_api;
    public static $contacts_api;
    public static $drivers_api;
    public static $fleet_api;
    public static $industrial_api;
    public static $messages_api;
    public static $routes_api;
    public static $safety_api;
    public static $sensors_api;
    public static $tags_api;
    public static $users_api;
    public static $utilities_api;

    public static $base_url;
    public static $access_token;
    public static $group_id;


    // The constructor is private
    // to prevent initiation with outer code.
    protected function __construct()
    {
        // Call parent constructor
        parent::__construct();

        // Import other API part classes
        self::includeIMPORT($this->config['IMPORT']);

        // Set base url, access token & group_id
        self::$base_url = $this->config['base_url'];
        self::$access_token = $this->config['access_token'];
        self::$group_id = $this->config['group_id'];

        // Set class parts instances to static vars
        self::$assets_api = assets::getInstance();
        self::$contacts_api = contacts::getInstance();
        self::$drivers_api = drivers::getInstance();
        self::$fleet_api = fleet::getInstance();
        self::$industrial_api = industrial::getInstance();
        self::$messages_api = messages::getInstance();
        self::$routes_api = routes::getInstance();
        self::$safety_api = safety::getInstance();
        self::$sensors_api =  sensors::getInstance();
        self::$tags_api =  tags::getInstance();
        self::$users_api = users::getInstance();
        self::$utilities_api = utilities::getInstance();
    }

    public static function includeIMPORT($IMPORT) {

        foreach ($IMPORT as $class) {
            include "{$class}";
        }

    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new samsara();
        }

        return self::$instance;
    }

    // Call API function to access the API endpoints via curl
    // Assumes access_token is first element in associative array.
    public static function callAPI($method = null, string $url, array $data, int $query_vars = 1){

        // Try to send request to API
        try {
            // Initialize curl class
            $curl = curl_init();

            // Check if $method is empty
            if(!empty($method)) {

                // Set access_token if $method is NOT empty
                $query_params = array_slice($data, 0, $query_vars, true);

                // If $method is NOT empty and
                // If $data array is larger than a $query_vars, pop off first element of $data array for each $query_vars
                // This is used to remove the 'access_token' and other params should they not be the only elements in the array.
                if(count($data) > $query_vars) {

                    for($i = 0; $i < $query_vars; $i++) {
                        array_shift($data);
                    }

                }

            }

            switch ($method){
                case "DELETE":
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    break;
                case "PATCH":
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    break;
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    break;
                case "PUT":
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    break;
                case "GET/POST":
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
                    $url_set = 1;
            }

            // if $url has not been modified by default, add the access_token
            // so that a call can be successfully completed through the API.
            if(!isset($url_set)) {
                $url = sprintf("%s?%s", $url, http_build_query($query_params));
            }

            // OPTIONS:
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

            // EXECUTE:
            $result = curl_exec($curl);

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($http_code != 200) {
                if(!$result){
                    throw new \Exception("Connection Failure HTTP CODE {$http_code}");
                }
            }

            curl_close($curl);

            // Check that result is valid JSON if not throw exception with result as message.
            if(!json_decode($result)) {
                throw new \Exception($result);
            }

        }

        // Catch and display errors should their be any Exceptions thrown
        catch(\Exception $e) {
            // List of methods that will return null or invalid JSON if successful
            $methods = array('DELETE', 'PATCH', 'POST', 'PUT');

            // Print success message if method is in methods array and if *NO* error message is present
            if( in_array($method, $methods) && empty( $e->getMessage() ) && $http_code == 200 ) {
                echo 'Message: API call completed successfully' . '</br>';
            }

            // Print error message if method is in methods array and if error message is present
            if( in_array($method, $methods) && !empty( $e->getMessage() ) ) {
                echo 'Message: ' . $e->getMessage() . '</br>';
            }

            // Print error message if method is not in methods array
            if( !in_array($method, $methods) ) {
                echo 'Message: ' . $e->getMessage() . '</br>';
            }

        }

        // If $result is set return $result
        if(isset($result)){
            return $result;
        }

        // If $result is not set return false;
        return false;

    }

}