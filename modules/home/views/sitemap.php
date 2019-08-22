<?php header('Content-type: application/xml; charset=utf-8') ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.9 http://www.google.com/schemas/sitemap/0.9/sitemap.xsd"  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"  xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

    <url>
        <loc><?php echo site_url();?></loc>
        <changefreq>monthly</changefreq>
        <lastmod><?php echo date("r");?></lastmod>
      	<priority>0.8</priority>
    </url>
    <?php foreach ($this->pages_model->getList() as $key => $value) { ?>
    	
    <url>
        <loc><?php echo page_url($value->url);?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
	<?php } ?>
	<?php foreach ($this->catalog_model->getList() as $key => $value) { ?>
    	
    <url>
        <loc><?php echo catalog_url($value->url, $value->channel);?></loc>
        <changefreq>monthly</changefreq>
        
        <priority>0.5</priority>
    </url>
	<?php } ?>

	<?php foreach ($this->posts_model->getList(["limit" => 200]) as $key => $value) { 
		$image = @array_pop($value->image);
	?>
    	
    <url>
        <loc><?php echo post_url($value->url, $value->channel);?></loc>
        <changefreq>daily</changefreq>
        <lastmod><?php echo $value->updated_date;?></lastmod>
        <priority>0.5</priority>
        <?php if($image){?>
        <image:image>
	      <image:loc><?php echo site_url($value->image[0]);?></image:loc>
	      <image:title><?php echo $value->name;?></image:title>
	    </image:image>
		<?php } ?>
	    <news:news> 
	    	<news:publication> 
	    		<news:name><?php echo $value->name;?></news:name> 
	    		<news:language>vi</news:language> 
	    	</news:publication> 
	    	<news:publication_date><?php echo $value->updated_date;?></news:publication_date> 
	    	<news:title><?php echo $value->name;?></news:title> 
	    </news:news>
    </url>
	<?php } ?>
	<?php foreach ($this->gallery_model->getImageList(false,["limit" => 100]) as $key => $value) { ?>
		<image:image>
	      <image:loc><?php echo site_url($value->image_url);?></image:loc>
	      <image:title><?php echo $value->image_name;?></image:title>
	    </image:image>
	<?php } ?>
</urlset>