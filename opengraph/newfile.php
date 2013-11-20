<?php
echo "parag";
include "OpenGraphNode.php";

# Fetch and parse a URL
#
$page = $_REQUEST['url'];
$node = new OpenGraphNode($page); 
# Retrieve the title
#
print "<br/>";
print $node->title . "\n";    # like this
print "<br/>";
print $node->title() . "\n";  # or with parentheses

# And obviously the above works for other Open Graph Protocol
# properties like "image", "description", etc. For properties
# that contain a hyphen, you'll need to use underscore instead:
#
function isImage($img){ 
    if(!getimagesize($img)){ 
        return FALSE; 
    }else{ 
        return TRUE; 
    } 
}


print "<br/>";
print $node->street_address . "\n";

# OpenGraphNode uses PHP5's Iterator feature, so you can
# loop through it like an array.
#
$image = "";
foreach ($node as $key => $value) {
	if (stripos($key,"image") !== false) {
   $image = $value;
}
	
		 
		 
	print "$key => $value\n";
	print "<br/>";
}
?>
<img src="<?php echo $image;?>"/>