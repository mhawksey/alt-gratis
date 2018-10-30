<!doctype html>
<html <?php language_attributes(); ?> class="no-js <?php if ( is_user_logged_in() ) { echo 'logged-in'; } ?>">
    <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
    <?php wp_title(''); ?>
    <?php if(wp_title('', false)) { echo ' :'; } ?>
    <?php bloginfo('name'); ?>
    </title>
    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Comments Feed" href="<?php bloginfo('comments_rss2_url'); ?>" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans|Roboto" media="all" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
    <script>
    // conditionizr.com
    // configure environment tests
    conditionizr.config({
        assets: '<?php echo get_template_directory_uri(); ?>',
        tests: {}
    });
    </script>
    </head>
        <body <?php body_class(); ?>>
        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-N855GZ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N855GZ');</script>
        <!-- End Google Tag Manager -->
        <div id="skip-link"> <a href="#main-content" class="element-invisible element-focusable">Skip to main content</a> </div>
      	<!-- /header -->
		<div class="l-page-wrapper">
          <div class="l-page"> 
    		<!-- top links-->
    		<div id="top-bar" class="">
              <div class="l-top-wrapper l-setwidth">
        		<div class="top-links s-grid">
                  <div class="region region-top-links">
            		<div id="block-block-21"><?php if(is_active_sidebar( 'sidebar-toplinks' )) dynamic_sidebar('sidebar-toplinks');?></div>
          		  </div>
                </div>
      		  </div>
           </div>
    	   <!-- //top links--> 
			<!-- header -->
			<div id="header-bar" class="l-header-wrapper" role="banner">
				<header class="l-header l-setwidth">
					<div class="l-logo"><a href="<?php echo home_url(); ?>" title="Association for Learning Technology » Improving practice, promoting research, and influencing policy"><img  id="logo-img" src="<?php echo get_template_directory_uri(); ?>/img/alt_logo.svg" alt="Association for Learning Technology » Improving practice, promoting research, and influencing policy" class="logo-img"></a></div>
        			<!--// l-logo-->
                    <div class="l-branding">
                  		<h1 class="site-name"> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> </h1>
                  		<h3 class="site-slogan"><?php bloginfo( 'description' ); ?></h3>
                	</div>
        			<!--//branding--> 
        
      			</header>
            </div>
            <!-- // l-header -wrapper-->
			<div id="menu-wrapper" class="l-menu-wrapper main-menu" role="navigation">
				<div class="l-setwidth"> <a id="off-canvas-left-show" href="#off-canvas" class="l-off-canvas-show l-off-canvas-show--left"><i class="fa fa-bars"></i></a>
					<div id="off-canvas-left" class="l-off-canvas l-off-canvas--left"> <a id="off-canvas-left-hide" href="#" class="l-off-canvas-hide l-off-canvas-hide--left"><i class="fa fa-chevron-circle-left"></i></a>
						<div class="main-menu-wrapper">
							<?php altgratis_nav(); ?>
						</div>
					</div>
					<!-- // off-canvas-left --> 
				</div>
            </div>
			<!-- //main menu --> 
			<div class="l-content-wrap">
				<div class="l-fullwidth-highlight">
					<div class="region region-full-width-highlight">
						<div class="block-region"><?php if(is_active_sidebar( 'sidebar-fullwidthhighlight' )) dynamic_sidebar('sidebar-fullwidthhighlight');?></div>
					</div>
				</div>
				<!-- preface -->
				<div id="preface-wrap" class="l-preface-wrap">
					<div id="preface-container" class="l-preface l-setwidth"> 
                        <!--Preface -->
                        <div class="preface">
                            <div class="region region-preface-first">
                                <div class="block-region"><?php if(is_active_sidebar( 'sidebar-preface-first' )) dynamic_sidebar('sidebar-preface-first');?></div>
                            </div>
                        </div>
                        <div class="preface">
                            <div class="region region-preface-second">
                            	<div class="block-region"><?php if(is_active_sidebar( 'sidebar-preface-second' )) dynamic_sidebar('sidebar-preface-second');?></div>
                        	</div>
                        </div>
                        <div class="preface">
                            <div class="region region-preface-third">
                            	<div class="block-region"><?php if(is_active_sidebar( 'sidebar-preface-third' )) dynamic_sidebar('sidebar-preface-third');?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // preface -->
                <div class="main" <?php if (!empty($min_height)) : print $min_height; endif; ?>>
                    <div class="l-main l-setwidth" role="main" <?php if (!empty($set_width)) : print 'style="max-width:' . $set_width . ';"' ; endif; ?>>
                        <div class="l-content"><a id="main-content"></a>