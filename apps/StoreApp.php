<?php

/**
 * Description of StoreApp
 *
 * @author sanya
 */
class StoreApp extends MetroApp {

    public function GetHTML() {
        $result = '<span class="bigicon"></span>';
        $result .= '<span class="bottom">Store</span>';
        return $result;
    }

}