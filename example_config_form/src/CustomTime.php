<?php

namespace Drupal\example_config_form;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class CustomTime.
 */
class CustomTime {

  function get_date_on_given_timezone() {

    $current_time = new DrupalDateTime('now', 'UTC');
    echo($current_time);
    
    $selectedTimezone = \Drupal::config('example_config_form.settings')->get('timezone.default');
    echo($current_time); die();
    $date_time = new DrupalDateTime();
    
    $timezone_offset = $selectedTimezone->getOffset($date_time->getPhpDateTime());
    
    $time_interval = \DateInterval::createFromDateString($timezone_offset . 'seconds');
    
    $current_time->add($time_interval);
    
    $result = $current_time->format('D-M-Y H:i:s');
	
	return $result;
  }

}