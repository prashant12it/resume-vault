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
                    <a href="<?php echo __BASE_URL__.'/candidate_profiles';?>" class="btn btn-success"><i
                                class="fa fa-user"></i> Candidate Profile(s)</a>
                </div>
            </div>
        </div>
            <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <!-- Data list table -->
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <?php if (!empty($candidateProfileDetArr)) { ?>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $candidateProfileDetArr[0]['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $candidateProfileDetArr[0]['email']; ?></td>
                        </tr>
                        <tr>
                            <th>Mobile No.</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['mobile_no'])?$candidateProfileDetArr[0]['mobile_no']:'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Address 1</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['address1'])?nl2br($candidateProfileDetArr[0]['address1']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Address 2</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['address2'])?nl2br($candidateProfileDetArr[0]['address2']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Address 3</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['address3'])?nl2br($candidateProfileDetArr[0]['address3']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>100 points check</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['points_check'])?nl2br($candidateProfileDetArr[0]['points_check']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Resume</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['resume_file'])?'<a href="'.__BASE_URL__.'/uploads/'.$candidateProfileDetArr[0]['resume_file'].'" target="_blank">View</a>':'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Skills</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['skills'])?nl2br($candidateProfileDetArr[0]['skills']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Qualification</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['qualification'])?nl2br($candidateProfileDetArr[0]['qualification']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Experience</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['experience'])?nl2br($candidateProfileDetArr[0]['experience']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Certifications</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['certifications'])?nl2br($candidateProfileDetArr[0]['certifications']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Memberships</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['memberships'])?nl2br($candidateProfileDetArr[0]['memberships']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Companies</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['companies'])?nl2br($candidateProfileDetArr[0]['companies']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Bankruptcy</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['bankruptcy'])?nl2br($candidateProfileDetArr[0]['bankruptcy']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Workers Compensation</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['workers_compensation'])?nl2br($candidateProfileDetArr[0]['workers_compensation']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Police & Criminal check</th>
                            <td><p><?php echo ($candidateProfileDetArr[0]['police_criminal_check'] == 1?'Yes':'No'); ?></p>
                                <p><b>Comment: </b><?php echo (!empty($candidateProfileDetArr[0]['police_criminal_comment'])?nl2br($candidateProfileDetArr[0]['police_criminal_comment']):'--'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th>Reference checks</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['reference_checks'])?nl2br($candidateProfileDetArr[0]['reference_checks']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Entitled to work</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['work_entitle'])?nl2br($candidateProfileDetArr[0]['work_entitle']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Social Media</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['social_media'])?nl2br($candidateProfileDetArr[0]['social_media']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Shareholdings</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['share_holdings'])?nl2br($candidateProfileDetArr[0]['share_holdings']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Employment Availability</th>
                            <td><?php echo ($candidateProfileDetArr[0]['employment_available'] == 0?'No':($candidateProfileDetArr[0]['employment_available'] == 1?'Yes':'Future Date')); ?></td>
                        </tr>
                        <tr>
                            <th>Job type</th>
                            <td><?php echo ($candidateProfileDetArr[0]['job_type'] == 1?'Permanent':($candidateProfileDetArr[0]['job_type'] == 2?'Contractor':($candidateProfileDetArr[0]['job_type'] == 3?'Part time':'--'))); ?></td>
                        </tr>
                        <tr>
                            <th>Pay and Compensation – Salary expectation</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['pay_compensation'])?$candidateProfileDetArr[0]['pay_compensation']:'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Work challenges</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['work_challanges'])?nl2br($candidateProfileDetArr[0]['work_challanges']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Inspiration to perform</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['inspiration'])?nl2br($candidateProfileDetArr[0]['inspiration']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Work arrangements</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['work_arrangements'])?nl2br($candidateProfileDetArr[0]['work_arrangements']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Management</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['management'])?nl2br($candidateProfileDetArr[0]['management']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Job security</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['job_security'])?nl2br($candidateProfileDetArr[0]['job_security']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Influence over priorities</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['influence_over_priorities'])?nl2br($candidateProfileDetArr[0]['influence_over_priorities']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Impact on Company Success</th>
                            <td><?php echo (!empty($candidateProfileDetArr[0]['success_impact'])?nl2br($candidateProfileDetArr[0]['success_impact']):'--'); ?></td>
                        </tr>
                        <tr>
                            <th>Active/Inactive</th>
                            <td><?php echo ($candidateProfileDetArr[0]['is_active'] == 1?'Active':'Inactive'); ?></td>
                        </tr>
                        <?php }else{ ?>
                            <tr>
                                <th colspan="2">No Data Found...</th>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
