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
      <link rel="icon" href="<?php echo @get_instance()->apps->icoin;?>" type="image/x-icon" />
      <link rel="shortcut icon" href="<?php echo @get_instance()->apps->icoin;?>" type="image/x-icon" />
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
      <meta property="og:image" content="<?php echo @$header["image"];?>"/>
      <meta property="og:type" content="website"/>
      <meta property="og:site_name" content="<?php echo @$header["title"];?>"/>
      
      <?php libs_url('css/bootstrap.css',['name' => "Bootstrap CSS"]);?>
      <?php libs_url('icoins/css/icoin.css',['name' => "Font Icoin CSS"]);?>
      <?php libs_url('css/personal-theme.css',['name' => "Admin CSS"]);?>
      <?php libs_url('css/bs-theme.css',['name' => "BS CSS"]);?>
      <link rel="alternate" type="application/rss+xml" title="Sitemap Feed for <?php echo site_url();?>" href="<?php echo site_url("sitemap.xml");?>" />
      <link rel="alternate" type="application/rss+xml" title="RSS Feed for <?php echo site_url();?>" href="<?php echo site_url("feeds");?>" />
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script type="text/javascript">(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
       <?php libs_url('js/app.js',['name' => "Bootstrap & Jquery"]);?>
      <?php echo template_url("styles.css");?>
      <script type="text/javascript">
        var base_url = '<?php echo site_url();?>';
        var base_target = 'personal';
      </script>
      <style type="text/css">
        body{
          --header-height : 65px;
        }
        header{
          height: var(--header-height);
        }
      </style>
</head>


  <body class="app theme-default" itemscope itemtype="http://schema.org/WebPage">
    <div id="loader">

        <div class="load-bar">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
    </div>
    

    <header class="bg-info fixed-top">
      
      <div>
      <nav class="navbar navbar-expand-md navbar-light" style="padding: 0; margin: 0;">
        <div class="logo"><img src="http://gull.ui-lib.com/blue/assets/images/logo.png" style="max-height:var(--header-height);"> </div>
        <a class="navbar-brand" href="<?php echo site_url("personal");?>">Administrator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url();?>" target="_bank"><i class="fa fa-home"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu bg-white" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <?php $this->components->users("panel");?>
        </div>

        

      </nav>
      </div>
    </header>
    <div class="wrapper">
      <section class="app-menu" style=" position: fixed;">
        <div class="aside-content bg-light border-right">
            <nav class="nav flex-column" style="padding: 0;">
              <ul class="" style="padding: 0;">
                <li class="nav-item">
                  <a class="nav-link " data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fab fa-accusoft fa-1x"></i> <span>Dashboard</span></a>
                  <div class="collapse border-top" id="collapseExample2">
                    
                      <ul class="list-group list-group-flush" style="line-height: 22px;">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                      </ul>
                   
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-users fa-1x"></i> <span>Dashboard</span></a>
                  <div class="collapse border-top" id="collapseExample">
                    
                      <ul class="list-group list-group-flush" style="line-height: 22px;">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                      </ul>
                   
                  </div>
                </li>

                

              </ul>
              
            </nav>

            <div class="align-items-end" style="position: absolute; bottom: 0; width: 100%;">
                <ul class="" style="padding: 0;">
                  <li class="nav-item border-top">
                    <div class="collapse border-bottom" id="collapseExample3">
                    
                      <ul class="list-group list-group-flush" style="line-height: 22px;">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                      </ul>
                   
                  </div>
                    <a class="nav-link" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-users fa-1x"></i> <span>Dashboard</span></a>
                  
                  </li>
                </ul>
                </div>

        </div>
      </section>


      <section class="app-content">
        <div class="app-body" sn-body="content">
          <?php print_r($report);?>
          <?php print_r($content);?>
        </div>
      </section>
      
  </div>
  <?php getfile("footer.php"); ?>
  <?php echo template_url("app.js");?>
  <script type="text/javascript">(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
  </body>
  </html>