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

