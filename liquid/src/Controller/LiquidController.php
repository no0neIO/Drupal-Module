<?php

namespace Drupal\liquid\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * liquid controller.
 */
class LiquidController extends ControllerBase
{

  /**
   * Returns a render-able array for a page.
   */
  public function content()
  {
    $entity = \Drupal::entityTypeManager()->getStorage('node');
    $query = $entity->getQuery();

    $ids = $query->condition('status', 1)
      ->condition('type', 'article')
      ->pager(5)
      ->execute();

    $nodes = Node::loadMultiple($ids);

    foreach ($nodes as $node) {
      $titles[] = $node->title->value;
    }

    return [
      '#theme' => 'liquid-theme-hook',
      '#titles' => $titles,
    ];
  }
}
