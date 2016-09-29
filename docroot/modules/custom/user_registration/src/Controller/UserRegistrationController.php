<?php
/**
 * Created by PhpStorm.
 * User: nmitev
 * Date: 21.09.16
 * Time: 15:15
 */

namespace Drupal\user_registration\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilder;
use Drupal\Core\Render\Element\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouteCollection;
use Drupal\user_registration\Form\UserRegistrationForm;
use Drupal\Core\Form\FormBase;

class UserRegistrationController extends ControllerBase {
  public function content() {
    $table['mytable'] = array(
      '#type' => 'table',
      '#header' => array(t('First name'), t('Last name'), t('E-mail'), t('Operations')),
      '#empty' => t('There is currently no submitted data.'),
    );

    $config = \Drupal::configFactory()->listAll('userreg.user.');
    foreach ($config as $value) {
      $data = explode('.', $value);
      $configuration = \Drupal::configFactory()->getEditable($value);
      $table['mytable'][$value]['First name'] = array(
        '#plain_text' => $configuration->get('firstname'),
      );
      $table['mytable'][$value]['Last name'] = array(
        '#plain_text' => $configuration->get('lastname'),
      );
      $table['mytable'][$value]['E-mail'] = array(
        '#plain_text' => $configuration->get('email'),
      );
      $table['mytable'][$value]['Operations'] = array(
        '#type' => 'operations',
        '#links' => array(),
      );
      $table['mytable'][$value]['Operations']['#links']['Edit'] = array(
        'title' => t('Edit'),
        'url' => \Drupal\Core\Url::fromRoute('user_registration.form', array('name' => $data[2])),
      );
      $table['mytable'][$value]['Operations']['#links']['Delete'] = array(
        'title' => t('Delete'),
        'url' => \Drupal\Core\Url::fromRoute('user_registration.manage_delete', array('name' => $data[2])),
      );
      $configuration->save(true);
    }
    return $table;
  }

  public function delete($name = NULL) {
    $config = \Drupal::configFactory()->getEditable('userreg.user.' . $name);
    $config->delete();
    drupal_set_message('Users registration has been deleted.');
    return new RedirectResponse(\Drupal\Core\Url::fromRoute('user_registration.content')->toString());
  }
}