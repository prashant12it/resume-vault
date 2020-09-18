<?php
/**
 * Created by PhpStorm.
 * User: prashantsingh
 * Date: 16/03/20
 * Time: 3:17 PM
 */
?>

<!--
=====================================================
    Footer
=====================================================
-->
<footer class="theme-footer-one pt-130">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12 footer-about-widget">
                    <a href="<?php echo __BASE_URL__ ; ?>" class="logo">
                        <span class="textlogo"><?php echo __SITE_NAME__;?></span>
                    </a>
                    <a href="#" class="email">&copy; 2020 copyright all right reserved</a>

                </div>
                <div class="col-lg-3 col-lg-3 col-sm-6 col-12 footer-list">
                    <h5 class="footer-title">Email Us</h5>
                    <ul>
                        <li>
                            <a href="mailto:prashant@webcab.in" class="email">prashant@webcab.in</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 footer-list">
                    <h5 class="footer-title">Give a call</h5>
                    <ul>
                        <li><a href="tel:+917838926571" class="phone">+91-7838926571</a></li>
                    </ul>
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.top-footer -->

    <!--<div class="container">
        <div class="bottom-footer-content">
            <p>&copy; 2020 copyright all right reserved</p>
        </div>
    </div>-->
</footer> <!-- /.theme-footer-one -->


<!-- Scroll Top Button -->
<button class="scroll-top tran3s">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</button>


<div id="path-shape-wrapper">
    <div>
        <svg height="0" width="0">
            <defs>
                <clipPath id="path-shape-one">
                    <path fill-rule="evenodd" fill="url(#PSgrad_0)"
                          d="M205.167,7.943 C196.497,5.430 187.599,3.410 178.431,1.968 C128.511,-5.887 71.772,9.587 43.924,51.651 C19.381,88.722 21.921,137.016 28.728,180.915 C36.372,230.212 42.902,274.488 30.686,323.548 C22.073,358.142 10.514,392.042 3.990,427.142 C-9.427,499.346 8.748,558.050 93.045,555.629 C129.787,554.575 165.485,540.991 199.389,527.944 C222.170,519.186 249.687,504.720 274.747,508.015 C298.508,511.143 314.810,529.991 331.946,542.158 C360.484,562.425 393.173,576.700 432.090,577.905 C544.608,581.383 647.199,488.167 663.495,395.667 C683.050,284.674 584.750,212.456 485.909,166.645 C447.031,148.625 408.266,133.864 373.136,108.990 C319.781,71.209 268.682,26.354 205.167,7.943 "/>
                </clipPath>
            </defs>
        </svg>
    </div>
</div> <!-- /#path-shape-wrapper -->


