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
      <?php libs_url('css/admin-theme.css',['name' => "Admin CSS"]);?>
      <?php libs_url('css/bs-theme.css',['name' => "BS CSS"]);?>
      <link rel="alternate" type="application/rss+xml" title="Sitemap Feed for <?php echo site_url();?>" href="<?php echo site_url("sitemap.xml");?>" />
      <link rel="alternate" type="application/rss+xml" title="RSS Feed for <?php echo site_url();?>" href="<?php echo site_url("feeds");?>" />
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script type="text/javascript">(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
      
      <?php echo template_url("styles.css");?>
      <?php libs_url('js/app.js',['name' => "Bootstrap & Jquery"]);?>

      <script type="text/javascript">
        var base_url = '<?php echo site_url();?>';
        var base_target = 'enterprise';
      </script>


</head>


  <body class="app theme-default" itemscope itemtype="http://schema.org/WebPage">
    <div id="loader">

        <div class="load-bar">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
    </div>

    <header class="fixed-top border-bottom" style="z-index: 999999999;">
      <nav class="navbar navbar-expand-md navbar-light">
        <div class="logo"><img src="http://gull.ui-lib.com/blue/assets/images/logo.png" style="max-height:calc(var(--header-height) - 10px);"></div>
        <a class="navbar-brand" href="#">Administrator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Contents
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Modules
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach((array)config_item("module") as $key => $value){?>
                  <a class="dropdown-item" href="#"><?php echo $key;?></a>
                <?php } ?>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Systems
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tools
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/tools/enterprise/database/reset">Reset Database</a>
                <a class="dropdown-item" href="/tools/enterprise/database/backups">Backup Database</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/tools/enterprise/core/update">Update Core</a>
              </div>
            </li>

          </ul>
          <?php $this->components->users("panel");?>
        </div>

        

      </nav>

    </header>

    <div class="wrapper">
    
    <section id="panelLeft" class="ps-fixed">
      
      
      <div class="aside-content">
        
        <div class="srollView">
          <ul class="nav flex-column" id="MenuSli">
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Dashboard" role="button" aria-expanded="false" aria-controls="Dashboard"><i class="fab fa-accusoft fa-1x"></i> <span>Dashboard</span></a>
              
              <div id="Dashboard" class="collapse">
               <ul class="list-group list-group-flush" style="line-height: 22px;">
                <li class="list-group-item"><a class="nav-link" href="/enterprise"><i class="fa fa-tachometer-alt"></i> <span>Report</span></a></li>
               <li class="list-group-item"><a class="nav-link" href="/enterprise"><i class="fa fa-tachometer-alt"></i> <span>Markettings</span></a></li>
              </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Account" role="button" aria-expanded="false" aria-controls="Account"><i class="fa fa-users fa-1x"></i> <span>Account</span></a>
              
              <div id="Account" class="collapse">
               <ul class="list-group list-group-flush" style="line-height: 22px;">
                <li class="list-group-item"><a class="nav-link" href="/account/enterprise/profile"><i class="fa fa-tachometer-alt"></i> <span>Profile</span></a></li>
                <li class="list-group-item"><a class="nav-link" href="/account/enterprise/changepassword"><i class="fa fa-tachometer-alt"></i> <span>Change Password</span></a></li>

                <li class="list-group-item"><a class="nav-link" href="/account/enterprise/manager"><i class="fa fa-tachometer-alt"></i> <span>Account</span></a></li>
                <li class="list-group-item"><a class="nav-link" href="/account/enterprise/customers"><i class="fa fa-tachometer-alt"></i> <span>Customers</span></a></li>
              </ul>
              </div>
            </li>

           

            <li class="nav-item">
              <a class="nav-link active" data-toggle="collapse" href="#Pages" role="button" aria-expanded="false"  aria-controls="Pages"><i class="fa fa-file-word"></i> <span>Phân trang</span></a>
              <div id="Pages" class="collapse" data-parent="#MenuSli">
                 <ul class="list-group list-group-flush">
                    <li class="list-group-item menuHeader">
                      Trang giao diện <a class="btn btn-primary btn-sm float-right" href="/pages/layout/create" sn-link="true" parent-controller="#pages"><i class="fa fa-plus text-white"></i></a>
                      
                    </li>
                     <?php
                      $data = get_instance()->layout_model->getList();
                      foreach ($data as $key => $value) { ?>
                        <li class="list-group-item"><a class="nav-link" href="/pages/layout/create/<?php echo $value->id;?>"><i class="fa fa-file-word"></i> <span><?php echo $value->name;?></span></a></li>
                      <?php } ?>

                    <li class="list-group-item menuHeader">Trang nội dung <a class="btn btn-primary btn-sm float-right" href="/pages/enterprise/create" sn-link="true" parent-controller="#pages"><i class="fa fa-plus text-white"></i></a></li>
                      <?php
                      $data = get_instance()->pages_model->getList();
                      foreach ($data as $key => $value) { ?>
                        <li class="list-group-item"><a class="nav-link" href="/pages/enterprise/create/<?php echo $value->id;?>" sn-link="true" parent-controller="#pages"><i class="<?php echo ($value->icoin ? $value->icoin : "fa fa-file-word");?>"></i> <span><?php echo $value->name;?></span></a></li>
                      <?php } ?>
                
                  </ul>
                
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link arrow-down" data-toggle="collapse" href="#Posts" role="button" aria-expanded="false" aria-controls="Posts"><i class="fa fa-mail-bulk"></i> <span>Nội dung</span></a>
              <div id="Posts" class="collapse" data-parent="#MenuSli">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item menuHeader">Nội dung </li>

                  <li class="list-group-item"><a class="nav-link" href="/posts/enterprise/catalog" sn-link="true" parent-controller="#posts"><i class="fa fa-table"></i> <span>Chuyên mục</span></a></li>
                  <li class="list-group-item"><a class="nav-link" href="/posts/enterprise/posts" sn-link="true" parent-controller="#posts"><i class="fa fa-clipboard"></i> <span>Nội dung</span></a></li>
                  <li class="list-group-item"><a class="nav-link" href="/posts/enterprise/tags" sn-link="true" parent-controller="#posts"><i class="fa fa-tags"></i> <span>Tag's</span></a></li>
                  <li class="list-group-item"><a class="nav-link" href="/posts/enterprise/gallery" sn-link="true" parent-controller="#posts"><i class="fa fa-image"></i> <span>Gallery</span></a></li>
                  <li class="list-group-item"><a class="nav-link" href="/posts/enterprise/video" sn-link="true" parent-controller="#posts"><i class="fa fa-video"></i> <span>Video</span></a></li>
                  <li class="list-group-item menuHeader">Công cụ</li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link"data-toggle="collapse" href="#Templates" role="button" aria-expanded="false" aria-controls="Templates"><i class="fa fa-campground"></i> <span>Giao diện</span></a>
              <div id="Templates" class="collapse" data-parent="#MenuSli">
                <ul class="list-group list-group-flush">
                   
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/template/manager" sn-link="true" parent-controller="#templates"><i class="fa fa-columns"></i> <span>Cài đặt</span></a>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/template/search" sn-link="true" parent-controller="#templates"><i class="fa fa-search"></i><span>Tìm giao diện</span></a>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/template/backups" sn-link="true" parent-controller="#templates"><i class="fa fa-download"></i> <span>Backup & Upload</span></a>
                    

                    <li class="list-group-item menuHeader">Điều chỉnh</li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/menu/manager" parent-controller="#templates"><i class="fa fa-bars"></i> <span>Quản lý Menu</span></a>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/template/header" sn-link="true" parent-controller="#templates"><i class="fa fa-ellipsis-v"></i> <span>Header & Footer</span></a>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/template/blocks" parent-controller="#templates"><i class="fa fa-shapes"></i> <span>Block Manager</span></a>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/template/css" parent-controller="#templates"><i class="fab fa-css3-alt"></i> <span>Điều chỉnh CSS</span></a>
                    
                  </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#Apps" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="Apps"><i class="fa fa-sitemap"></i> <span>Ứng dụng</span></a>
              <div id="Apps" class="collapse" data-parent="#MenuSli">
                <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/manager" sn-link="true" parent-controller="#apps"><i class="fa fa-cogs"></i> <span>Cài đặt</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/search" sn-link="true" parent-controller="#apps"><i class="fa fa-search"></i> <span>Tìm ứng dụng</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/backups" sn-link="true" parent-controller="#apps"><i class="fa fa-download"></i> <span>Backup & Upload</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/plugins" sn-link="true" parent-controller="#apps"><i class="fa fa-project-diagram"></i> <span>Tiện ích mở rộng</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/builder"  parent-controller="#apps"><i class="fa fa-mobile-alt"></i> <span>Ứng dụng Mobile</span></a></li>
                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="#Marketings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="Marketings"><i class="fa fa-poll"></i> <span>Marketings</span></a>
              <div id="Marketings" class="collapse" data-parent="#MenuSli">
                <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/manager" sn-link="true" parent-controller="#apps"><i class="fa fa-cogs"></i> <span>Sales</span></a></li>
                    
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/manager" sn-link="true" parent-controller="#apps"><i class="fa fa-cogs"></i> <span>Apps</span></a></li>

                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/manager" sn-link="true" parent-controller="#apps"><i class="fa fa-cogs"></i> <span>ADS</span></a></li>

                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/addon/manager" sn-link="true" parent-controller="#apps"><i class="fa fa-cogs"></i> <span>Report</span></a></li>
                </ul>
              </div>
            </li>

           

            <li class="nav-item">
              <a class="nav-link" href="/settings/enterprise/tasks"><i class="fa fa-tasks"></i> <span>Task</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Settings" role="button" aria-expanded="false" aria-controls="Settings"><i class="fa fa-cogs"></i> <span>Cấu hình</span></a>
              
                <div id="Settings" class="collapse" data-parent="#MenuSli">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item menuHeader">Cài đặt</li>
                 
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/configs/api" sn-link="true" parent-controller="#settings"><i class="fab fa-squarespace"></i> <span>Quản lý API</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/configs" sn-link="true" parent-controller="#settings"><i class="fa fa-cogs"></i> <span>Điều chỉnh chung</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/configs/channels" sn-link="true" parent-controller="#settings"><i class="fa fa-dice-d20"></i> <span>Quản lý Channel</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/configs/urlredirect" sn-link="true" parent-controller="#settings"><i class="fa fa-link"></i> <span>Quản lý URL</span></a></li>
                    <li class="list-group-item menuHeader">Online / Offline</li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/configs/maintain" sn-link="true" parent-controller="#settings"><i class="fa fa-tachometer-alt"></i> <span>Maintain</span></a></li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/configs/page404" sn-link="true" parent-controller="#settings"><i class="fa fa-ambulance"></i> <span>Page 404</span></a></li>


                    <li class="list-group-item menuHeader">Tools</li>
                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/configs/autobots" sn-link="true" parent-controller="#settings"><i class="fa fa-user-astronaut"></i> <span>Thiết lập tự động</span></a></li>

                    <li class="list-group-item"><a class="nav-link" href="/settings/enterprise/language" sn-link="true" parent-controller="#settings"><i class="fa fa-language"></i> <span>Ngôn ngữ</span></a></li>

                  </ul>
                </div>
            </li>
          </ul>
          </div>
          

        </div>
    </section>
    <section class="app-content" id="mainContent">
      <div class="app-body" sn-body="content">
        <?php print_r($content);?>
      </div>
    </section>
    <section id="panelRight">
    </section>
    </div>
    
  <?php libs_url("js/bootstrap-datepicker.js");?>
  <?php libs_url("css/datepicker.css");?>
  <?php libs_url("js/admin.js");?>
  <?php echo template_url("app.js");?>

  <script type="text/javascript">(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>

  
  </body>
  </html>