<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'welcome/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['home'] = 'welcome/index';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['dashboard'] = 'dashboard/index';
$route['legal'] = 'legal/index';
$route['terms'] = 'legal/terms';
$route['privacy'] = 'legal/privacy';
$route['api/sync'] = 'integration/sync';
$route['webhooks/tiktok'] = 'webhooks/tiktok';
