<?php
require_once 'vendor/autoload.php';
$config = array(
   // required
   'access_token' => '81875d3f3c294cb1b10cfd49dc18decf',
   // optional - environment name. any string will do.
   'environment' => 'production'
);
Rollbar::init($config);
\Log::debug('Here is some debug information');