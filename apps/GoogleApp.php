<?php

/**
 * Description of GoogleApp
 * 
 * @author sanya
 */
abstract class GoogleApp extends MetroApp {

  protected $oauth_url = 'https://accounts.google.com/o/oauth2/auth';
  protected $oauth_state = '';
  protected $oauth_redirect_uri = 'http://cd-swiss.vserver.softronics.ch/sanya/';
  protected $oauth_response_type = 'code';
  protected $oauth_client_id = '902389262614.apps.googleusercontent.com';
  protected $oauth_client_secret = 'b2Bj0wPCsKD9pEzUVmyMWDKJ';

  abstract protected function GetOAuthScope();


  protected function GetAuthURL() {
    return $this->oauth_url .
            '?scope=' . urlencode($this->GetOAuthScope()) .
            '&redirect_uri=' . urlencode($this->oauth_redirect_uri) .
            '&response_type=' . urlencode($this->oauth_response_type) .
            '&client_id=' . urlencode($this->oauth_client_id);
  }
  protected function GetAuthCode() {
    $url = $this->GetAuthURL();
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $result = curl_exec($ch);

    //var_dump(curl_getinfo($ch));

    return;
  }
  protected function GetTokens($auth_code) {
    $ch = curl_init('https://accounts.google.com/o/oauth2/token');
    $header[] = 'Content-Type: application/x-www-form-urlencoded';

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'code=' . urlencode($auth_code) .
            '&redirect_uri=' . urlencode($this->oauth_redirect_uri) .
            '&client_id=' . urlencode($this->oauth_client_id) .
            '&scope=' . urlencode($this->GetOAuthScope()) . 
            '&client_secret=' . urlencode($this->oauth_client_secret) .
            '&grant_type=authorization_code');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $result = json_decode(curl_exec($ch));
    curl_close($ch);

    return $result;
  }
  protected function GetXML($access_token,$url) {
    $ch = curl_init($url);
    $header[] = 'Authorization: OAuth ' . $access_token;

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $result = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);

    if ($info['http_code'] != 200) {
      unset($_SESSION['tokens']);
      if ($info['http_code'] == 401) {
        throw new Exception('<a href="' . $this->GetAuthURL() . '">Login to Google</a>');
      }
      throw new Exception('Http error: ' . $info['http_code']);
    }

    //return $result;
    
    $xml = new SimpleXMLElement($result);

    return $xml;
  }
}