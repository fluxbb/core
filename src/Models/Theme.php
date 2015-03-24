<?php

namespace FluxBB\Models;

class Theme extends Base
{
    protected $table = 'themes';

    protected $fillable = array('theme_name', 'theme_author', 'theme_website', 'theme_version', 'theme_active');

    protected $themes_folder = 'themes'; //Todo: look and see if themes folder and theme files exist


    /**
     * Check if the plugin is active
     *
     * return boolean true if it plugin_active is set to 1, else false
     */
    public function isActive()
    {
        If ($this->theme_active == 1)
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
     * Get the name of the theme 
     *
     */

     public function getName()
     {
       return $this->theme_name;
     }

}
