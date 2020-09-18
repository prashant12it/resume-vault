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
            <!-- Import link -->
            <div class="col-md-4 head">
                <div class="float-right">
                    <a href="<?php echo __BASE_URL__.'/add_candidate_profile';?>" class="btn btn-success"><i
                                class="fa fa-user-plus"></i> Add New Candidate Profile</a>
                </div>
            </div>
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
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Active/Inactive</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($candidateProfilesArr)) {
                            $i = 1;
                            foreach ($candidateProfilesArr as $row) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['name']; ?></p>
                                    </td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo (!empty($row['mobile_no'])?$row['mobile_no']:'--'); ?></td>
                                    <td>
                                        <label class="switch">
                                            <input id="enable-widget<?php echo $row['id']; ?>" onclick="activeInactiveCandidate('<?php echo $row['id']; ?>')" type="checkbox" <?php echo ($row['is_active']==1?'checked':'');?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a title="View candidate profile" href="<?php echo __BASE_URL__.'/view_candidate_profile/'.$row['id'];?>" class="btn btn-success"><i class="fa fa-eye"></i> </a>
                                            <a title="Edit candidate profile" href="<?php echo __BASE_URL__.'/edit_candidate_profile/'.$row['id'];?>" class="btn btn-primary"><i class="fa fa-pencil-square"></i> </a>
                                            <a title="Remove candidate profile" href="javascript:void(0)" onclick="deleteCandidateConfirmation('<?php echo $row['id']; ?>')" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
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
