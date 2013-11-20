<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class OpenGraphController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
    public $uses = array();

    function opengraph($url = ""){
    	$url = trim($this->data['url']);
    	$this->layout = false; 
    	if($url != "" && (filter_var($url, FILTER_VALIDATE_URL)))
    	{
    		
	    	App::import('Vendor', 'opengraph', array('file' => 'opengraph' . DS . 'OpenGraphNode.php'));
	    	    	 
			# Fetch and parse a URL
			#
			$page = $url;
			$node = new OpenGraphNode($page); 
			# Retrieve the title
			#  
			
		
			$image = $desc = $title = $url = "" ;
			foreach ($node as $key => $value) {
				if($node->is_str_contain($key,"image") && getimagesize($value)) {
					$image = $value; 
					//print "$key => $value\n";
					 
				} if( ($node->is_str_contain($key,"description"))){
					 $desc = $value;
					//print "$key => $value\n"; 
				//die("description");
				} if($node->is_str_contain($key,"title")){
				  $title = $value;	 
				 // print "$key => $value\n";
				 // die("title");
				}if($node->is_str_contain($key,"url") && (filter_var($value, FILTER_VALIDATE_URL))){ 
				  	
				  $url = $value;	
				 // print "$key => $value\n";
				  //die("url");
				}if($node->is_str_contain($key,"content")){ 
				  preg_match_all('/src="([^"]*)"/', $value, $result);
			      $image = isset($result[1][0]) ? $result[1][0] : ("");	
				  //print "$key => $value\n";
				 //die("url");
				}
				
			
			}
		
			$urlData =  parse_url($page);
		
			
			$host = $urlData['host'];
			$image = ($image != "") ? ($image) : ("");
			$desc = ($desc != "") ? ($desc) : ( "");
			
			if($desc == "" || $image == ""){
				$data = $node->image();
				 
				if($image == ""){
				    $image = (isset($data['image']) &&  trim($data['image']) != "" ) ? $data['image'] :  ( isset($data['icon']) && trim($data['icon']) != "" ? $data['icon'] :  "no-pre.png" ) ;	
				}
				if($desc == ""){
					$desc = (isset($data['description']) && trim($data['description']) != "" )? $data['description'] : "";
				}
			}
			 
			
			
			$this->set('title', $title);
			$this->set('page', $page);
			$this->set('host', $host);
			$this->set('desc', $desc);
			$this->set('image', $image);
			 
    	}  
	else{
         	echo "Please enter Valid Url";die();
    	}	
    }
}

