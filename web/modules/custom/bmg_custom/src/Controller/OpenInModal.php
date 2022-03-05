<?php

namespace Drupal\bmg_custom\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenDialogCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class OpenInModal extends ControllerBase {

  /**
   * @return AjaxResponse
   */
  public function content($nid) {
    $node = Node::load($nid);
    $output = \Drupal::entityTypeManager()->getViewBuilder('node')->view($node, 'modal');
    $html = render($output);
//    dump($html);

    $response = new AjaxResponse();
    $dialog_options = [
      'dialogClass' => 'general-site-style',
      'width' => '1000'
    ];
    $response->addCommand(new OpenModalDialogCommand('', $html, $dialog_options));
    return $response;
  }

}
