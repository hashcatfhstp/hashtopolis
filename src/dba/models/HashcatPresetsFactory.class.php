<?php

namespace DBA;

class HashcatPresetsFactory extends AbstractModelFactory {
  function getModelName() {
    return "HashcatPresets";
  }
  
  function getModelTable() {
    return "HashcatPresets";
  }
  
  function isCachable() {
    return false;
  }
  
  function getCacheValidTime() {
    return -1;
  }
  
  /**
   * @return HashcatPresets
   */
  function getNullObject() {
    $o = new HashcatPresets(-1, null, null);
    return $o;
  }
  
  /**
   * @param string $pk
   * @param array $dict
   * @return HashcatPresets
   */
  function createObjectFromDict($pk, $dict) {
    $o = new HashcatPresets($dict['presetID'], $dict['presetName'], $dict['presetCommand']);
    return $o;
  }
  
  /**
   * @param array $options
   * @param bool $single
   * @return HashcatPresets|HashcatPresets[]
   */
  function filter($options, $single = false) {
    $join = false;
    if (array_key_exists('join', $options)) {
      $join = true;
    }
    if ($single) {
      if ($join) {
        return parent::filter($options, $single);
      }
      return Util::cast(parent::filter($options, $single), HashcatPresets::class);
    }
    $objects = parent::filter($options, $single);
    if ($join) {
      return $objects;
    }
    $models = array();
    foreach ($objects as $object) {
      $models[] = Util::cast($object, HashcatPresets::class);
    }
    return $models;
  }
  
  /**
   * @param string $pk
   * @return HashcatPresets
   */
  function get($pk) {
    return Util::cast(parent::get($pk), HashcatPresets::class);
  }
  
  /**
   * @param HashcatPresets $model
   * @return HashcatPresets
   */
  function save($model) {
    return Util::cast(parent::save($model), HashcatPresets::class);
  }
}