<?php
echo "<h1>Open Graph</h1>";
?>
<input type="text" name="url" value="" id ="url"/>
<script>
$(document).ready(function(){

$("#url").bind('hover click',function(){

var url = $(this).val();
alert(url)
	
});

	
});
</script>