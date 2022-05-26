<?php

namespace Drupal\example_config_form;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class CustomTime.
 */
class CustomTime {

  /**
   * Drupal\Core\Config\ConfigFactoryInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   *
   * class constructor
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   An instance of ConfigFactoryInterface.
   *
   */

  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * function to return data & time.
   */
  public function get_date_on_given_timezone() {

    $config = $this->configFactory->get('example_config_form.settings');
    $user_selected_timezone = $config->get('timezone.default');
    $date = new DrupalDateTime("now", new \DateTimeZone($user_selected_timezone));
    return $date->format('jS M Y - H:i A');

  }
  
}