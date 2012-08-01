<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
define('APPS_DIR', dirname(__FILE__) . '/apps/');
require_once APPS_DIR . 'MetroApp.php';
require_once APPS_DIR . 'GoogleApp2.php';

function createObject($app_name) {
    $app_file = APPS_DIR . $app_name . '.php';
    if (file_exists($app_file)) {
        require_once $app_file;
        if (class_exists($app_name)) {
            try {
                $App = new $app_name($_GET);
                return $App;
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

function get_html($App) {
    if (is_string($App)) {
        return $App;
    } else {
        try {
            return $App->GetHTML();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

$apps = explode('|', $_GET['apps']);
unset($_GET['apps']);

$Apps = array();
foreach ($apps as $app_name) {
    $Apps[$app_name] = createObject($app_name);
    if (is_a($Apps[$app_name], 'GoogleApp')) {
        $Apps[$app_name]->AddService();
    }
}
$result = array();
foreach ($Apps as $app_name => $app) {
    $result[$app_name] = get_html($app);
}
print json_encode($result);
