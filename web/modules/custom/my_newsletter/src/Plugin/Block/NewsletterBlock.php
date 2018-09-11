<?php

namespace Drupal\my_newsletter\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "my_newsletter_block",
 *   admin_label = @Translation("NewsletterBlock"),
 *   category = @Translation("Custom"),
 * )
 */
class NewsletterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $modal_form = \Drupal::formBuilder()->getForm('Drupal\my_newsletter\Form\NewsletterForm');

    return $modal_form;
  }

}