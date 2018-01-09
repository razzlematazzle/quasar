<?php

/**
 * Description of SDSSController
 * Controller that pulls in a displays information from SDSS
 * @author rzh
 */

namespace Drupal\sdss\Controller;

use Drupal\Core\Controller\ControllerBase;

class SDSSController extends ControllerBase{
    
    public function content(){
        
        $sdsshtml = "<p>yolo</p>";
        
        return array(
            '#type' => 'markup',
            '#markup' => t("Hello World from sdss controller" . $sdsshtml),
        );
    }
}
