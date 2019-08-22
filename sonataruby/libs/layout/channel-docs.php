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
      <?php libs_url('js/app.js',['name' => "Bootstrap & Jquery"]);?>
      <?php echo template_url("styles.css");?>

      <style type="text/css">
      .bd-navbar {

              position: -webkit-sticky;
              position: sticky;
              top: 0;
              z-index: 1071;

          }
          .bd-navbar {

              min-height: 4rem;
              background-color: #563d7c;
              box-shadow: 0 .5rem 1rem rgba(0,0,0,.05),inset 0 -1px 0 rgba(0,0,0,.1);

          }
        .bd-navbar .navbar-nav-svg {

            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: text-top;

        }
        @media(min-width: 768px){
        .bd-sidebar {

              position: -webkit-sticky;
              position: sticky;
              top: 4rem;
              z-index: 1000;
              height: calc(100vh - 4rem);

          }
        }
          .bd-sidebar {

              border-right: 1px solid rgba(0,0,0,.1);

          }
          .bd-sidebar {

              -ms-flex-order: 0;
              order: 0;
              border-bottom: 1px solid rgba(0,0,0,.1);

          }
          .bd-content {
              -ms-flex-order: 1;
              order: 1;

          }
          .bd-search {

              position: relative;
              padding: 1rem 15px;
              margin-right: -15px;
              margin-left: -15px;
              border-bottom: 1px solid rgba(0,0,0,.05);

          }
          @media(min-width: 768px){
            .bd-links {

                display: block !important;

            }
          }
            .bd-links {

                max-height: calc(100vh - 9rem);
                overflow-y: auto;

            }
            .bd-links {

                padding-top: 1rem;
                padding-bottom: 1rem;
                margin-right: -15px;
                margin-left: -15px;

            }
            .bd-toc-link {

                display: block;
                padding: .25rem 1.5rem;
                font-weight: 600;
                color: rgba(0,0,0,.65);

            }
            .bd-toc-item.active > .bd-sidenav {

                display: block;

            }
            .bd-sidebar .nav > li > a:hover {

                color: rgba(0,0,0,.85);
                text-decoration: none;
                background-color: transparent;

            }
            .bd-sidebar .nav > li > a {

                display: block;
                padding: .25rem 1.5rem;
                font-size: 90%;
                color: rgba(0,0,0,.65);

            }
            .algolia-autocomplete {

                display: block !important;
                -ms-flex: 1;
                flex: 1;

            }
            .bd-sidenav {

                display: none;

            }
      </style>
