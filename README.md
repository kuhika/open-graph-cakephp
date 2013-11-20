open-graph-cakephp
==================

Open graph integration for Cakephp 

First of all download this code and move opengraph directory to app/Vendor directory.

After that, in your controller's view method include OpenGraph Vendor.

App::import('Vendor', 'opengraph', array('file' => 'opengraph' . DS . 'OpenGraphNode.php'));

And Write following code in your controller.

<pre>

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
					 
				} if( ($node->is_str_contain($key,"description"))){
					 $desc = $value;
				//die("description");
				} if($node->is_str_contain($key,"title")){
				  $title = $value;	
				}if($node->is_str_contain($key,"url") && (filter_var($value, FILTER_VALIDATE_URL))){ 
				  	
				  $url = $value;	
				}if($node->is_str_contain($key,"content")){ 
				  preg_match_all('/src="([^"]*)"/', $value, $result);
			      	  $image = isset($result[1][0]) ? $result[1][0] : ("");	
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
			 
    	}   else{
    	    echo "Please enter valid url"; die();
    	}	
    }

</pre>

And View of the Code is 

opengraph.ctp

<pre>
<div style="width:400px;bgcolor:#123423;">
	<span style="width:100%;">
		<span style="width:50%;float:left;" >
	
	
		<?php
if($image == 'no-pre.png'){
		echo $this->Html->image('no-pre.png', array(
    	"class" => 'image'
));
}else{
	?>
		<img src="<?php echo $image;?>"class="image"/>
	<?php 
}
		
	
		?>
		    
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
</pre>


And if you want to use as php project then you could copy opengraph directory.

And open the open.php file from the browser.
