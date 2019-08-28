Sonata.BlocksGroup['Bootstrap 4'] =[
	<?php 
	$arv = [];
	foreach ($data as $key => $value) { 
		$arv[] = '"bootstrap4/'.$value->block_keyword.'"';
	} 
	print_r(implode($arv, ","));
	?>

];

<?php foreach ($data as $key => $value) { ?>
	
Sonata.Blocks.add("bootstrap4/<?php echo $value->block_keyword;?>", {
    name: "<?php echo $value->block_name;?>",
	dragHtml: '<img src="<?php echo site_url($value->block_image);?>">',    
    image: "<?php echo site_url($value->block_image);?>",
    html: `<?php echo $value->block_content;?>`
});
<?php } ?>