<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WeatherApp
 *
 * @author Hoppedal
 */
class WeatherApp extends MetroApp {

  protected $url = 'http://www.google.com/ig/api?hl=hu&weather=';
  protected $city = 'Budapest';

  public function GetHTML() {
    $ch = curl_init($this->url . $this->city);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $xml = new SimpleXMLElement(utf8_encode(curl_exec($ch)));
    curl_close($ch);

    //var_dump($xml);

    $w = $xml->weather;


    $icon_path = pathinfo($w->current_conditions->icon['data']);
    $icon = $icon_path['filename'];
    switch ($icon) {
      case 'snow':
        $icon_img = 16;
        break;
      case 'mostly_sunny':
        $icon_img = 34;
        break;
      case 'chance_of_rain':
        $icon_img = 9;
        break;

      default:
        $icon_img = 'na';
        break;
    }
    $result = '<h2><img src="/sanya/tiles/icon/flat/' . $icon_img . '.png" alt="' . $icon . '" title="' . $icon . '" />' . $w->current_conditions->temp_c['data'] . '°C ' . $w->forecast_information->postal_code['data'] . '</h2>';
    //$result = '<h2 class="sun">' . $w->current_conditions->temp_c['data'] . '°C ' . $w->forecast_information->postal_code['data'] . '</h2>';

    $key = 0;
    foreach ($w->forecast_conditions as $fcond) {
      if ($key > 0) {
        if ($key == 1) {
          $day = 'Tomorrow';
        } else {
          $day = @date('l', strtotime('+' . $key . ' day'));
        }
        $icon_path = pathinfo($fcond->icon['data']);
        $icon = $icon_path['filename'];
        switch ($icon) {
          case 'snow':
            $icon_img = 16;
            break;
          case 'mostly_sunny':
            $icon_img = 34;
            break;
          case 'chance_of_rain':
            $icon_img = 9;
            break;

          default:
            $icon_img = 'na';
            break;
        }
        $result .= '<p><img src="/sanya/tiles/icon/flat/' . $icon_img . '.png" alt="' . $icon . '" title="' . $icon . '" />' . $day . ' ' . $fcond->high['data'] . '°C / ' . $fcond->low['data'] . '°C</p>';
        //$result .= '<p class="cloud">' . $day . ' ' . $fcond->high['data'] . '°C / ' . $fcond->low['data'] . '°C</p>';
      }
      $key++;
    }

    /*
      <p class="cloud">Tomorrow 88° / 65°</p>
      <p class="sun">Thursday 88° / 65°</p>
      <p class="sun">Friday 88° / 65°</p>
      <span class="bottom">Weather</span>
     */
    return $result;
  }
}

?>
