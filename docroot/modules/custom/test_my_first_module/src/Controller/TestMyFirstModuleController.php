<?php
/**
 * Created by PhpStorm.
 * User: nmitev
 * Date: 19.09.16
 * Time: 17:50
 */

namespace Drupal\test_my_first_module\Controller;
use Drupal\Core\Controller\ControllerBase;

class TestMyFirstModuleController extends ControllerBase{
    public function content(){
        return array(
            '#type' => 'markup',
            '#markup' => $this->t('This is my first Drupal 8 module!'),
        );
    }
}