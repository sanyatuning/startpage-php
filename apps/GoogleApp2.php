<?php

require_once dirname(__FILE__) . '/../google-api-php-client/apiClient.php';

/**
 * Description of GoogleApp
 * 
 * @author sanya
 */
abstract class GoogleApp extends MetroApp {

    protected $client;

    abstract protected function GetOAuthScope();

    /**
     * @param apiClient $client
     */
    abstract protected function AddService($client);

    protected function GetXML($url) {
        $client = new apiClient();
        $this->AddService($client);
        if (isset($_SESSION['access_token'])) {
            $client->setAccessToken($_SESSION['access_token']);
        } else {
            $client->setAccessToken($client->authenticate());
        }
        $_SESSION['access_token'] = $client->getAccessToken();

        if ($client->getAccessToken()) {
            $tokens = json_decode($client->getAccessToken());
            $ch = curl_init($url);
            $header[] = 'Authorization: OAuth ' . $tokens->access_token;

            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            $result = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);

            if ($info['http_code'] != 200) {
                $client->setAccessToken($client->authenticate());
                throw new Exception('Http error: ' . $info['http_code']);
            }
            $xml = new SimpleXMLElement($result);
            return $xml;
        } else {
            throw new Exception('Token error');
        }
    }

}