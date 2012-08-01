<?php

/**
 * Description of Calendar
 *
 * @author sanya
 */
class CalendarApp extends GoogleApp {
    
    protected $feedurl = 'https://www.google.com/calendar/feeds/default';
    protected $scopeurl = 'https://www.googleapis.com/auth/calendar.readonly';

    public function GetHTML() {
        $calendar = $this->GetXML($this->feedurl);
        return $calendar;
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