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
                    <a href="<?php echo __BASE_URL__.'/candidate_profiles';?>" class="btn btn-success"><i
                                class="fa fa-eye"></i> Candidate's Profiles(s)</a>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h2 class="mb-5"><?php echo $szMetaTagTitle;?></h2>
                <form action="<?php echo __BASE_URL__ . '/add_candidate_profile' ?>" method="post"
                      enctype="multipart/form-data" id="addCandidateForm">
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
                    <div class="form-group mt-5 mb-4">
                        <hr />
                        <h3>Identity</h3>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" required class="form-control" value="<?php echo(validation_errors() || $errorMsg ? set_value('name') : ''); ?>" id="name" name="name" placeholder="Enter job role">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" required class="form-control" id="email" value="<?php echo(validation_errors() || $errorMsg ? set_value('email') : ''); ?>" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="mobile_no">Mobile No.</label>
                        <input type="tel" class="form-control" id="mobile_no" value="<?php echo(validation_errors() || $errorMsg ? set_value('mobile_no') : ''); ?>" name="mobile_no" aria-describedby="mobileHelp" placeholder="Enter mobile number">
                        <small id="mobileHelp" class="form-text text-muted">We'll never share your mobile number with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="address1">Address 1</label>
                        <textarea rows="2" id="address1" class="form-control" name="address1" placeholder="Enter address 1"><?php echo(validation_errors() || $errorMsg ? set_value('address1') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address2">Address 2</label>
                        <textarea rows="2" id="address2" class="form-control" name="address2" placeholder="Enter address 2"><?php echo(validation_errors() || $errorMsg ? set_value('address2') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address3">Address 3</label>
                        <textarea rows="2" id="address3" class="form-control" name="address3" placeholder="Enter address 3"><?php echo(validation_errors() || $errorMsg ? set_value('address3') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="points_check">100 points check</label>
                        <textarea rows="5" id="points_check" class="form-control" name="points_check" placeholder="Enter 100 points check"><?php echo(validation_errors() || $errorMsg ? set_value('points_check') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="uploadedImage">Resume</label>
                        <div class="custom-file">
                            <input type="file" value="<?php echo(validation_errors() || $errorMsg ? set_value('file') : ''); ?>" class="custom-file-input" name="file" id="resumefile">
                            <label class="custom-file-label" for="resumefile">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group mt-5 mb-4">
                        <hr />
                        <h3>Capabilities</h3>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <textarea rows="5" id="skills" class="form-control" name="skills" placeholder="Enter skills"><?php echo(validation_errors() || $errorMsg ? set_value('skills') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <textarea rows="5" id="qualification" class="form-control" name="qualification" placeholder="Enter qualification"><?php echo(validation_errors() || $errorMsg ? set_value('qualification') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="experience">Experience</label>
                        <textarea rows="5" id="experience" class="form-control" name="experience" placeholder="Enter experience"><?php echo(validation_errors() || $errorMsg ? set_value('experience') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="certifications">Certifications</label>
                        <textarea rows="5" id="certifications" class="form-control" name="certifications" placeholder="Enter certifications"><?php echo(validation_errors() || $errorMsg ? set_value('certifications') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="memberships">Memberships</label>
                        <textarea rows="5" id="memberships" class="form-control" name="memberships" placeholder="Enter memberships"><?php echo(validation_errors() || $errorMsg ? set_value('memberships') : ''); ?></textarea>
                    </div>
                    <div class="form-group mt-5 mb-4">
                        <hr />
                        <h3>History</h3>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label for="companies">Companies</label>
                        <textarea rows="5" id="companies" class="form-control" name="companies" placeholder="Enter companies"><?php echo(validation_errors() || $errorMsg ? set_value('companies') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bankruptcy">Bankruptcy</label>
                        <textarea rows="5" id="bankruptcy" class="form-control" name="bankruptcy" placeholder="Enter bankruptcy details"><?php echo(validation_errors() || $errorMsg ? set_value('bankruptcy') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="workers_compensation">Workers Compensation</label>
                        <textarea rows="5" id="workers_compensation" class="form-control" name="workers_compensation" placeholder="Enter workers compensation"><?php echo(validation_errors() || $errorMsg ? set_value('workers_compensation') : ''); ?></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label for="police_criminal_comment">Police & Criminal check</label>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php echo((validation_errors() || $errorMsg) && set_value('police_criminal_check') == 1?  '': 'checked'); ?> type="radio" name="police_criminal_check" id="police_criminal_check_no" value="0">
                            <label class="form-check-label h-auto m-auto" for="police_criminal_check_no">
                                No
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php echo((validation_errors() || $errorMsg) && set_value('police_criminal_check') == 1?  'checked': ''); ?> type="radio" name="police_criminal_check" id="police_criminal_check_yes" value="1">
                            <label class="form-check-label h-auto m-auto" for="police_criminal_check_yes">
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="police_criminal_comment">Comment</label>
                        <textarea rows="5" id="police_criminal_comment" class="form-control" name="police_criminal_comment" placeholder="Comment"><?php echo(validation_errors() || $errorMsg ? set_value('police_criminal_comment') : ''); ?></textarea>
                    </div>
                    <div class="form-group mt-5 mb-4">
                        <hr />
                        <h3>Suitability</h3>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label for="reference_checks">Reference checks</label>
                        <textarea rows="5" id="reference_checks" class="form-control" name="reference_checks" placeholder="Enter reference checks"><?php echo(validation_errors() || $errorMsg ? set_value('reference_checks') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="work_entitle">Entitled to work</label>
                        <textarea rows="5" id="work_entitle" class="form-control" name="work_entitle" placeholder="Enter entitled to work"><?php echo(validation_errors() || $errorMsg ? set_value('work_entitle') : ''); ?></textarea>
                    </div>
                    <div class="form-group mt-5 mb-4">
                        <hr />
                        <h3>Desirability</h3>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label for="social_media">Social Media</label>
                        <textarea rows="5" id="social_media" class="form-control" name="social_media" placeholder="Enter social media"><?php echo(validation_errors() || $errorMsg ? set_value('social_media') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="share_holdings">Shareholdings</label>
                        <textarea rows="5" id="share_holdings" class="form-control" name="share_holdings" placeholder="Enter Shareholdings"><?php echo(validation_errors() || $errorMsg ? set_value('share_holdings') : ''); ?></textarea>
                    </div>
                    <div class="form-group mt-5 mb-4">
                        <hr />
                        <h3>Employment Expectations</h3>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label for="employment_available">Available</label>
                        <select class="form-control" id="employment_available" name="employment_available">
                            <option value="0" <?php echo((validation_errors() || $errorMsg) && set_value('employment_available') == 0?  'selected': ''); ?>>No</option>
                            <option value="1" <?php echo((validation_errors() || $errorMsg) && set_value('employment_available') == 1?  'selected': ''); ?>>Yes</option>
                            <option value="2" <?php echo((validation_errors() || $errorMsg) && set_value('employment_available') == 2?  'selected': ''); ?>>Future date</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="job_type">Job type</label>
                        <select class="form-control" id="job_type" name="job_type">
                            <option value="0" <?php echo((validation_errors() || $errorMsg) && set_value('job_type') == 0?  'selected': ''); ?>>Select job type</option>
                            <option value="1" <?php echo((validation_errors() || $errorMsg) && set_value('job_type') == 1?  'selected': ''); ?>>Permanent</option>
                            <option value="2" <?php echo((validation_errors() || $errorMsg) && set_value('job_type') == 2?  'selected': ''); ?>>Contractor</option>
                            <option value="3" <?php echo((validation_errors() || $errorMsg) && set_value('job_type') == 3?  'selected': ''); ?>>Part time</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="pay_compensation_type">Pay and Compensation – Salary expectation</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <select class="form-control" id="pay_compensation_type" name="pay_compensation_type">
                                    <option value="$ per day" <?php echo((validation_errors() || $errorMsg) && set_value('pay_compensation_type') == '$ per day'?  'selected': ''); ?>>$ per day</option>
                                    <option value="$ per hour" <?php echo((validation_errors() || $errorMsg) && set_value('pay_compensation_type') == '$ per hour'?  'selected': ''); ?>>$ per hour</option>
                                    <option value="$ annual salary" <?php echo((validation_errors() || $errorMsg) && set_value('pay_compensation_type') == '$ annual salary'?  'selected': ''); ?>>$ annual salary</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" value="<?php echo(validation_errors() || $errorMsg ? set_value('pay_compensation_val') : '0'); ?>" id="pay_compensation_val" name="pay_compensation_val" placeholder="Enter expected value">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="work_challanges">Work challenges</label>
                        <textarea rows="5" id="work_challanges" class="form-control" name="work_challanges" placeholder="Enter work & challanges"><?php echo(validation_errors() || $errorMsg ? set_value('work_challanges') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inspiration">Inspiration to perform</label>
                        <textarea rows="5" id="inspiration" class="form-control" name="inspiration" placeholder="Enter inspiration to perform"><?php echo(validation_errors() || $errorMsg ? set_value('inspiration') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="work_arrangements">Work arrangements</label>
                        <textarea rows="5" id="work_arrangements" class="form-control" name="work_arrangements" placeholder="Enter work arrangements"><?php echo(validation_errors() || $errorMsg ? set_value('work_arrangements') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="management">Management</label>
                        <textarea rows="5" id="management" class="form-control" name="management" placeholder="Management"><?php echo(validation_errors() || $errorMsg ? set_value('management') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="job_security">Job security</label>
                        <textarea rows="5" id="job_security" class="form-control" name="job_security" placeholder="Enter about job security"><?php echo(validation_errors() || $errorMsg ? set_value('job_security') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="influence_over_priorities">Influence over priorities</label>
                        <textarea rows="5" id="influence_over_priorities" class="form-control" name="influence_over_priorities" placeholder="Enter Influence over priorities"><?php echo(validation_errors() || $errorMsg ? set_value('influence_over_priorities') : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="success_impact">Impact on Company Success</label>
                        <textarea rows="5" id="success_impact" class="form-control" name="success_impact" placeholder="Enter Impact on Company Success"><?php echo(validation_errors() || $errorMsg ? set_value('success_impact') : ''); ?></textarea>
                    </div>
                    <div class="form-group mt-5 mb-4">
                        <hr />
                        <h3>General</h3>
                        <hr />
                    </div>
                    <div class="form-group mb-0">
                        <label for="exampleInputPassword1">Active/Inactive</label>
                    </div>
                    <div class="form-check pl-0">
                        <label class="switch">
                            <input id="enable-widget" type="checkbox" name="is_active" <?php echo((validation_errors() || $errorMsg) && isset($_POST['is_active']) && $_POST['is_active'] == 1? 'checked' : ''); ?>  value="<?php echo(validation_errors() || $errorMsg ? set_value('is_active') : '1'); ?>" />
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Candidate Profile</button>
                </form>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>
