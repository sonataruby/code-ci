<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js" lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1,user-scalable=no,width=device-width">
      <title><?php echo @$header["title"];?></title>  
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">    
      
      
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