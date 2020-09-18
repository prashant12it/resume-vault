/**
 * Created by prashantsingh on 03/07/20.
 */
$(document).ready(function () {
    if(localStorage.getItem('hidecookie') && localStorage.getItem('hidecookie') == 1){
        $('#hiredlite-cookie-sec').addClass('d-none');
        $('#hiredlite-cookie-sec').removeClass('d-block');
    }else{
        $('#hiredlite-cookie-sec').removeClass('d-none');
        $('#hiredlite-cookie-sec').addClass('d-block');
    }
});

function removeCookieSec() {
    localStorage.setItem('hidecookie',1);
    $('#hiredlite-cookie-sec').addClass('d-none');
    $('#hiredlite-cookie-sec').removeClass('d-block');
}
function showElement(element) {
    $(element).removeClass('d-none');
    $(element).addClass('d-block');
}
function hideElement(element) {
    $(element).removeClass('d-block');
    $(element).addClass('d-none');
}
function movetodiv(id) {
    $('html, body').animate({
        scrollTop: parseInt($("#"+id).offset().top) - (150)
    }, 1000);
}
function movetodivbyclass(classval) {
    $('html, body').animate({
        scrollTop: parseInt($("."+classval).offset().top) - (150)
    }, 1000);
}

function openPopup(popupID) {
    $(popupID).modal({
        backdrop: 'static',
        keyboard: false
    });
    $(popupID).modal('show');
    setTimeout(function () {
        $('body').addClass('modal-open');
    },500);
}

function closePopup(popupID) {
    $(popupID).modal('hide');
    setTimeout(function () {
        $('body').removeClass('modal-open');
    },500);
}
