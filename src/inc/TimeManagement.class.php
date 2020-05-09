<?php

use DBA\Factory;

/**
 * Handles User Access Times
 *
 * @author flocomAT
 */
class TimeManagement{
  private static $instance = null;
  
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new TimeManagement();
    }
    return self::$instance;
  }
  
  public static function getTMState() {
    /**
     * Get Time Management State (as specified in config -> server)
     * Returns State of TimeManagement - "red" or "green"
     */

    $config = SConfig::getInstance()->getVal(DConfig::USER_ACCESS_TIMES);
    $config = json_decode($config);
    
    //calculate the current time frame
    //if the interval/step in config.template is changed, this has to be modified as well
    //for hour intervals, simply check if date("H") == the hour in the config JSON.
    $cur_time = date("H:i");
    
    for($entry = 0; $entry < count($config); $entry++){
      if($config[$entry]->day == strtolower(date("D")) && substr($config[$entry]->time, 0, 2) == date("H")){
        return $config[$entry]->state;
      }
    }
    
    //no matching time frame in config
    return NULL;
  }
  
  public static function executeTMpolicy($agent) {
    /**
     * Execute Time Management Policy (as specified in config -> server)
     *  Toggles all sets connected agents either active or inactive - depending on TimeManagement state
     */
    
    //get current TM state (= the target state)
    $target_state = self::getTMState();
    if($target_state == "red"){
      $target_state = "0";
    } else {
      //todo implement error tolerance if getTMstate() fails (low prio)
      $target_state = "1";
    }
    
    //get states of agent (= current state)
    $current_state = $agent->getIsActive();
    
    //compare and change agent state if necessary
    if($current_state != $target_state){
      $user = UserUtils::getUser(1); //get admin user => ensure we have permission to toggle isActive
      AgentUtils::setActive($agent->getId(), $target_state, $user);
    }
  }
  
}