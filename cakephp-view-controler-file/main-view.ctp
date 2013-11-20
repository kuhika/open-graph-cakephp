<?php
echo "<h1>Open Graph</h1>";
?>
<input type="text" name="url" value="" id ="url"/>
<div id ="response">

</div>
   
   
<script>
$(document).ready(function(){ 
$("#url").bind('blur',function(){
$("#response").html("Loading Start");
var url = $(this).val();

$.ajax({
	  type: "POST",
	  url: "http://localhost/your-project/opengraph/opengraph",
	  data: { url: url}
	})
	.done(function( msg ) {
		 
		  $("#response").html(msg)
	});
	
});

$("body").delegate(".no-thumbnail", "click", function() {
	 
	  if($(this).prop('checked') == true){
		  $(".image").parent().hide();
		  $(".image").parent().next().css('width','100%');
		  $(this).parent().parent().css('float','left');
	  }else{
		  $(".image").parent().show();
		  $(".image").parent().next().css('width','50%');
		  $(this).parent().parent().css('float','right');
	  }
});
});
</script>