</head>


  <body class="app" itemscope itemtype="http://schema.org/WebPage">
  <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
  <a class="navbar-brand mr-0 mr-md-2" href="/" aria-label="Bootstrap"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" class="d-block" viewBox="0 0 612 612" role="img" focusable="false"><title>Bootstrap</title><path fill="currentColor" d="M510 8a94.3 94.3 0 0 1 94 94v408a94.3 94.3 0 0 1-94 94H102a94.3 94.3 0 0 1-94-94V102a94.3 94.3 0 0 1 94-94h408m0-8H102C45.9 0 0 45.9 0 102v408c0 56.1 45.9 102 102 102h408c56.1 0 102-45.9 102-102V102C612 45.9 566.1 0 510 0z"></path><path fill="currentColor" d="M196.77 471.5V154.43h124.15c54.27 0 91 31.64 91 79.1 0 33-24.17 63.72-54.71 69.21v1.76c43.07 5.49 70.75 35.82 70.75 78 0 55.81-40 89-107.45 89zm39.55-180.4h63.28c46.8 0 72.29-18.68 72.29-53 0-31.42-21.53-48.78-60-48.78h-75.57zm78.22 145.46c47.68 0 72.73-19.34 72.73-56s-25.93-55.37-76.46-55.37h-74.49v111.4z"></path></svg></a>

  <div class="navbar-nav-scroll">
    <ul class="navbar-nav bd-navbar-nav flex-row">
      <li class="nav-item">
        <a class="nav-link " href="<?php echo site_url();?>" target="_bank" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Bootstrap');">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url("docs/post.html");?>" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Docs');">Documentation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/docs/4.3/examples/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Examples');">Examples</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://themes.getbootstrap.com/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Themes');" target="_blank" rel="noopener">Themes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://expo.getbootstrap.com/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Expo');" target="_blank" rel="noopener">Expo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://blog.getbootstrap.com/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Blog');" target="_blank" rel="noopener">Blog</a>
      </li>
    </ul>
  </div>

  <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
    <li class="nav-item dropdown">
      <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        v4.3
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
        <a class="dropdown-item active" href="/docs/4.3/">Latest (4.3.x)</a>
        <a class="dropdown-item" href="https://getbootstrap.com/docs/4.2/">v4.2.1</a>
        <a class="dropdown-item" href="https://getbootstrap.com/docs/4.0/">v4.0.0</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="https://v4-alpha.getbootstrap.com/">v4 Alpha 6</a>
        <a class="dropdown-item" href="https://getbootstrap.com/docs/3.4/">v3.4.1</a>
        <a class="dropdown-item" href="https://getbootstrap.com/docs/3.3/">v3.3.7</a>
        <a class="dropdown-item" href="https://getbootstrap.com/2.3.2/">v2.3.2</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="/docs/versions/">All versions</a>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link p-2" href="https://github.com/twbs/bootstrap" target="_blank" rel="noopener" aria-label="GitHub"><svg xmlns="http://www.w3.org/2000/svg" class="navbar-nav-svg" viewBox="0 0 512 499.36" role="img" focusable="false"><title>GitHub</title><path fill="currentColor" fill-rule="evenodd" d="M256 0C114.64 0 0 114.61 0 256c0 113.09 73.34 209 175.08 242.9 12.8 2.35 17.47-5.56 17.47-12.34 0-6.08-.22-22.18-.35-43.54-71.2 15.49-86.2-34.34-86.2-34.34-11.64-29.57-28.42-37.45-28.42-37.45-23.27-15.84 1.73-15.55 1.73-15.55 25.69 1.81 39.21 26.38 39.21 26.38 22.84 39.12 59.92 27.82 74.5 21.27 2.33-16.54 8.94-27.82 16.25-34.22-56.84-6.43-116.6-28.43-116.6-126.49 0-27.95 10-50.8 26.35-68.69-2.63-6.48-11.42-32.5 2.51-67.75 0 0 21.49-6.88 70.4 26.24a242.65 242.65 0 0 1 128.18 0c48.87-33.13 70.33-26.24 70.33-26.24 14 35.25 5.18 61.27 2.55 67.75 16.41 17.9 26.31 40.75 26.31 68.69 0 98.35-59.85 120-116.88 126.32 9.19 7.9 17.38 23.53 17.38 47.41 0 34.22-.31 61.83-.31 70.23 0 6.85 4.61 14.81 17.6 12.31C438.72 464.97 512 369.08 512 256.02 512 114.62 397.37 0 256 0z"></path></svg></a>
    </li>
    <li class="nav-item">
      <a class="nav-link p-2" href="https://twitter.com/getbootstrap" target="_blank" rel="noopener" aria-label="Twitter"><svg xmlns="http://www.w3.org/2000/svg" class="navbar-nav-svg" viewBox="0 0 512 416.32" role="img" focusable="false"><title>Twitter</title><path fill="currentColor" d="M160.83 416.32c193.2 0 298.92-160.22 298.92-298.92 0-4.51 0-9-.2-13.52A214 214 0 0 0 512 49.38a212.93 212.93 0 0 1-60.44 16.6 105.7 105.7 0 0 0 46.3-58.19 209 209 0 0 1-66.79 25.37 105.09 105.09 0 0 0-181.73 71.91 116.12 116.12 0 0 0 2.66 24c-87.28-4.3-164.73-46.3-216.56-109.82A105.48 105.48 0 0 0 68 159.6a106.27 106.27 0 0 1-47.53-13.11v1.43a105.28 105.28 0 0 0 84.21 103.06 105.67 105.67 0 0 1-47.33 1.84 105.06 105.06 0 0 0 98.14 72.94A210.72 210.72 0 0 1 25 370.84a202.17 202.17 0 0 1-25-1.43 298.85 298.85 0 0 0 160.83 46.92"></path></svg></a>
    </li>
    <li class="nav-item">
      <a class="nav-link p-2" href="https://bootstrap-slack.herokuapp.com/" target="_blank" rel="noopener" aria-label="Slack"><svg xmlns="http://www.w3.org/2000/svg" class="navbar-nav-svg" viewBox="0 0 512 512" role="img" focusable="false"><title>Slack</title><path fill="currentColor" d="M210.787 234.832l68.31-22.883 22.1 65.977-68.309 22.882z"></path><path fill="currentColor" d="M490.54 185.6C437.7 9.59 361.6-31.34 185.6 21.46S-31.3 150.4 21.46 326.4 150.4 543.3 326.4 490.54 543.34 361.6 490.54 185.6zM401.7 299.8l-33.15 11.05 11.46 34.38c4.5 13.92-2.87 29.06-16.78 33.56-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18l-11.46-34.38-68.36 22.92 11.46 34.38c4.5 13.92-2.87 29.06-16.78 33.56-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18l-11.46-34.43-33.15 11.05c-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18c-4.5-13.92 2.87-29.06 16.78-33.56l33.12-11.03-22.1-65.9-33.15 11.05c-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18c-4.48-13.93 2.89-29.07 16.81-33.58l33.15-11.05-11.46-34.38c-4.5-13.92 2.87-29.06 16.78-33.56s29.06 2.87 33.56 16.78l11.46 34.38 68.36-22.92-11.46-34.38c-4.5-13.92 2.87-29.06 16.78-33.56s29.06 2.87 33.56 16.78l11.47 34.42 33.15-11.05c13.92-4.5 29.06 2.87 33.56 16.78s-2.87 29.06-16.78 33.56L329.7 194.6l22.1 65.9 33.15-11.05c13.92-4.5 29.06 2.87 33.56 16.78s-2.88 29.07-16.81 33.57z"></path></svg></a>
    </li>
    <li class="nav-item">
      <a class="nav-link p-2" href="https://opencollective.com/bootstrap/" target="_blank" rel="noopener" aria-label="Open Collective"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" fill-rule="evenodd" class="navbar-nav-svg" viewBox="0 0 40 41" role="img" focusable="false"><title>Open Collective</title><path fill-opacity=".4" d="M32.8 21c0 2.4-.8 4.9-2 6.9l5.1 5.1c2.5-3.4 4.1-7.6 4.1-12 0-4.6-1.6-8.8-4-12.2L30.7 14c1.2 2 2 4.3 2 7z"></path><path d="M20 33.7a12.8 12.8 0 0 1 0-25.6c2.6 0 5 .7 7 2.1L32 5a20 20 0 1 0 .1 31.9l-5-5.2a13 13 0 0 1-7 2z"></path></svg></a>
    </li>
  </ul>

  <a class="btn btn-bd-download d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3 btn-outline-success" href="/docs/4.3/getting-started/download/">Download</a>
