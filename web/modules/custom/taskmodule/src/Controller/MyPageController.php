<?php

namespace Drupal\taskmodule\Controller;

use Drupal\Core\Controller\ControllerBase;

class MyPageController extends ControllerBase {
    /**

     * Returns markup for our custom page.

     */
    public function customPage(){
        $modal_form = \Drupal::formBuilder()->getForm('Drupal\taskmodule\Form\TaskModule');

        return $modal_form;
    }
}