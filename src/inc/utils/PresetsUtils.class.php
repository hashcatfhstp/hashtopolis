<?php

use DBA\User;
use DBA\HashcatPresets;
use DBA\Factory;

class PresetsUtils {
  /**
   * @param int $presetId
   * @throws HTException
   */
  public static function deletePreset($presetId) {
    $preset = Factory::getHashcatPresetsFactory()->get($presetId);
    if ($preset == null) {
      throw new HTException("Invalid preset!");
    }
    
    Factory::getHashcatPresetsFactory()->delete($preset);
  }
  
  /**
   * @param int $presetId
   * @param string $presetName
   * @param int $presetCommand
   * @param User $user
   * @throws HTException
   */
  public static function addPreset($presetId, $presetName, $presetCommand, $user) {
    $name = htmlentities($presetName, ENT_QUOTES, "UTF-8");
    if (strlen($name) == 0 || $presetId != null) {
      throw new HTException("Invalid inputs!");
    }
    $command = htmlentities($presetCommand, ENT_QUOTES, "UTF-8");
    if (strlen($command) == 0 || $presetId != null) {
      throw new HTException("Invalid inputs!");
    }
    
    $preset = new HashcatPresets($presetId, $name, $command);
    if (Factory::getHashcatPresetsFactory()->save($preset) == null) {
      throw new HTException("Failed to add new preset!");
    }
    Util::createLogEntry("User", $user->getId(), DLogEntry::INFO, "New Preset added: " . $preset->getPresetName());
  }
}