<?php

/*
Samsara API Configuration Class
*/

namespace samsara_php;

class config {
    // Hold the class instance.
    private static $instance = null;
    
    public $config;

    // The constructor is private
    // to prevent initiation with outer code.
    protected function __construct()
    {
        
        // Set Config Variables within config array below
        $this->config = array(
            // Set all API files for auto import excluding samsara_api.php
            'IMPORT' => array(
                'assets_api.php',
                'contacts_api.php',
                'drivers_api.php',
                'fleet_api.php',
                'industrial_api.php',
                'messages_api.php',
                'routes_api.php',
                'safety_api.php',
                'sensors_api.php',
                'tags_api.php',
                'users_api.php',
                'utilities.php',
            ),
            'base_url' => 'https://api.samsara.com/v1',
            'access_token' => {access_key},
            'group_id' => {group_id}
        );

    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
        if (self::$instance == null)
        {
          self::$instance = new config();
        }

        return self::$instance;
    }
}

?>
