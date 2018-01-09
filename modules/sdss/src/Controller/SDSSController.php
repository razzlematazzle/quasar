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
        
        $sdssApi = "https://skyserver.sdss.org/dr7/en/tools/search/x_sql.asp?format=xml&cmd=select%20top%2010%20*%20from%20specObj";
        //$format = "xml";
        //$sql = "SELECT TOP 10 * FROM Galaxy";
        $postfields = array("format" => "xml", 
                        "cmd" => "SELECT TOP 10 * FROM Galaxy");
        $sdssHtml = "<p>yolo</p>";
        
        
        //Rest service hit
        $ch = curl_init($sdssApi);
        //curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_PROXY, "194.200.94.5:8080");         //This setting lets us get by the proxy, remove for live
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        

        //$dt = simplexml_load_string(curl_exec($ch));  
        $dt = new \SimpleXMLElement(curl_exec($ch));
        curl_close($ch);   
        //End hitting rest service code
       
        foreach($dt->Answer->Row as $quasar){
            $sdssHtml .= "<p>" . $quasar->attributes()->{"specObjID"} . "<br/></p>";
        }
        
        $sdssHtml .= "<p>" + (string)$dt + "</p>";
        
        return array(
            '#type' => 'markup',
            '#markup' => t("Hello World from sdss controller. " . $sdssHtml),
        );
    }
}
