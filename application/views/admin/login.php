<?php
/**
 * Created by PhpStorm.
 * User: prashantsingh
 * Date: 26/03/20
 * Time: 6:15 PM
 */
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4"></div>
            <div class="col-12 col-md-4 col-lg-4">
                <h2 class="text-center"><?php echo $szMetaTagTitle;?></h2>
                <?php if(validation_errors() || !empty($errorMsg)){?>
                    <div class="alert font-weight-bold alert-danger">
                        <?php echo (validation_errors()?validation_errors():(!empty($errorMsg)?$errorMsg:'')); ?>
                    </div>
                <?php }elseif(!empty($successMsg)){ ?>
                    <div class="alert font-weight-bold alert-success">
                        <?php echo $successMsg; ?>
                    </div>
                <?php } ?>
                <form method="post" action="<?php echo __BASE_URL__.($pageName == 'Admin'?'/admin/login':($pageName == 'AnalystLogin'?'/login':''));?>">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="login" class="form-control" value="<?php echo (validation_errors() || $error?set_value('login'):''); ?>"  id="email" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" value="<?php echo (validation_errors() || $error?set_value('password'):''); ?>"  id="password" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Log In">
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4 col-lg-4"></div>
        </div>
    </div>
</section>
