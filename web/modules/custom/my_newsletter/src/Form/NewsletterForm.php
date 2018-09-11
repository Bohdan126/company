<?php

namespace Drupal\my_newsletter\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Mailchimp\MailchimpLists;

/**
 * Class NewsletterForm.
 *
 * @package Drupal\my_newsletter\Form
 */
class NewsletterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_newsletter_form';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#title_display' => 'invisible',
      '#required' => TRUE,
      '#attributes' => array(
        'placeholder' => $this->t('Email'),
      ),
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    );
    return $form;
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');

    $list_id = \Drupal::config('my_newsletter.settings')->get('list_id');
    $api_key = \Drupal::config('mailchimp.settings')->get('api_key');

    $mailchimp_list = new MailchimpLists($api_key);
    if ($mailchimp_list->getMemberInfo($list_id, $email)) {
      drupal_set_message($this->t('You have already subscribed.'), 'warning');
    }
    elseif ($mailchimp_list->addMember($list_id, $email, ['status' => 'subscribed'])) {
      drupal_set_message($this->t('You have been successfully subscribed.'));
    }
  }

}
