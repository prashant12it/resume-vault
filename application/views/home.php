
    <!--
    =============================================
        Theme Main Banner One
    ==============================================
    -->
    <div class="rogan-hero-section rogan-hero-one pt-300 pb-350 md-pt-200 md-pb-130 pos-r">
        <div class="shape-wrapper">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/1.svg" alt=""
                 class="shape-one wow fadeInRight animated" data-wow-duration="2s">
            <div class="main-illustration">
                <!-- <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/banner-shape-1.svg" alt="" class="b-shape-1 wow fadeInDown animated" data-wow-duration="2s" data-wow-delay="1.7s">
                <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/banner-shape-2.svg" alt="" class="b-shape-2 wow zoomIn animated" data-wow-duration="2s" data-wow-delay="1.7s"> -->
                <iframe src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/svg-animi/1/SVG/demo.html"
                        class="wow zoomIn animated" data-wow-duration="2s" data-wow-delay="0.9s"></iframe>
            </div>
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/2.svg" alt=""
                 class="line-shape-one img-shape wow fadeInRight animated" data-wow-duration="3s">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/3.svg" alt=""
                 class="line-shape-two img-shape wow fadeInLeft animated" data-wow-duration="3s">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/15.svg" alt=""
                 class="light-lamp img-shape wow fadeInDown animated" data-wow-duration="2s" data-wow-delay="1.7s">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/4.svg" alt=""
                 class="shape-two img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/5.svg" alt=""
                 class="shape-three img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/6.svg" alt=""
                 class="shape-four img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/7.svg" alt=""
                 class="shape-five img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/8.svg" alt=""
                 class="shape-six img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/9.svg" alt=""
                 class="shape-seven img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/10.svg" alt=""
                 class="shape-eight img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/11.svg" alt=""
                 class="shape-nine img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/12.svg" alt=""
                 class="shape-ten img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/13.svg" alt=""
                 class="shape-eleven img-shape">
            <img src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>images/shape/14.svg" alt=""
                 class="shape-twelve img-shape">
        </div>
        <div class="container">
            <div class="main-wrapper pos-r">
                <h1 class="banner-main-title underline pt-15 pb-45 md-pt-10 md-pb-30 wow fadeInUp animated"
                    data-wow-delay="0.4s"><span>Welcome to </span> <br> <span><?php echo __SITE_NAME__;?></span></h1>
                <?php if(!$loggedInUser){ ?>
                    <a href="<?php echo __BASE_URL__.'/analyst_login';?>" class="theme-btn solid-button-one wow fadeInLeft animated"
                       data-wow-delay="1.5s">Analyst Login</a>
                    <a href="<?php echo __BASE_URL__.'/admin';?>" class="theme-btn line-button-one wow fadeInRight animated"
                       data-wow-delay="1.5s">Admin Login</a>
                <?php }?>
            </div> <!-- /.main-wrapper -->
        </div> <!-- /.container -->
    </div> <!-- /.rogan-hero-section -->
