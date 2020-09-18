<?php
/**
 * Created by PhpStorm.
 * User: prashantsingh
 * Date: 16/03/20
 * Time: 3:17 PM
 */
?>
<div class="modal fade" id="deleteConfirmationAnalyst" tabindex="-1" role="dialog"
     aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert font-weight-bold alert-danger d-none"></div>
                <div class="alert font-weight-bold alert-success d-none"></div>
                <p>Are you sure, you want to delete this resume analyst?</p>
                <input type="hidden" id="analystID" value=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger col-lg-2 submitBtn" onclick="deleteAnalyst()">Yes</button>
                <button type="button" class="btn btn-info col-lg-2" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteConfirmationRole" tabindex="-1" role="dialog"
     aria-labelledby="deleteConfirmationRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationRoleModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert font-weight-bold alert-danger d-none"></div>
                <div class="alert font-weight-bold alert-success d-none"></div>
                <p>Are you sure, you want to delete this job role?</p>
                <input type="hidden" id="roleID" value=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger col-lg-2 submitBtn" onclick="deleteRole()">Yes</button>
                <button type="button" class="btn btn-info col-lg-2" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteConfirmationCandidate" tabindex="-1" role="dialog"
     aria-labelledby="deleteConfirmationCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationCandidateModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert font-weight-bold alert-danger d-none"></div>
                <div class="alert font-weight-bold alert-success d-none"></div>
                <p>Are you sure, you want to delete this candidate profile?</p>
                <input type="hidden" id="candidateID" value=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger col-lg-2 submitBtn" onclick="deleteCandidate()">Yes</button>
                <button type="button" class="btn btn-info col-lg-2" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageCropper" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop and Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info col-ld-2" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary col-ld-2" id="crop">Upload</button>
            </div>
        </div>
    </div>
</div>
<script>
    var SiteUrl = '<?php echo __BASE_URL__;?>';
    var Pagename = '<?php echo $subpageName;?>';
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- jQuery -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/jquery.2.2.3.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo __ASSETS_PATH__ . 'ref-theme/'; ?>vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script src="<?php echo __BASE_JS_URL__; ?>/chosen.jquery.min.js"></script>
<script src="<?php echo __BASE_JS_URL__; ?>/common.js?<?php echo time(); ?>"></script>
<script src="<?php echo __BASE_JS_URL__; ?>/admin.js?<?php echo time(); ?>"></script>
</body>
</html>
