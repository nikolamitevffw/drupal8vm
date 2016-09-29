<?php
/**
 * Created by PhpStorm.
 * User: nmitev
 * Date: 20.09.16
 * Time: 15:48
 */

namespace Drupal\user_registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;

class UserRegistrationForm extends FormBase {
  public function getFormId() {
    return 'user_registration_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $name = \Drupal::request()->get('name');
    if ($name) {
      $config = \Drupal::configFactory()->getEditable('userreg.user.' . $name);
      $form['firstname'] = array(
        '#type' => 'textfield',
        '#title' => t('First name'),
        '#default_value' => $config->get('firstname'),
      );
      $form['lastname'] = array(
        '#type' => 'textfield',
        '#title' => t('Last name'),
        '#default_value' => $config->get('lastname'),
      );
      $form['email'] = array(
        '#type' => 'email',
        '#title' => t('E-mail'),
        '#default_value' => $config->get('email'),
      );
      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Save'),
      );
    }
    else {
      $form['firstname'] = array(
        '#type' => 'textfield',
        '#title' => t('First name'),
      );
      $form['lastname'] = array(
        '#type' => 'textfield',
        '#title' => t('Last name'),
      );
      $form['email'] = array(
        '#type' => 'email',
        '#title' => t('E-mail'),
      );
      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Register'),
      );
    }
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $name = \Drupal::request()->get('name');
    if ($name) {
      $configUpdate = \Drupal::configFactory()->getEditable('userreg.user.' . $name);
      $configUpdate->set('firstname', $form_state->getValue('firstname'))
        ->set('lastname', $form_state->getValue('lastname'))
        ->set('email', $form_state->getValue('email'))
        ->save(true);
      drupal_set_message('Your changes has been saved.');
    }
    else {
      $config = \Drupal::configFactory()->getEditable('userreg.user.' . $form_state->getValue('firstname'));
      $config->set('firstname', $form_state->getValue('firstname'))
        ->set('lastname', $form_state->getValue('lastname'))
        ->set('email', $form_state->getValue('email'))
        ->save(true);
      drupal_set_message('You have been registered for the event.');
    }
    $form_state->setRedirect('user_registration.content');
  }
}