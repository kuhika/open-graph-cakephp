<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<body>
<style>
.title{
color: #01317E;
font-size: 0.9em;
line-height: 14px;
line-height: 1.4rem;
font-weight: bold;
margin: 0 0 2px 0;
text-align: left;
padding-top: 5px;
}

.url{
color: #4c4c4c;
font-size: 0.9em;
padding-top: 2px;
padding-bottom: 3px;
}

.description{
font-size: 12px;
color: #191919;
}

.image {
width: 100px;
height: 100px;
max-width: 120px;
max-height: 120px;
}

.no-thumbnail {
margin: 0;
padding: 0;
border: 0;
font-weight: inherit;
font-style: inherit;
font-size: 100%;
font-family: inherit;
vertical-align: baseline;}
</style>
<?php
echo "<h1>Open Graph</h1>";
?>
<input type="text" name="url" value="" id ="url"/>
<div id ="response">

</div>


<script>
$(document).ready(function(){
$("#response").html("Loading");
$("#url").bind('blur',function(){
$("#response").html("Loading Start");
var url = $(this).val();
alert(url)
$.ajax({
	  type: "POST",
	  url: "getOpenGraph.php",
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
</body>
</html>