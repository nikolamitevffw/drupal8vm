<?php
/**
 * Created by PhpStorm.
 * User: nmitev
 * Date: 20.09.16
 * Time: 10:30
 */

namespace Drupal\custom_registration_page\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomRegistrationPageForm extends FormBase {
    public function getFormId(){
        return 'custom_registration_page';
    }
    public function buildForm (array $form, FormStateInterface $form_state){
        $form['firstName'] = array(
            '#type' => 'textfield',
            '#title' => t('First name'),
        );
        $form['lastName'] = array(
            '#type' => 'textfield',
            '#title' => t('Last name'),
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => t('Register'),
        );
        return $form;
    }
    public function submitForm (array &$form, FormStateInterface $form_state){
        // Add submit action
    }
}