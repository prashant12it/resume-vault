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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo __SITE_NAME__.' | '.$szMetaTagTitle;?></title>

    <link rel="stylesheet" href="<?php echo __BASE_CSS_URL__; ?>/font-awesome.min.css">
    <link href="<?php echo __BASE_CSS_URL__; ?>/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo __BASE_CSS_URL__; ?>/style.css?<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo __BASE_CSS_URL__; ?>/formpage-style.css?<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo __BASE_CSS_URL__; ?>/responsive.css?<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"/>-->

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="<?php echo __BASE_CSS_URL__ ; ?>/chosen.css">
    <link rel="stylesheet" type="text/css" href="<?php echo __BASE_CSS_URL__ ; ?>/common.css?<?php echo time();?>">
    <link href="<?php echo __BASE_CSS_URL__; ?>/prashant.css?<?php echo time();?>" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand textlogo" href="<?php echo __BASE_URL__;?>"><?php echo __SITE_NAME__;?></a>
        <?php if($loggedInUser>0 && $pageName != 'Admin' && $pageName != 'AnalystLogin'){ ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <?php if($role == 1){ ?>
                    <li class="nav-item <?php echo ($pageName == 'AdminDashboard'?'active':'');?>">
                        <a class="nav-link" href="<?php echo __BASE_URL__;?>">Resume Analysts <?php echo ($pageName == 'AdminDashboard'?'<span class="sr-only">(current)</span>':'');?></a>
                    </li>
                <?php } elseif ($role == 2){ ?>

                <?php } ?>
                <li class="nav-item <?php echo ($pageName == 'JobRoles'?'active':'');?>">
                    <a class="nav-link" href="<?php echo __BASE_URL__.'/job_roles';?>">Job Roles <?php echo ($pageName == 'JobRoles'?'<span class="sr-only">(current)</span>':'');?></a>
                </li>
                <li class="nav-item <?php echo ($pageName == 'CandidateProfiles'?'active':'');?>">
                    <a class="nav-link" href="<?php echo __BASE_URL__.'/candidate_profiles';?>">Candidate Profiles <?php echo ($pageName == 'CandidateProfiles'?'<span class="sr-only">(current)</span>':'');?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo __BASE_URL__.'/logout';?>">Logout</a>
                </li>
            </ul>
        </div>
        <?php }?>
    </nav>
