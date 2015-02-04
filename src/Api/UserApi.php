<?php


namespace FluxBB\Api;

use FluxBB\Actions\CreateUser;
use FluxBB\Core\Action; 
use FluxBB\Events\UserHasRegistered; 
use FluxBB\Models\User; 
use FluxBB\Models\ConfigRepositoryInterface; 


class UserApi extends Action
{
  
  /*
   *  
   * This file handles User registration, and login api. 
   * url structure: /api/v1/users/[function]
   *
   */
  
  protected $config; 
  protected $api_key;
  
  public function __construct(ConfigRepositoryInterface $repository) 
  { 
    $this->config = $repository; 
  } 

  /*
   *
   * Get the variables username, email, password, groupid, active, api_key from the url to use to register the user
   * @returns json array indicating success or failure
   */

  public function action_register($api_key, $username, $email, $password, $group_id, $active)
  {
    //first we need to get our api key, and verify it
    $this->api_key = $api_key;
    
    //FluxBB\Api\ApiBase - todo: create function to veify api key from key provided in url
  
  }

 
 

}
