<?php
/**
 * Created by PhpStorm.
 * User: nmitev
 * Date: 20.09.16
 * Time: 10:30
 */

namespace Drupal\test_my_first_module\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class TestMyFirstModuleForm extends FormBase {
    public function getFormId(){
        return 'test_my_first_module_registration_form';
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