<?php

error_reporting(E_ALL);
//ini_set('display_errors', '1');

$url = $_GET['url'];
unset($_GET['url']);

$ch = curl_init('https://mail.google.com/mail/feed/atom');


print $result;
