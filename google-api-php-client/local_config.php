<?php
global $apiConfig;
$apiConfig = array(
    // True if objects should be returned by the service classes.
    // False if associative arrays should be returned (default behavior).
    'use_objects' => true,
  
    // The application_name is included in the User-Agent HTTP header.
    'application_name' => 'Ultimate Start Page',

    // OAuth2 Settings, you can get these keys at https://code.google.com/apis/console
    'oauth2_client_id' => '902389262614.apps.googleusercontent.com',
    'oauth2_client_secret' => 'b2Bj0wPCsKD9pEzUVmyMWDKJ',
    'oauth2_redirect_uri' => 'http://cd-swiss.vserver.softronics.ch/sanya/',
);
