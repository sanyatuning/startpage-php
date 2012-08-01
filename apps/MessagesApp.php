<?php

/**
 * Description of MessagesApp
 *
 * @author sanya
 */
class MessagesApp extends MetroApp {

    public function GetHTML() {
        $result = '<span class="bigicon"></span>';
        $result .= '<span class="bottom">Messaging</span>';
        return $result;
    }

}