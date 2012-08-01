<?php

/**
 * Description of Mail
 *
 * @author sanya
 */
class WebApp extends MetroApp {

    public function GetHTML() {
        $result = '<span class="bigicon"></span>';
        $result .= '<span class="bottom">Internet Explorer</span>';
        return $result;
    }

}