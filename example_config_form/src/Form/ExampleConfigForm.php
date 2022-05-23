<?php

namespace Drupal\example_config_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Admin form for Content Preview feature.
 */
class ExampleConfigForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'example_config_form.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'example_config_form_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config(static::SETTINGS);

    // zone seetings
    $zones = system_time_zones(NULL, TRUE);

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Add Country'),
      '#default_value' => $config->get('country'),
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#description' => $this->t('Add City'),
      '#default_value' => $config->get('city'),
    ];

    $form['timezone']['date_default_timezone'] = [
      '#type' => 'select',
      '#title' => t('Select Timezone'),
      '#default_value' => $config->get('timezone.default'),
      '#options' => $zones,
    ];

    return parent::buildForm($form, $form_state);

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Retrieve the configuration.
    $this->configFactory->getEditable(static::SETTINGS)
      // Set the submitted configuration settings.
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone.default', $form_state->getValue('date_default_timezone'))
      ->save();

    return parent::submitForm($form, $form_state);

  }

}
