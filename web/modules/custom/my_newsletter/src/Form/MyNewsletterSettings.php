<?php

namespace Drupal\my_newsletter\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;


class MyNewsletterSettings extends ConfigFormBase {

  public function getFormId() {
    return 'task_module_form';
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
    $lists = $this->config('my_newsletter.settings')->get('lists');

    drupal_set_message(Markup::create('<pre>' . print_r($lists, 1) . '</pre>'));

    $form['lists'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Lists'),
      '#tree' => TRUE,
    ];

    $form['lists']['list_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('List "ID" id'),
      '#required' => TRUE,
      '#default_value' => $lists['list_id'],
    );

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('my_newsletter.settings')
      ->set('lists', $form_state->getValue('lists'))
      ->save();
  }

  protected function getEditableConfigNames() {
    return ['my_newsletter.settings'];
  }
}