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

    <header class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="logo"><img src="http://gull.ui-lib.com/blue/assets/images/logo.png" style="max-height:80px;"> <i class="fa fa-align-justify switchClass"></i></div>
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
    <aside>
      
      
      <div class="aside-content">
        

          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link bannerHeader text-white" href="/home/enterprise"><i class="fab fa-accusoft fa-2x"></i> <span>Dashboard</span></a>
              
              <div id="multiCollapseExample2" class="slidebar">
                <div class="menuHeader">
                  <h4>Trang chính</h4>
                  <p>Quản lý trang</p>
                </div>
                <a class="dropdown-item" href="#"><i class="fa fa-file-word"></i> Categories</a>
                <a class="dropdown-item" href="#"><i class="fa fa-file-word"></i> Posts</a>
                <a class="dropdown-item" href="#"><i class="fa fa-file-word"></i> Something else here</a>
              </div>
            </li>
            <li class="nav-item" id="pages">
              <a class="nav-link active" href="#"><i class="fa fa-file-word"></i> <span>Trang</span></a>
              <div id="multiCollapseExample2" class="slidebar">
                <div class="menuHeader">
                  <h4>Trang giao diện <a class="btn btn-primary btn-sm float-right" href="/pages/layout/create" sn-link="true" parent-controller="#pages"><i class="fa fa-plus"></i></a></h4>
                  <p>Quản lý trang giao diện</p>

                </div>
                 <?php
                  $data = get_instance()->layout_model->getList();
                  foreach ($data as $key => $value) { ?>
                    <a class="dropdown-item" href="/pages/layout/create/<?php echo $value->id;?>"><i class="fa fa-file-word"></i> <?php echo $value->name;?></a>
                  <?php } ?>

                <div class="menuHeader">
                  <h4>Trang nội dung <a class="btn btn-primary btn-sm float-right" href="/pages/enterprise/create" sn-link="true" parent-controller="#pages"><i class="fa fa-plus"></i></a></h4>
                  <p>Quản lý trang</p>

                </div>
                  <?php
                  $data = get_instance()->pages_model->getList();
                  foreach ($data as $key => $value) { ?>
                    <a class="dropdown-item" href="/pages/enterprise/create/<?php echo $value->id;?>" sn-link="true" parent-controller="#pages"><i class="<?php echo ($value->icoin ? $value->icoin : "fa fa-file-word");?>"></i> <?php echo $value->name;?></a>
                  <?php } ?>
                
                
                
              </div>
            </li>
            <li class="nav-item" id="posts">
              <a class="nav-link arrow-down" href="/posts/enterprise/create" sn-link="true" parent-controller="#posts"><i class="fa fa-mail-bulk"></i> <span>Nội dung</span></a>
              <div id="multiCollapseExample2" class="slidebar">
                <div class="menuHeader">
                  <h4>Bài viết <a class="btn btn-primary btn-sm float-right" href="/posts/enterprise/create" sn-link="true" parent-controller="#posts"><i class="fa fa-plus"></i></a></h4>
                  <p>Menu controller posts</p>
                </div>
                <a class="dropdown-item" href="/posts/enterprise/catalog" sn-link="true" parent-controller="#posts"><i class="fa fa-table"></i> Chuyên mục</a>
                <a class="dropdown-item" href="/posts/enterprise/posts" sn-link="true" parent-controller="#posts"><i class="fa fa-clipboard"></i> Bài viết</a>
                <a class="dropdown-item" href="/posts/enterprise/tags" sn-link="true" parent-controller="#posts"><i class="fa fa-tags"></i> Tag's</a>
                <a class="dropdown-item" href="/posts/enterprise/gallery" sn-link="true" parent-controller="#posts"><i class="fa fa-image"></i> Gallery</a>
                <a class="dropdown-item" href="/posts/enterprise/video" sn-link="true" parent-controller="#posts"><i class="fa fa-video"></i> Video</a>
                <div class="menuHeader">
                  <h4>Công cụ</h4>
                  <p>Menu controller posts</p>
                </div>
              </div>
            </li>
            <li class="nav-item" id="templates">
              <a class="nav-link" href="/settings/enterprise/template/manager"><i class="fa fa-campground"></i> <span>Giao diện</span></a>
              <div id="multiCollapseExample2" class="slidebar">
                <div class="menuHeader">
                  <h4>Giao diện</h4>
                  <p>Menu controller posts</p>
                </div>
                <a class="dropdown-item" href="/settings/enterprise/template/manager" sn-link="true" parent-controller="#templates">Điều chỉnh</a>
                <a class="dropdown-item" href="/settings/enterprise/template/search" sn-link="true" parent-controller="#templates">Tìm giao diện</a>
                <a class="dropdown-item" href="/settings/enterprise/template/backups" sn-link="true" parent-controller="#templates">Backup & Upload</a>
                

                <div class="menuHeader">
                  <h4>Custom Design</h4>
                </div>
                <a class="dropdown-item" href="/settings/enterprise/menu/manager" parent-controller="#templates">Quản lý Menu</a>
                <a class="dropdown-item" href="/settings/enterprise/template/header" sn-link="true" parent-controller="#templates">Header & Footer</a>
                <a class="dropdown-item" href="/settings/enterprise/template/blocks" parent-controller="#templates">Block Manager</a>
                <a class="dropdown-item" href="/settings/enterprise/template/css" parent-controller="#templates">Điều chỉnh CSS</a>
                

              </div>
            </li>
            <li class="nav-item" id="apps">
              <a class="nav-link" href="/settings/enterprise/addon/manager"><i class="fa fa-sitemap"></i> <span>Ứng dụng</span></a>
              <div id="multiCollapseExample2" class="slidebar">
                <div class="menuHeader">
                  <h4>Ứng dụng</h4>
                  <p>Menu controller posts</p>
                </div>
                <a class="dropdown-item" href="/settings/enterprise/addon/manager" sn-link="true" parent-controller="#apps">Điều chỉnh</a>
                <a class="dropdown-item" href="/settings/enterprise/addon/search" sn-link="true" parent-controller="#apps">Tìm ứng dụng</a>
                <a class="dropdown-item" href="/settings/enterprise/addon/backups" sn-link="true" parent-controller="#apps">Backup & Upload</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/settings/enterprise/addon/plugins" sn-link="true" parent-controller="#apps">Tiện ích mở rộng</a>
                <a class="dropdown-item" href="/settings/enterprise/builder"  parent-controller="#apps"><i class="fa fa-mobile-alt"></i> Ứng dụng Mobile</a>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/settings/enterprise/marketings"><i class="fa fa-poll"></i> <span>Marketings</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/settings/enterprise/tasks"><i class="fa fa-tasks"></i> <span>Task</span></a>
            </li>

            <li class="nav-item" id="settings">
              <a class="nav-link" href="/settings/enterprise/configs" sn-link="true" parent-controller="#settings"><i class="fa fa-cogs"></i> <span>Cấu hình</span></a>
              <div id="multiCollapseExample2" class="slidebar">
                <div class="menuHeader">
                  <h4>Settings</h4>
                  <p>Menu controller posts</p>
                  
                </div>
                <a class="dropdown-item" href="/settings/enterprise/configs/api" sn-link="true" parent-controller="#settings"><i class="fab fa-squarespace"></i> Quản lý API</a>
                <a class="dropdown-item" href="/settings/enterprise/configs" sn-link="true" parent-controller="#settings"><i class="fa fa-cogs"></i> Điều chỉnh chung</a>
                <a class="dropdown-item" href="/settings/enterprise/configs/channels" sn-link="true" parent-controller="#settings"><i class="fa fa-dice-d20"></i> Quản lý Channel</a>
                <a class="dropdown-item" href="/settings/enterprise/configs/urlredirect" sn-link="true" parent-controller="#settings"><i class="fa fa-link"></i> Quản lý URL</a>
                <div class="menuHeader">
                  <h4>Online / Offline</h4>
                  <p>Menu controller posts</p>
                </div>
                <a class="dropdown-item" href="/settings/enterprise/configs/maintain" sn-link="true" parent-controller="#settings"><i class="fa fa-tachometer-alt"></i> Maintain</a>
                <a class="dropdown-item" href="/settings/enterprise/configs/page404" sn-link="true" parent-controller="#settings"><i class="fa fa-ambulance"></i> Page 404</a>

                


              </div>
            </li>
          </ul>
      </div>
    </aside>
    <section class="app-content">
      <div class="app-body" sn-body="content">
        <?php print_r($content);?>
      </div>
    </section>
    <?php getfile("footer.php"); ?>
  
  <?php libs_url("js/admin.js");?>
  <?php echo template_url("app.js");?>

  <script type="text/javascript">(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>

  </body>
  </html>