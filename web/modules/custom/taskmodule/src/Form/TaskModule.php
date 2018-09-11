<?php

namespace Drupal\taskmodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class TaskModule extends FormBase {
    public function getFormId()
    {
        // TODO: Implement getFormId() method.
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
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // TODO: Implement buildForm() method.
        $form['title'] = array(
            '#type' => 'textfield',
            '#title' => $this
                ->t('Full Name'),
            '#size' => 60,
            '#maxlength' => 128,
            '#required' => TRUE,
        );
        $form['email'] = array(
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => TRUE,
        );
        $form['phone'] = array(

            '#type' => 'tel',

            '#title' => t('Phone'),

        );
        $form['Subject'] = array(
            '#type' => 'textfield',
            '#title' => $this
                ->t('Subject'),
        );
        $form['text'] = array(
            '#type' => 'textarea',
            '#title' => $this
                ->t('Message'),
        );
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this
                ->t('Save'),
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
    public function validateForm(array &$form, FormStateInterface $form_state) {
        // Validate video URL.
        if (strlen($form_state->getValue('title')) < 5) {
            $form_state->setErrorByName('title', $this->t('The text is too short.'));
        }
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
        foreach ($form_state->getValues() as $key => $value) {
            drupal_set_message($key . ': ' . $value);
        }
    }
}