</header>
  <div class="app-content">
    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
          <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
            <form class="bd-search d-flex align-items-center">
              <span class="algolia-autocomplete" style="position: relative; display: inline-block; direction: ltr;"><input type="search" class="form-control ds-input" id="search-input" placeholder="Search..." aria-label="Search for..." autocomplete="off" data-docs-version="4.3" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" style="position: relative; vertical-align: top;" dir="auto"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: optimizelegibility; text-transform: none;"></pre><span class="ds-dropdown-menu" style="position: absolute; top: 100%; z-index: 100; display: none; left: 0px; right: auto;" role="listbox" id="algolia-autocomplete-listbox-0"><div class="ds-dataset-1"></div></span></span>
              <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg></button>
            </form>

            <nav class="collapse bd-links" id="bd-docs-nav">
              <?php foreach(get_instance()->catalog_model->getList(["channel" => "docs"]) as $k => $v){ ?>
              <div class="bd-toc-item <?php echo ($this->input->get("catalog") == $v->id ? "active" : "");?>">
                <a class="bd-toc-link" href="<?php echo catalog_url($v->url, $v->channel);?>?catalog=<?php echo $v->id;?>">
                  <?php echo $v->name;?>
                </a>

                <ul class="nav bd-sidenav">
                    <?php foreach(get_instance()->posts_model->getList(["channel" => $v->channel, "catalog" => $v->id,"sort" => "post_id-ASC"]) as $key => $value){ ?>
                    <li>
                      <a href="<?php echo post_url($value->url, $value->channel);?>?catalog=<?php echo $v->id;?>">
                        <?php echo $value->name;?>
                      </a>
                    </li>
                    <?php } ?>
                    
                  </ul>
              </div>
              <?php } ?>
    

  </nav>
          </div>
          <main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
            <?php print_r($content);?>
          </main>
      </div>
    </div>
      
  </div>

  <?php echo libs_url("css/animate.css");?>

  <?php echo libs_url("js/animated.js");?>
  <?php echo template_url("app.js");?>
  <script type="text/javascript">(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
  </body>
  </html>