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
            <div class="col-md-8 head">

            </div>
            <!-- Import link -->
            <div class="col-md-4 head">
                <div class="float-right">
                    <a href="<?php echo __BASE_URL__.'/job_roles';?>" class="btn btn-success"><i
                                class="fa fa-eye"></i> View Job Role(s)</a>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h2 class="mb-5"><?php echo $szMetaTagTitle;?></h2>
                <form action="<?php echo __BASE_URL__ . '/edit_job_roles/'.$roleID; ?>" method="post"
                      enctype="multipart/form-data" id="updateJobRoleForm">
                    <div class="alert font-weight-bold alert-danger <?php echo(validation_errors() || !empty($errorMsg) ? 'd-block' : 'd-none'); ?>">
                        <?php if (validation_errors()) {
                            echo validation_errors();
                        } elseif (!empty($errorMsg)) {
                                echo '<p class="mt-2 mb-2">' . $errorMsg . '</p>';
                        } ?>
                    </div>
                    <div class="alert font-weight-bold alert-success <?php echo(!empty($successMsg) ? 'd-block' : 'd-none'); ?>">
                        <?php
                        if (!empty($successMsg)) {
                                echo '<p class="mt-2 mb-2">' . $successMsg . '</p>';
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" required class="form-control" value="<?php echo(validation_errors() || $errorMsg ? set_value('name') : $roleArr[0]['name']); ?>" id="name" name="name" placeholder="Enter job role">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="5" class="form-control" name="description" placeholder="Enter description"><?php echo(validation_errors() || $errorMsg ? set_value('description') : $roleArr[0]['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="searchTags">Search Tags</label>
                        <?php
                        $tagsArr = array();
                        if(!empty($roleArr[0]['tags'])){
                            $tagsArr = array_map('trim', explode(',', $roleArr[0]['tags']));
                        }?>
                        <select data-placeholder="Search tags ..." name="searchTags[]" multiple
                                class="chosen-select form-control">
                            <option value="Developer" <?php echo (in_array('Developer',$tagsArr)?'selected':'');?>>Developer</option>
                            <option value="Designer" <?php echo (in_array('Designer',$tagsArr)?'selected':'');?>>Designer</option>
                            <option value="QA Analyst" <?php echo (in_array('QA Analyst',$tagsArr)?'selected':'');?>>QA Analyst</option>
                            <option value="Sr. Developer" <?php echo (in_array('Sr. Developer',$tagsArr)?'selected':'');?>>Sr. Developer</option>
                            <option value="SEO Analyst" <?php echo (in_array('SEO Analyst',$tagsArr)?'selected':'');?>>SEO Analyst</option>
                            <option value="Team Leader" <?php echo (in_array('Team Leader',$tagsArr)?'selected':'');?>>Team Leader</option>
                            <option value="Product Manager" <?php echo (in_array('Product Manager',$tagsArr)?'selected':'');?>>Product Manager</option>
                        </select>
                    </div>
                    <div class="form-group">

                        <?php if(!empty($roleArr[0]['profile_pic'])){ ?>
                            <img src="<?php echo __BASE_URL__.'/uploads/'.$roleArr[0]['profile_pic'];?>" width="100" />
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="uploadedImage">Candidate Photo</label>
                        <div class="custom-file">
                            <input type="file" value="<?php echo(validation_errors() || $errorMsg ? set_value('profilepic') : ''); ?>" class="custom-file-input" name="userImage" id="userImage">
                            <label class="custom-file-label" for="userImage">Choose file</label>
                        </div>
                        <input type="hidden" name="uploadedImage" value="<?php echo(validation_errors() || $errorMsg ? set_value('uploadedImage') : $roleArr[0]['profile_pic']); ?>" id="uploadedImage" />
                    </div>

                    <div class="form-group mb-0">
                        <label for="exampleInputPassword1">Active/Inactive</label>
                    </div>
                    <div class="form-check pl-0">
                        <label class="switch">
                            <input id="enable-widget" type="checkbox" name="is_active" <?php echo(((validation_errors() || $errorMsg) && isset($_POST['is_active']) && $_POST['is_active'] == 1) || $roleArr[0]['is_active'] == 1? 'checked' : ''); ?>  value="<?php echo(validation_errors() || $errorMsg ? set_value('is_active') : '1'); ?>" />
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update Job Role</button>
                </form>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>
