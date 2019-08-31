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
      
      
      <link rel="stylesheet" type="text/css" href="<?php echo site_url("template/".config_item("template")."/styles.css");?>">
      <style type="text/css">
        body{
          width: 100%;
          height: 100%;
          
        }
        body {
          scrollbar-color: rgba(0, 0, 0, 0.1) #fff;
          scrollbar-width: thin; }
          body::-webkit-scrollbar {
            width: 0.5rem;
            background-color: rgba(255, 255, 255, 0.1);
            -webkit-box-shadow: none; }
          body::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.05); }
          body::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.15);
            outline: 1px solid slategrey; }

        [data-disabled], components {
          pointer-events: none;
          position: relative; }
          [data-disabled]::after, components:after {
            content: "Non-editable area";
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            padding-top: 5px;
            font-weight: 600;
            font-size: 12px;
            text-align: center;
            background: rgba(252, 252, 252, 0.85);
            border: 1px dashed #999;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center; }
        .blocks-list{
          display: block;
          width: 100%;
        }
        .blocks-list ol li{
          float: left;
        }

      </style>
</head>


  <body class="app" itemscope itemtype="http://schema.org/WebPage">
    
    <?php print_r($content);?>
    
  
  
  

  
  </body>

  </html>