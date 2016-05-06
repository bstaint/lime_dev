<?php
define('__BASE_DIR__', __DIR__);

require('./system/core/App.php');

$app = new Lime\App();

require(__BASE_DIR__ . '/app/core/functions.php');
require(__BASE_DIR__ . '/app/config/config.php');
require(__BASE_DIR__ . '/app/config/routes.php');

$app->run();
?>
