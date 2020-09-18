/**
 * Created by prashantsingh on 03/07/20.
 */
$(document).ready(function () {
    $(".chosen-select").chosen();
    if (Pagename == 'AddJobRoles' || Pagename == 'UpdateJobRoles') {
        var $modal = $('#imageCropper');
        var image = document.getElementById('image');
        var cropper;
        $("#userImage").on("change", function (e) {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function (blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: SiteUrl + '/api/upload_image',
                        data: {image: base64data},
                        success: function (data) {
                            console.log(data);
                            if(data.code == 200){
                                $('#uploadedImage').val(data.Filename);
                            }else{
                                alert('Image not saved. Try again.')
                            }
                            $modal.modal('hide');
                        }
                    });
                }
            });
        });

    }else if(Pagename == 'AddCandidateProfile' || Pagename == 'EditCandidateProfile'){
        $("#resumefile").on("change", function (e) {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    }
});

function deleteAnalystConfirmation(analystID) {
    $('#analystID').val(analystID);
    openPopup('#deleteConfirmationAnalyst');
}
function deleteRoleConfirmation(roleID) {
    $('#roleID').val(roleID);
    openPopup('#deleteConfirmationRole');
}
function deleteCandidateConfirmation(candidateID) {
    $('#candidateID').val(candidateID);
    openPopup('#deleteConfirmationCandidate');
}

function activeInactiveCandidate(candidateID) {
    var candidateActive = 0;
    if ($('#enable-widget' + candidateID).is(':checked')) {
        candidateActive = 1;
    }
    var formData = new FormData();
    formData.append('candidateID', candidateID);
    formData.append('is_active', candidateActive);
    $.ajax({
        type: 'POST',
        url: SiteUrl + '/api/candidate_active_inactive',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.code === 200) {
                if (candidateActive === 0) {
                    $('#enable-widget' + candidateID).prop('checked', false);
                } else {
                    $('#enable-widget' + candidateID).prop('checked', true);
                }
                $('.container .alert-success').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('.container .alert-success');
            } else if (response.code === 400) {
                $.each(response.message, function (index, value) {
                    $('.container .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                });
                showElement('.container .alert-danger');
            } else {
                $('.container .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('.container .alert-danger');
            }
        }
    });
}
function activeInactiveRole(roleID) {
    var roleActive = 0;
    if ($('#enable-widget' + roleID).is(':checked')) {
        roleActive = 1;
    }
    var formData = new FormData();
    formData.append('roleID', roleID);
    formData.append('is_active', roleActive);
    $.ajax({
        type: 'POST',
        url: SiteUrl + '/api/role_active_inactive',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.code === 200) {
                if (roleActive === 0) {
                    $('#enable-widget' + roleID).prop('checked', false);
                } else {
                    $('#enable-widget' + roleID).prop('checked', true);
                }
                $('.container .alert-success').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('.container .alert-success');
            } else if (response.code === 400) {
                $.each(response.message, function (index, value) {
                    $('.container .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                });
                showElement('.container .alert-danger');
            } else {
                $('.container .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('.container .alert-danger');
            }
        }
    });
}

function activeInactiveAnalyst(analystID) {
    var analystActive = 0;
    if ($('#enable-widget' + analystID).is(':checked')) {
        analystActive = 1;
    }
    var formData = new FormData();
    formData.append('analystID', analystID);
    formData.append('is_active', analystActive);
    $.ajax({
        type: 'POST',
        url: SiteUrl + '/api/analyst_active_inactive',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.code === 200) {
                if (analystActive === 0) {
                    $('#enable-widget' + analystID).prop('checked', false);
                } else {
                    $('#enable-widget' + analystID).prop('checked', true);
                }
                $('.container .alert-success').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('.container .alert-success');
            } else if (response.code === 400) {
                $.each(response.message, function (index, value) {
                    $('.container .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                });
                showElement('.container .alert-danger');
            } else {
                $('.container .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('.container .alert-danger');
            }
        }
    });
}

function deleteAnalyst() {
    var formData = new FormData();
    formData.append('analystID', $.trim($('#analystID').val()));
    $.ajax({
        type: 'POST',
        url: SiteUrl + '/api/delete_analyst',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('.submitBtn').attr("disabled", "disabled");
            $('#deleteConfirmationAnalyst .modal-content').css("opacity", ".5");
        },
        success: function (response) {
            $('#deleteConfirmationAnalyst .alert').empty();
            hideElement('#deleteConfirmationAnalyst .alert');
            if (response.code == 200) {
                closePopup('#deleteConfirmationAnalyst');
                window.location.href = SiteUrl + '/admin/resume_analysts';
            } else if (response.code === 400) {
                $.each(response.message, function (index, value) {
                    $('#deleteConfirmationAnalyst .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                });
                showElement('#deleteConfirmationAnalyst .alert-danger');
            } else {
                $('#deleteConfirmationAnalyst .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('#deleteConfirmationAnalyst .alert-danger');
            }
            $('#deleteConfirmationAnalyst .modal-content').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
        }
    });
}

function deleteRole() {
    var formData = new FormData();
    formData.append('roleID', $.trim($('#roleID').val()));
    $.ajax({
        type: 'POST',
        url: SiteUrl + '/api/delete_role',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('.submitBtn').attr("disabled", "disabled");
            $('#deleteConfirmationRole .modal-content').css("opacity", ".5");
        },
        success: function (response) {
            $('#deleteConfirmationRole .alert').empty();
            hideElement('#deleteConfirmationRole .alert');
            if (response.code == 200) {
                closePopup('#deleteConfirmationRole');
                window.location.href = SiteUrl + '/job_roles';
            } else if (response.code === 400) {
                $.each(response.message, function (index, value) {
                    $('#deleteConfirmationRole .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                });
                showElement('#deleteConfirmationRole .alert-danger');
            } else {
                $('#deleteConfirmationRole .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('#deleteConfirmationRole .alert-danger');
            }
            $('#deleteConfirmationRole .modal-content').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
        }
    });
}
function deleteCandidate() {
    var formData = new FormData();
    formData.append('candidateID', $.trim($('#candidateID').val()));
    $.ajax({
        type: 'POST',
        url: SiteUrl + '/api/delete_candidate',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('.submitBtn').attr("disabled", "disabled");
            $('#deleteConfirmationCandidate .modal-content').css("opacity", ".5");
        },
        success: function (response) {
            $('#deleteConfirmationCandidate .alert').empty();
            hideElement('#deleteConfirmationCandidate .alert');
            if (response.code == 200) {
                closePopup('#deleteConfirmationCandidate');
                window.location.href = SiteUrl + '/candidate_profiles';
            } else if (response.code === 400) {
                $.each(response.message, function (index, value) {
                    $('#deleteConfirmationCandidate .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                });
                showElement('#deleteConfirmationCandidate .alert-danger');
            } else {
                $('#deleteConfirmationCandidate .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                showElement('#deleteConfirmationCandidate .alert-danger');
            }
            $('#deleteConfirmationCandidate .modal-content').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
        }
    });
}

