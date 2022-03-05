<?php
/**
 * @file
 * Contains \Drupal\views_content_class\Plugin\views\display_extender\ContentClass.
 */
namespace Drupal\views_content_class\Plugin\views\display_extender;

use Drupal\views\Plugin\views\display_extender\DisplayExtenderPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Head metadata display extender plugin.
 *
 * @ingroup views_display_extender_plugins
 *
 * @ViewsDisplayExtender(
 *   id = "views_content_class",
 *   title = @Translation("content class display extender"),
 *   help = @Translation("Adds a settings to views to include classes for the view content wrapper div."),
 *   no_ui = FALSE
 * )
 */
class ContentClass extends DisplayExtenderPluginBase {
    /**
   * Static member function to list which sections are defaultable
   * and what items each section contains.
   */
  public function defaultableSections(&$sections, $section = NULL) { 
    $sections['css_class'] = ['css_class', 'css_content_class'];
    $sections['css_content_class'] = ['css_class', 'css_content_class'];
  }
  
  /**
   * Provide the key options for this plugin.
   */
  public function defineOptionsAlter(&$options) {
    $options['defaults']['default']['css_content_class'] = TRUE;
    $options['css_content_class'] = ['default' => ''];
  }
  
  /**
 * Provide the default summary for options and category in the views UI.
 */
/*
  public function optionsSummary(&$categories, &$options) {
    $has_class = $this->options['css_class'] . ' ' . $this->options['css_content_class'];
    $options['css_class'] = array(
      'category' => 'css_class',
      'title' => t('CSS Class'),
      'value' => trim($has_class) ? trim($has_class) : $has_class,
    );
  }
*/
  
  /**
   * Provide a form to edit options for this plugin.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    if($form_state->get('section') == 'css_class') {
      $form['css_content_class'] = [
        '#type' => 'textfield',
        '#title' => $this->t('CSS content class name(s)'),
        '#description' => $this->t('Separate multiple classes by spaces.'),
        '#default_value' => $this->options['css_content_class'],
      ];
    }
  }
  
  /**
   * Validate the options form.
   */
  public function validateOptionsForm(&$form, FormStateInterface $form_state) { }

  /**
   * Handle any special handling on the validate form.
   */
  public function submitOptionsForm(&$form, FormStateInterface $form_state) {
    if($form_state->get('section') == 'css_class') {
      $this->options['css_content_class'] = $form_state->getValue('css_content_class');
    }
  }
}
?>