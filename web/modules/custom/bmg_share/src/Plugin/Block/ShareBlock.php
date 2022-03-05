<?php

namespace Drupal\bmg_share\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ShareBlock' block.
 *
 * @Block(
 *  id = "share_block",
 *  admin_label = @Translation("Share block"),
 * )
 */
class ShareBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $path = \Drupal::service('path.current')->getPath();
    $request = \Drupal::request();
    $base_url = $request->getHost();
    if ($route = $request->attributes->get(\Symfony\Cmf\Component\Routing\RouteObjectInterface::ROUTE_OBJECT)) {
      $title = \Drupal::service('title_resolver')->getTitle($request, $route);
    }

    $output = '<a target="_blank" href="http://www.facebook.com/sharer.php?u=http://' . $base_url . $path . '&t=' . $title .'" class="share-it" id="share-facebook" ><i class="fab fa-facebook-f"></i></a>';
    $output .= '<a href="http://twitter.com/share?url=http://' . $base_url . $path  . '&text=' . $title  . '&via=EmmausBibleCo" class="share-it" id="share-twitter" target="_blank"><i class="fab fa-twitter"></i></a>';
    $output .= '<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=http://' . $base_url . $path  . '&title=' . $title  . '&source=http://' . $base_url .'" class="share-it" id="share-linkedin" data-id="share-linkedin" aria-label="linkedin share button"><i class="fab fa-linkedin-in"></i></a>';

    $build = [];
    $build['share_block'] = [
      '#markup' => $output,
      '#attached' => [
          'library' => [
            'bmg_share/social-share',
            'bmg_share/font-awesome',
          ],
        ],
    ];

    return $build;
  }

}
