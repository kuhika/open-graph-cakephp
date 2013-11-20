<?php

include "OpenGraphNode.php";

# Fetch and parse a URL
#
$page = $_REQUEST['url'];
$node = new OpenGraphNode($page); 
# Retrieve the title
#  

# OpenGraphNode uses PHP5's Iterator feature, so you can
# loop through it like an array.
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
	
	/*print "<br/>";
	print "$key => $value\n";
	print "<br/>";*/
}

$urlData =  parse_url($page);

$host = $urlData['host'];
$image = ($image != "") ? ($image) : ("");
$desc = ($desc != "") ? ($desc) : ( "");

if($desc == "" || $image == ""){
	$data = $node->image();
	//echo "<pre>";print_r($data);die();
	if($image == ""){
	    $image = (isset($data['image']) &&  trim($data['image']) != "" ) ? $data['image'] :  ( isset($data['icon']) && trim($data['icon']) != "" ? $data['icon'] :  "no-pre.png" ) ;	
	}
	if($desc == ""){
		$desc = (isset($data['description']) && trim($data['description']) != "" )? $data['description'] : "";
	}
}

?>
<div style="width:400px;bgcolor:#123423;">
	<span style="width:100%;">
		<span style="width:50%;float:left;" >
		  	<img src="<?php echo $image;?>"class="image"/>  
		</span>
		<span style="width:50%;float:right;"> 
			<?php echo  (isset($title) && trim($title) != "") ?  "<div class=\"title\">".$title."</div>" : "";?>
			<?php echo  (isset($page) && trim($page) != "") ?  "<div class=\"url\"><a href='".$page."' title='".$title."'>".$host."</a></div>" : "";?>
			<?php echo  (isset($desc) && trim($desc) != "") ?  "<div class=\"description\">".$desc."</div>" : "";?>
			<span style="width:100%;float:right;"> 
			<input type="checkbox" name="no-thumbnail" class="no-thumbnail" /> No thumbnail
			</span>
		</span>
		
	</span>

</div>
