<?php

/**
 * Description of Mail
 *
 * @author sanya
 */
class MailApp extends GoogleApp {

    protected $feedurl = 'https://mail.google.com/mail/feed/atom';
    protected $scopeurl = 'https://mail.google.com/mail/feed/atom';

    public function GetHTML() {
        return $this->GetXML($this->feedurl);
    }

    protected function GetOAuthScope() {
        return $this->scopeurl;
    }
    
    /**
     *
     * @param apiClient $client 
     */
    protected function AddService($client) {
        $client->setScopes($this->scopeurl);
    }

}