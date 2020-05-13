<?php

class PresetsHandler implements Handler {
  public function __construct($presetId = null) {
    //we need nothing to load
  }
  
  public function handle($action) {
    try {
      switch ($action) {
        case DPresetAction::DELETE_PRESET:
          PresetsUtils::deletePreset($_POST['presetID']);
          UI::addMessage(UI::SUCCESS, "Preset was deleted successfully!");
          break;
        case DPresetAction::ADD_PRESET:
          # Preset ID is auto increment so null here
          PresetsUtils::addPreset(null, $_POST['presetName'], $_POST['presetCommand'], Login::getInstance()->getUser());
          UI::addMessage(UI::SUCCESS, "New preset created successfully!");
          break;
        default:
          UI::addMessage(UI::ERROR, "Invalid action!");
          break;
      }
    }
    catch (HTException $e) {
      UI::addMessage(UI::ERROR, $e->getMessage());
    }
  }
}