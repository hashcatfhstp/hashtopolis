<?php

use DBA\Factory;

require_once(dirname(__FILE__) . "/inc/load.php");

if (!Login::getInstance()->isLoggedin()) {
  header("Location: index.php?err=4" . time() . "&fw=" . urlencode($_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']));
  die();
}
# TODO: Create new VIEW PERMISSION for presets
AccessControl::getInstance()->checkPermission(DViewControl::HASHTYPES_VIEW_PERM);

Template::loadInstance("presets");
Menu::get()->setActive("config_presets");

//catch actions here...
if (isset($_POST['action']) && CSRF::check($_POST['csrf'])) {
  $presetsHandler = new PresetsHandler();
  $presetsHandler->handle($_POST['action']);
  if (UI::getNumMessages() == 0) {
    Util::refresh();
  }
}

$presets = Factory::getHashcatPresetsFactory()->filter([]);

UI::add('presets', $presets);
UI::add('pageTitle', "Presets");

echo Template::getInstance()->render(UI::getObjects());




