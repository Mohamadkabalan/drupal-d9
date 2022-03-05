<?php

/**
 * @file
 * Contains \Drupal\bmg_site_settings\Form\BmgSiteSettingsForm.
 */

namespace Drupal\bmg_site_settings\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\Core\Url;

class BmgSiteSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bmg_site_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['system.site', 'google_analytics.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = [];
    $form['site_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site Name'),
      '#default_value' => \Drupal::config('system.site')->get('name'),
      '#required' => TRUE,
    ];
    $form['site_slogan'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mission/Slogan'),
      '#default_value' => \Drupal::config('system.site')->get('slogan'),
      '#required' => TRUE,
    ];
    $form['site_mail'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site Email'),
      '#default_value' => \Drupal::config('system.site')->get('mail'),
      '#description' => $this->t('The From address in automated e-mails sent during registration and new password requests, and other notifications. (Use an address ending in your site\'s domain to help prevent this e-mail being flagged as spam.)'),
      '#required' => TRUE,
    ];
    $moduleHandler = \Drupal::service('module_handler');
    if ($moduleHandler->moduleExists('google_analytics')){
      $form['googleanalytics_account'] = [
        '#title' => $this->t('Google Analytics ID'),
        '#type' => 'textfield',
        '#default_value' => \Drupal::config('google_analytics.settings')->get('account'),
        '#size' => 15,
        '#maxlength' => 20,
        '#description' => $this->t('This ID is unique to each site you want to track separately, and is in the form of UA-xxxxxxx-yy. To get a Web Property ID, <a href=":analytics">register your site with Google Analytics</a>, or if you already have registered your site, go to your Google Analytics Settings page to see the ID next to every site profile. <a href=":webpropertyid">Find more information in the documentation</a>.', [':analytics' => 'http://www.google.com/analytics/', ':webpropertyid' => Url::fromUri('https://developers.google.com/analytics/resources/concepts/gaConceptsAccounts', ['fragment' => 'webProperty'])->toString()]),
      ];
    }

    return parent::buildForm($form, $form_state);
  }

    /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('system.site')
      ->set('name', $form_state->getValue('site_name'))
      ->set('mail', $form_state->getValue('site_mail'))
      ->set('slogan', $form_state->getValue('site_slogan'))
      ->save();

    $moduleHandler = \Drupal::service('module_handler');
    if ($moduleHandler->moduleExists('google_analytics')){
      $this->config('google_analytics.settings')
        ->set('account', $form_state->getValue('googleanalytics_account'))
        ->save();
    }

    parent::submitForm($form, $form_state);
  }

}
