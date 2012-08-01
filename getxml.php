<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
define('APPS_DIR', dirname(__FILE__) . '/apps/');
require_once APPS_DIR . 'MetroApp.php';
require_once APPS_DIR . 'GoogleApp.php';

function get_html($app_name) {
    $app_file = APPS_DIR . $app_name . '.php';
    if (file_exists($app_file)) {
        require_once $app_file;
        if (class_exists($app_name)) {
            try {
                $App = new $app_name($_GET);
                return $App->GetHTML();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return 'Error: Class ' . $app_name . ' not exist';
        }
    } else {
        return 'Error: File ' . $app_file . ' not exist';
    }
}

$apps = explode('|', $_GET['apps']);
unset($_GET['apps']);

$result = new SimpleXMLElement("<?xml version='1.0'?>\n<apps></apps>");
foreach ($apps as $app_name) {
    $xmlobj = get_html($app_name);
    print get_class($xmlobj);
    $result->addChild($app_name, '');
    $result->$app_name = $xmlobj->asXML();
}
print $result->asXML();