</div>
<div class="modal fade" id="influencer_login_popup_modal" tabindex="-1" role="dialog"
     aria-labelledby="influencer_login_popup_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Signup</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <form id="signupinfluencer" method="post" class="mt-5 pb-4">
                            <div class="alert font-weight-bold alert-danger d-none">
                            </div>
                            <div class="alert font-weight-bold alert-success d-none">
                            </div>
                            <div class="form-group">
                                <label for="inf_username">Username</label>
                                <input type="text" class="form-control" name="inf_username" id="inf_username"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="inf_emailid">Email</label>
                                <input type="email" class="form-control" name="inf_emailid" id="inf_emailid"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="inf_password">Password</label>
                                <input type="password" class="form-control" name="inf_password" id="inf_password"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="inf_cpassword">Confirm Password</label>
                                <input type="password" class="form-control" name="inf_cpassword" id="inf_cpassword"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="shop_url" class="d-none">Store</label>
                                <input type="hidden" class="form-control" value="<?php echo $shop; ?>" name="shop_url"
                                       id="shop_url"/>
                                <input type="hidden" class="form-control" value="<?php echo $app; ?>"
                                       name="installedapp" id="installedapp"
                                       required/>
                            </div>
                            <div class="form-group d-none">
                                <label for="shop_url">Apps needs to be installed</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked="checked" name="business"
                                           value="1" id="businessopt">
                                    <label class="form-check-label" for="businessopt">
                                        Business
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked="checked" value="1"
                                           id="reviewsopt">
                                    <label class="form-check-label" for="reviewsopt">
                                        Reviews
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="upload-btn-wrapper color_green">
                                    <button class="btn pl-4 pr-4 pt-2 pb-2 btn-primary submitBtn" type="submit"><i
                                                class="fa fa-file-video-o" aria-hidden="true"></i>
                                        Sign Up
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="verify_btn mx-auto">

                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="mr-2">Already have an account?</span>

                <div class="upload-btn-wrapper color_pink">
                    <button class="pl-4 pr-4 pt-2 pb-2 submitBtn btn btn-primary" type="button"
                            onclick="openPopup('#loginModal')"
                            data-dismiss="modal">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($pageName == 'Dashboard'){ ?>
    <div class="modal fade" id="store_category_modal" tabindex="-1" role="dialog"
         aria-labelledby="influencer_login_popup_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Store Settings</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="savecollections" method="post" class="mt-5 pb-4">
                                <div class="alert font-weight-bold alert-danger d-none">
                                </div>
                                <div class="alert font-weight-bold alert-success d-none">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="hosted">Collections enabled to show blogs: </label>
                                    <small>(Multiple collections must be comma separated)</small>
                                    <input type="text" class="form-control" id="hosted"
                                           value="<?php echo (isset($storeDet[0]['categories']) && !empty($storeDet[0]['categories'])?$storeDet[0]['categories']:'');?>"
                                           placeholder="Enter collections..." />
                                    <input type="hidden" value="<?php echo $storeDet[0]['id'];?>" id="store_id" />
                                </div>
                                <div class="form-group">
                                    <div class="upload-btn-wrapper color_green">
                                        <button class="btn pl-4 pr-4 pt-2 pb-2 btn-primary submitBtn" type="submit"><i
                                                    class="fa fa-save" aria-hidden="true"></i>
                                            Save Collections
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="upload-btn-wrapper color_pink">
                        <button class="pl-4 pr-4 pt-2 pb-2 submitBtn btn btn-primary" type="button"
                                data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="modal" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Login</h2>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="login" method="post">
                    <div class="alert font-weight-bold alert-danger d-none">
                    </div>
                    <div class="alert font-weight-bold alert-success d-none">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="" id="login_username"
                               name="login_username"
                               placeholder="Your username..." required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="loginpassword" name="password"
                               placeholder="Your password..." required>
                    </div>

                    <div class="form-group">
                        <div class="upload-btn-wrapper color_green">
                            <button class="btn  pl-4 pr-4 pt-2 pb-2 btn-primary submitBtn" type="submit"><i
                                        class="fa fa-user"
                                        aria-hidden="true"></i>
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="mr-2">Not a member yet?</span>

                <div class="upload-btn-wrapper color_pink">
                    <button class="btn pl-4 pr-4 pt-2 pb-2 btn-primary submitBtn" type="button"
                            onclick="openPopup('#influencer_login_popup_modal')"
                            data-dismiss="modal">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Sign Up
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Optional JavaScript _____________________________  -->

<script>
    var SiteUrl = '<?php echo __BASE_URL__;?>';
    var Pagename = '<?php echo $pageName;?>';
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- jQuery -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/jquery.2.2.3.min.js"></script>
<!-- Popper js -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/popper.js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- menu  -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/mega-menu/assets/js/custom.js"></script>
<!-- AOS js -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/aos-next/dist/aos.js"></script>
<!-- WOW js -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/WOW-master/dist/wow.min.js"></script>
<!-- owl.carousel -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/owl-carousel/owl.carousel.min.js"></script>
<!-- ajaxchimp -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/ajaxchimp/jquery.ajaxchimp.min.js"></script>
<!-- Tilt js -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/tilt.jquery.js"></script>


<!-- Theme js -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>js/theme.js"></script>
<script src="<?php echo __BASE_JS_URL__; ?>/common.js?<?php echo time(); ?>"></script>
<script src="<?php echo __BASE_JS_URL__; ?>/prashant-home.js?<?php echo time(); ?>"></script>
</div> <!-- /.main-page-wrapper -->
</body>
</html>
