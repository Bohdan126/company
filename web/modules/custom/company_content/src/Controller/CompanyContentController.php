<?php

namespace Drupal\company_content\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */

class CompanyContentController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function test() {
    $query = \Drupal::database()->select('users_field_data', 'u');
    $query->fields('u', ['uid', 'created']);
    $query->condition('u.uid', 0, '!=');
    $query->orderBy('u.uid');
    $query->range(0, 2);
    $query->addExpression("FROM_UNIXTIME(u.created, '%d.%m.%Y')", 'date');

    $uids = $query->execute()->fetchAllAssoc('uid', \PDO::FETCH_ASSOC);

    foreach ($uids as $uid => $item) {
      drupal_set_message($item['date']);
    }

    return [
      '#markup' => '',
    ];
  }


  public function content() {
    $query = \Drupal::database()->select('node_field_data', 'n');
    $query->fields('n', ['title']);
    $query->condition('n.status', 1);

    $titles = $query->execute()->fetchCol();


    $output = [
      '#theme' => 'item_list',
      '#items' => $titles,
    ];

    return $output;
  }

}