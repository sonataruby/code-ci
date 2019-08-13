<!doctype html>
<html class="no-js" lang="en">
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
      <link rel="alternate" type="application/rss+xml" title="Sitemap Feed for <?php echo site_url();?>" href="<?php echo site_url("sitemap.xml");?>" />
      <link rel="alternate" type="application/rss+xml" title="RSS Feed for <?php echo site_url();?>" href="<?php echo site_url("feeds");?>" />
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script type="text/javascript">(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
      
</head>


  <body class="app" itemscope itemtype="http://schema.org/WebPage">
  
  <div class="container" style="max-width: 680px;">
    <div class="card">
      <div class="card-body">
        <?php echo form_open();?>
          <h5>Administrator</h5>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          
          
          <h5>Database</h5>

          <div class="row">
            <div class="col-lg-7 col-sm-12">
              <div class="form-group">
                <label for="exampleInputPassword1">Server</label>
                <input type="text" name="server" class="form-control" value="localhost">
              </div>
            </div>
            <div class="col-lg-5 col-sm-12">
              <div class="form-group">
                <label for="exampleInputPassword1">Driver</label>

                  <select class="custom-select" name="driver">
                    <option value="mysqli">Mysqli</option>
                    
                  </select>
              </div>
            </div>
          </div>
          


          

          <div class="form-group">
            <label for="exampleInputPassword1">Username</label>
            <input type="text" name="userdb" class="form-control">
          </div>


          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="text" name="passdb" class="form-control">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Database Name</label>
            <input type="text" name="database" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary">Install</button>
        </form>
      </div>
    </div>
  </div>
  
  
  
  <script type="text/javascript">(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
  </body>
  </html>