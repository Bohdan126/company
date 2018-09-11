<?php

namespace Drupal\my_user\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\user\Entity\User;
use Drupal\user\UserInterface;

class MyUserUpdatePasswordForm extends FormBase{

  public function getFormId() {
    return 'my_user_update_password_form';
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
  public function buildForm(array $form, FormStateInterface $form_state, AccountInterface $user = NULL) {
    $form['pass'] = array(
      '#type' => 'password',
      '#title' => $this
        ->t('Password'),
      '#size' => 25,
    );

    $form['confirm_pass'] = array(
      '#type' => 'password',
      '#title' => $this
        ->t('Confirm Password'),
      '#size' => 25,
    );

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this
        ->t('Save'),
    );

    $form['uid'] = [
      '#type' => 'hidden',
      '#value' => $user->id(),
    ];

    return $form;
}

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $pass = $form_state->getValue('pass');
    $confirm_pass = $form_state->getValue('confirm_pass');

    if ($pass != $confirm_pass){
      $form_state->setErrorByName('confirm_pass', 'Your Confirm Pass should be the same as Pass. ');
    }
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
    User::load($form_state->getValue('uid'))
      ->setPassword($form_state->getValue('pass'))
      ->save();

    drupal_set_message('Your password has been successfully updated.');
}}