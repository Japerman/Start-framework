<?php
/**
 * Start - PHP Framework
 *
 * @author   Jose Perez <japerman@gmail.com>
 * @url      <https://github.com/japerman/start-framework>
 * @license  The MIT License (MIT) - <http://opensource.org/licenses/MIT>
 */

ob_start();
session_start();

use Start\Kernel\Application;

$app = new Application;

define('NUR_VERSION', Application::VERSION);
define('ROOT', $app->root());
define('DOC_ROOT', $app->docRoot());
define('BASE_FOLDER', $app->baseFolder());
define('APP_ENV', strtolower(config('app.env')));
define('ADMIN_FOLDER', trim(config('app.admin'), '/'));
define('ASSETS_FOLDER', trim(config('app.assets'), '/'));
date_default_timezone_set(config('app.timezone'));

$app->start($env = APP_ENV);
