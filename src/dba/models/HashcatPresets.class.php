<?php

namespace DBA;

class HashcatPresets extends AbstractModel {
  private $presetID;
  private $presetName;
  private $presetCommand;
  
  function __construct($presetID, $presetName, $presetCommand) {
    $this->presetID = $presetID;
    $this->presetName = $presetName;
    $this->presetCommand = $presetCommand;
  }
  
  function getKeyValueDict() {
    $dict = array();
    $dict['presetID'] = $this->presetID;
    $dict['presetName'] = $this->presetName;
    $dict['presetCommand'] = $this->presetCommand;
    
    return $dict;
  }
  
  function getPrimaryKey() {
    return "presetID";
  }
  
  function getPrimaryKeyValue() {
    return $this->presetID;
  }
  
  function getId() {
    return $this->presetID;
  }
  
  function setId($id) {
    $this->presetID = $id;
  }
  
  /**
   * Used to serialize the data contained in the model
   * @return array
   */
  public function expose() {
    return get_object_vars($this);
  }
  
  function getPresetName() {
    return $this->presetName;
  }
  
  function setPresetName($presetName) {
    $this->presetName = $presetName;
  }
  
  function getPresetCommand() {
    return $this->presetCommand;
  }
  
  function setPresetCommand($presetCommand) {
    $this->presetCommand = $presetCommand;
  }
  
  const PRESET_ID = "presetID";
  const PRESET_NAME = "presetName";
  const PRESET_COMMAND = "presetCommand";
}
