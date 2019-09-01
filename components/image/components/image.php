<div class="carousel">
   <img <?php echo _attributes_to_string($attr);?> <?php echo (isset($attr["lazy"]) ? 'data-lazy="true" data-src="'.$data.'"' : 'src="'.$data.'"');?>/>
</div>