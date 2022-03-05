<?php

namespace Drupal\custom_layout\Form;

use Drupal\layout_builder\Form\ConfigureSectionForm as OriginalConfigureSectionForm;

/**
 * Class Custom Layout Builder Configure Section Form.
 */
class CustomLayoutBuilderConfigureSectionForm extends OriginalConfigureSectionForm {

  /**
   * Get the layout plugin being modified.
   *
   * @return \Drupal\Core\Layout\LayoutInterface|\Drupal\Core\Plugin\PluginFormInterface
   *   The layout plugin object.
   */
  public function getLayout() {
    return $this->layout;
  }

  /**
   * Get the delta value for the current section.
   *
   * @return int
   *   The delta id for the current section setting form.
   */
  public function getDelta() {
    return $this->delta;
  }

}