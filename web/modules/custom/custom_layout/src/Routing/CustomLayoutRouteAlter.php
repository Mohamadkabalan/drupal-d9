<?php

namespace Drupal\custom_layout\Routing;

use Drupal\Core\Routing\RouteBuildEvent;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Alters the Layout Builder UI routes.
 */
class CustomLayoutRouteAlter implements EventSubscriberInterface {

  /**
   * Alters existing Layout Builder routes.
   *
   * @param \Drupal\Core\Routing\RouteBuildEvent $event
   *   The route build event.
   */
  public function onAlterRoutes(RouteBuildEvent $event) {
    $collection = $event->getRouteCollection();

    $layout_builder_configure_section_route = $collection->get('layout_builder.configure_section');
    if ($layout_builder_configure_section_route) {
      $layout_builder_configure_section_route->setDefault('_form', '\Drupal\custom_layout\Form\CustomLayoutBuilderConfigureSectionForm');
    }

    $layout_builder_configure_section_form_route = $collection->get('layout_builder.configure_section_form');
    if ($layout_builder_configure_section_form_route) {
      $layout_builder_configure_section_form_route->setDefault('_form', '\Drupal\custom_layout\Form\CustomLayoutBuilderConfigureSectionForm');
    }

    $layout_builder_choose_block = $collection->get('layout_builder.choose_inline_block');
    if ($layout_builder_choose_block) {
      $layout_builder_choose_block->setDefault('_controller', '\Drupal\custom_layout\Controller\ChooseBlockController::inlineBlockList');
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[RoutingEvents::ALTER] = ['onAlterRoutes', -300];
    return $events;
  }

}
