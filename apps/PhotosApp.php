<?php

/**
 * Description of Mail
 *
 * @author sanya
 */
class PhotosApp extends MetroApp {

    public function GetHTML() {
        $result = '<img title="Photos" alt="Photos" src="photos.png" />';
        $result .= '<span class="bottom">Photos</span>';
        $result .= '<span class="count orange">6</span>';
        return $result;
    }

}