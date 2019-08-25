<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js" lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1,user-scalable=no,width=device-width">
      <title><?php echo @$header["title"];?></title>  
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">    
      <meta name="author" content="VTNPLUS Co.,ltd 2009-<?php echo date("Y");?>">
      <meta name="copyright" content="<?php echo @get_instance()->apps->company_name;?>">
      <meta name="datetime" content="<?php echo date("r");?>">
      <meta name="token" content="<?php echo date("r");?>">
      <link rel="canonical" href="<?php echo site_url();?>"/>

      <link rel="icon" href="<?php echo site_url(config_item("icon"));?>" type="image/png" />
      <link rel="icon" href="<?php echo site_url('upload/image/favicon@32x32.png');?>" sizes="32x32" type="image/png">
      <link rel="icon" href="<?php echo site_url('upload/image/favicon@16x16.png');?>" sizes="16x16" type="image/png">
      <link rel="icon" href="<?php echo site_url('upload/image/favicon@64x64.png');?>" sizes="64x64" type="image/png">
      <link rel="shortcut icon" href="<?php echo site_url(config_item("icon"));?>" type="image/x-icon" />
      <link rel="manifest" href="<?php echo site_url("manifest.json");?>">
      <link rel="icon" href="<?php echo site_url("favicon.ico");?>">
      <meta name="msapplication-config" content="<?php echo site_url("browserconfig.xml");?>">


      <meta name="description" content="<?php echo @$header["description"];?>">
      <meta name="keywords" content="<?php echo @$header["keyword"];?>">
      <meta name="robots" content="index,follow"/>
      <meta name="googlebot" content="index, follow"/>
      <meta name="Googlebot-News" content="index, follow"/>
      <meta name="Googlebot-Shopping" content="index, follow">
      <meta name="Feedfetcher-Google" content="index, follow">
      <meta name="Bingbot" content="index, follow">
      <meta name="msnbot" content="index, follow">    
      <meta property="og:title" content="<?php echo @$header["title"];?>"/>
      <meta property="og:description" content="<?php echo @$header["description"];?>"/>
      <meta property="og:url" content="<?php echo current_url();?>"/>
      <meta property="og:image" content="<?php echo site_url(@$header["image"]);?>"/>
      <meta property="og:type" content="website"/>
      <meta property="og:site_name" content="<?php echo @$header["title"];?>"/>
      
      <?php libs_url('css/bootstrap.css',['name' => "Bootstrap CSS"]);?>
      <?php libs_url('icoins/css/icoin.css',['name' => "Font Icoin CSS"]);?>
      <?php libs_url('css/bs-theme.css',['name' => "Bootstrap CSS"]);?>
      
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      
      
      <?php libs_url('js/app.js',['name' => "Bootstrap & Jquery"]);?>
      <?php echo template_url("styles.css");?>
      <?php echo template_url("app.js");?>
      <style type="text/css">
        body{
          width: 100%;
          height: 100%;
          
        }
      </style>
</head>


  <body class="app" itemscope itemtype="http://schema.org/WebPage">
    
    <?php print_r($content);?>
    
  
  
  

  
  </body>

  </html>