<?php

/**
 * @file
 * Contains \Drupal\example_config_form\Plugin\Block\ExampleBlock.
 */

namespace Drupal\example_config_form\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\example_config_form\CustomTime;

/**
 * Provides a 'example' block.
 *
 * @Block(
 *   id = "example_block",
 *   admin_label = @Translation("Example block"),
 *   category = @Translation("Custom block example")
 * )
 */

class ExampleBlock extends BlockBase implements ContainerFactoryPluginInterface {
	
  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * @var $customtime \Drupal\example_config_form\CustomTime
   */
  protected $customtime;


  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
 
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('example_config_form.customtime')
    );
  }

  /**
   * class constructor
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Config\ConfigFactory $configFactory
   * @param \Drupal\example_config_form\CustomTime $customtime
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactory $configFactory, CustomTime $customtime) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $configFactory;    
    $this->customtime = $customtime;

  }


  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = $this->configFactory->get('example_config_form.settings');
    $country = $config->get('country');
    $city = $config->get('city');
    $time = $this->customtime->get_date_on_given_timezone();

    $renderable = [
      '#theme' => 'form_template',
      '#country' => $country,
	  '#city' => $city,
	  '#time' => $time,
    ];

    return $renderable;

  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}