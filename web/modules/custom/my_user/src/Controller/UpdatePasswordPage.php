<?php
namespace Drupal\my_user\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;

/**
 * Provides route responses for the Example module.
 */
class UpdatePasswordPage extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function userPass(AccountInterface $user) {
    $output = [];

    $output['header'] = [
      '#type' => 'html_tag',
      '#tag' => 'h3',
      '#value' => t('TODO List'),
      '#attributes' => [
        'class' => ['my-header'],
      ],
    ];

    $output['content'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => ['my-content'],
      ],
    ];

    $help = [
      '#type' => 'item',
      '#title' => t('My label'),
      '#markup' => '<p>' . t('Test') . '</p>',
    ];

    $output['content']['items'] = [
      '#theme' => 'item_list',
      '#items' => [
        Link::fromTextAndUrl(t('User'), Url::fromUserInput('/user')),
        'Two',
        $help,
      ],
    ];

    $output['footer'] = [
      '#theme' => 'my_user_custom_pane',
      '#title' => t('This is footer'),
      '#body' => t('Some text...'),
    ];

    $output['form'] = \Drupal::formBuilder()->getForm('Drupal\my_user\Form\MyUserUpdatePasswordForm', $user);

    return $output;
  }

}