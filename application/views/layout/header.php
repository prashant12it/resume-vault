<?php
/**
 * Created by PhpStorm.
 * User: prashantsingh
 * Date: 16/03/20
 * Time: 3:17 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Resume">
    <meta name="author" content="Prashant Singh">
    <meta name="description"
          content="Resume vault.">
    <meta name='og:image' content='<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/home/newogg.png'>
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fff">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fff">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
    <title><?php echo __SITE_NAME__.' | '.$szMetaTagTitle;?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56"
          href="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/fav-icon/icon.png">
    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo __BASE_CSS_URL__ ; ?>/common.css?<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>css/prashant.css?<?php echo time();?>">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>css/responsive.css">
    <!-- Fix Internet Explorer ______________________________________-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/html5shiv.js"></script>
    <script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/respond.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-page-wrapper">

    <!-- ===================================================
        Loading Transition
    ==================================================== -->
    <!-- Preloader -->
    <section>
        <div id="preloader">
            <div id="ctn-preloader" class="ctn-preloader">
                <div class="animation-preloader">
                    <div class="icon"><img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/1.svg" alt=""></div>
                    <div class="txt-loading">
								<span data-text-preloader="R" class="letters-loading">
									R
								</span>
                        <span data-text-preloader="E" class="letters-loading">
									E
								</span>
                        <span data-text-preloader="S" class="letters-loading">
									S
								</span>
                        <span data-text-preloader="U" class="letters-loading">
									U
								</span>
                        <span data-text-preloader="M" class="letters-loading">
									M
								</span>
                        <span data-text-preloader="E" class="letters-loading">
									E
								</span>
                        <span data-text-preloader="&nbsp;" class="letters-loading">
&nbsp;
								</span>
                        <span data-text-preloader="V" class="letters-loading">
									V
								</span>
                        <span data-text-preloader="A" class="letters-loading">
									A
								</span>
                        <span data-text-preloader="U" class="letters-loading">
									U
								</span>
                        <span data-text-preloader="L" class="letters-loading">
									L
								</span>
                        <span data-text-preloader="T" class="letters-loading">
									T
								</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--
    =============================================
        Theme Main Menu
    ==============================================
    -->
    <div class="theme-main-menu theme-menu-one sticky-menu">
        <div class="d-flex align-items-center">
            <div class="logo col-lg-5 mr-auto">
                <a href="<?php echo __BASE_URL__ ; ?>">
                    <span class="textlogo"><?php echo __SITE_NAME__;?></span>
                </a>
            </div>
            <nav id="mega-menu-holder" class="navbar navbar-expand-lg order-lg-2">
                <div class="container nav-container">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <i class="flaticon-setup"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    </div>
                </div>
            </nav>
        </div>
    </div> <!-- /.theme-main-menu -->

