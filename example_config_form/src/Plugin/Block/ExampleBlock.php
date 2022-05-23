<?php

/**
 * @file
 * Contains \Drupal\example_config_form\Plugin\Block\ExampleBlock.
 */

namespace Drupal\example_config_form\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'example' block.
 *
 * @Block(
 *   id = "example_block",
 *   admin_label = @Translation("Example block"),
 *   category = @Translation("Custom block example")
 * )
 */

class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $country = \Drupal::config('example_config_form.settings')->get('country');
    $city = \Drupal::config('example_config_form.settings')->get('city');
	$time = \Drupal::config('example_config_form.settings')->get('timezone.default');

    return [
      '#type' => 'markup',
      '#markup' => $country . ' - ' .$city . ' - ' .$time
    ];
  }
}