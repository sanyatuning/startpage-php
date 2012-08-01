<?php

/**
 * Description of MusicApp
 *
 * @author sanya
 */
class MusicApp extends MetroApp {
  public function GetHTML() {
    $result = '<img title="Cover" alt="Album Cover" src="album.png" />';
    $result .= '<h2>Now Playing</h2>';
    $result .= '<p>Eliza</p>';
    $result .= '<p>Viper Creek Club</p>';
    $result .= '<p>Letters</p>';
    $result .= '<span class="icon"></span>
';
    return $result;
  }
}