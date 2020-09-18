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
        <?php if (isset($successMsg) && !empty($successMsg)) { ?>
            <div class="col-xs-12">
                <div class="alert alert-success"><?php echo $successMsg; ?></div>
            </div>
        <?php } ?>
        <?php if (isset($errorMsg) && !empty($errorMsg)) { ?>
            <div class="col-xs-12">
                <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-8 head">
                <h2><?php echo $szMetaTagTitle;?></h2>
            </div>
            <?php if($role == 1){ ?>
            <div class="col-md-4 head">
                <div class="float-right">
                    <a href="<?php echo __BASE_URL__.'/admin/add_job_role';?>" class="btn btn-success"><i
                                class="fa fa-user-plus"></i> Add New Job Role</a>
                </div>
            </div>
            <?php } ?>
        </div>
            <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <!-- Data list table -->
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Tags</th>
                            <th>Active/Inactive</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($jobrolesArr)) {
                            $i = 1;
                            foreach ($jobrolesArr as $row) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo (!empty($row['profile_pic'])?__BASE_URL__.'/uploads/'.$row['profile_pic']:__BASE_IMAGES_URL__.'/user-placeholder.png'); ?>" width="75" />
                                        <p class="mt-2"><?php echo $row['name']; ?></p>
                                    </td>
                                    <td><?php echo (!empty($row['description'])?nl2br($row['description']):'--'); ?></td>
                                    <td><?php echo (!empty($row['tags'])?$row['tags']:'--'); ?></td>
                                    <td>
                                        <label class="switch">
                                            <input id="enable-widget<?php echo $row['id']; ?>" onclick="activeInactiveRole('<?php echo $row['id']; ?>')" type="checkbox" <?php echo ($row['is_active']==1?'checked':'');?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a title="Edit job role" href="<?php echo __BASE_URL__.'/edit_job_roles/'.$row['id'];?>" class="btn btn-primary"><i class="fa fa-pencil-square"></i> </a>
                                            <?php if($role == 1){ ?>
                                                <a title="Remove job role" href="javascript:void(0)" onclick="deleteRoleConfirmation('<?php echo $row['id']; ?>')" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                            <?php }?>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;
                            }
                        } else { ?>
                            <tr>
                                <td colspan="6">No Data Found...</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php echo $links;?>
            </div>
        </div>
    </div>
</section>
