<?php

namespace FluxBB\Models;

class Plugin extends Base
{
    protected $table = 'plugins';

    protected $fillable = array('plugin_name', 'plugin_author', 'plugin_website', 'plugin_version', 'plugin_active');

    protected $plugin_folder = 'inc/plugins'; //Todo: look and see if plugins folder and php file exists 


    /**
     * Check if the plugin is active
     *
     * return boolean true if it plugin_active is set to 1, else false
     */
    public function isActive()
    {
        If ($this->plugin_active == 1)
        {
           //plugin is active
           return true;

        } else {
         
          //plugin is not active
          return false;
       }

    }

    /**
     * 
     * Get the name of the plugin 
     *
     */

     public function getName()
     {
       return $this->plugin_name;
     }

}
