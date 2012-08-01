<?php

/**
 * Description of News
 *
 * @author sanya
 */
class NewsApp extends MetroApp {

    public function GetHTML() {
        $result = '<img alt="" title="Surfing" src="surf.png" />';
        $result .= '<p>First ever surfboard kickflip recorded in Santa Cruz</p>';
        return $result;
    }

}