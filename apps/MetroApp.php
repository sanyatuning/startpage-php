<?php

/**
 * Description of MetroApp
 *
 * @author sanya
 */
abstract class MetroApp {
    protected $get;
    public function __construct($request_array) {
        $this->get = $request_array;
    }
    abstract function GetHTML();
}
