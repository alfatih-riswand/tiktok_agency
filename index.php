<?php
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
$system_path = 'system';
$application_folder = 'application';
if (($_temp = realpath($system_path)) !== FALSE) $system_path = $_temp . DIRECTORY_SEPARATOR;
else $system_path = rtrim($system_path, '/\\') . DIRECTORY_SEPARATOR;
if (!is_dir($system_path)) { header('HTTP/1.1 503 Service Unavailable.', TRUE, 503); echo 'Folder system/ CodeIgniter 3 belum dipasang. Lihat README.md'; exit(3); }
define('BASEPATH', $system_path);
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
define('SYSDIR', basename(rtrim(BASEPATH, '/\\')));
if (is_dir($application_folder)) $application_folder = realpath($application_folder);
define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);
define('VIEWPATH', $application_folder . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
require_once BASEPATH . 'core/CodeIgniter.php';
