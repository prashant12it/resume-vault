$(document).ready(function () {
    $("#savecollections").on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('store_id', $('#store_id').val());
        formData.append('categories', $('#hosted').val());
        $.ajax({
            type: 'POST',
            url: SiteUrl + '/api/save_store_categories',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled", "disabled");
                $('#savecollections').css("opacity", ".5");
            },
            success: function (response) {
                $('#savecollections .alert').empty();
                hideElement('#savecollections .alert');
                if (response.code === 200) {
                    $('#savecollections .alert-success').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#savecollections .alert-success');
                } else if (response.code === 400) {
                    $.each(response.message, function (index, value) {
                        $('#savecollections .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                    });
                    showElement('#savecollections .alert-danger');
                } else {
                    $('#savecollections .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#savecollections .alert-danger');
                }
                $('#savecollections').css("opacity", "");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    $("#signupinfluencer").on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $('#inf_username').val());
        formData.append('email', $('#inf_emailid').val());
        formData.append('password', $('#inf_password').val());
        formData.append('cpassword', $('#inf_cpassword').val());
        formData.append('shop_url', $('#shop_url').val());
        formData.append('app', $('#installedapp').val());
        formData.append('business', ($('#businessopt').is(':checked') ? 1 : 0));
        formData.append('review', ($('#reviewsopt').is(':checked') ? 1 : 0));
        $.ajax({
            type: 'POST',
            url: SiteUrl + '/api/papernapsignup',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled", "disabled");
                $('#signupinfluencer').css("opacity", ".5");
            },
            success: function (response) {
                $('#signupinfluencer .alert').empty();
                hideElement('#signupinfluencer .alert');
                if (response.code === 200) {
                    $('#signupinfluencer .alert-success').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#signupinfluencer .alert-success');
                    $('#inf_username').val('');
                    $('#inf_emailid').val('');
                    $('#inf_password').val('');
                    $('#inf_cpassword').val('');
                    $('#shop_url').val('');
                    $('#businessopt').val(1);
                    $('#reviewsopt').val(1);
                    $('#businessopt').prop('checked', true);
                    $('#reviewsopt').prop('checked', true);
                    setTimeout(function () {
                        closePopup('#influencer_login_popup_modal');
                        // openPopup('#payemnt');
                        window.location.replace(SiteUrl + '/dashboard?type=signup');
                    }, 2000);
                    // openPopup('#AppOptionModal');

                } else if (response.code === 400) {
                    $.each(response.message, function (index, value) {
                        $('#signupinfluencer .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                    });
                    showElement('#signupinfluencer .alert-danger');
                } else {
                    $('#signupinfluencer .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#signupinfluencer .alert-danger');
                }
                $('#signupinfluencer').css("opacity", "");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });

    $("#login").on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('username', $('#login_username').val());
        formData.append('password', $('#loginpassword').val());
        $.ajax({
            type: 'POST',
            url: SiteUrl + '/api/papernaplogin',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled", "disabled");
                $('#login').css("opacity", ".5");
            },
            success: function (response) {
                $('#login .alert').empty();
                hideElement('#login .alert');
                if (response.code === 200) {
                    $('#login .alert-success').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#login .alert-success');
                    $('#login_username').val('');
                    $('#loginpassword').val('');
                    setTimeout(function () {
                        closePopup('#loginModal');
                        window.location.replace(SiteUrl + '/dashboard');
                    }, 2000);
                } else if (response.code === 400) {
                    $.each(response.message, function (index, value) {
                        $('#login .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                    });
                    showElement('#login .alert-danger');
                } else {
                    $('#login .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#login .alert-danger');
                }
                $('#login').css("opacity", "");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    $("#stripedetailsform").on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('stripe1', $('#stripe1').val());
        formData.append('stripe2', $('#stripe2').val());
        $.ajax({
            type: 'POST',
            url: SiteUrl + '/api/savestripe',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled", "disabled");
                $('#stripedetailsform').css("opacity", ".5");
            },
            success: function (response) {
                $('#stripedetailsform .alert').empty();
                hideElement('#stripedetailsform .alert');
                if (response.code === 200) {
                    $('#stripedetailsform .alert-success').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#stripedetailsform .alert-success');
                    $('#stripe1').val('');
                    $('#stripe2').val('');
                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                } else if (response.code === 400) {
                    $.each(response.message, function (index, value) {
                        $('#stripedetailsform .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                    });
                    showElement('#stripedetailsform .alert-danger');
                } else {
                    $('#stripedetailsform .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#stripedetailsform .alert-danger');
                }
                $('#stripedetailsform').css("opacity", "");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    $("#enable-widget").on('click', function (e) {
        var showWidget = 0;
        console.log($('#enable-widget').is(':checked'));
        if ($('#enable-widget').is(':checked')) {
            showWidget = 1;
        }
        var formData = new FormData();
        formData.append('enable_widget', showWidget);
        formData.append('shop', $('#shopify_store').val());
        $.ajax({
            type: 'POST',
            url: SiteUrl + '/api/enabledisablewidget',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.code === 200) {
                    if (showWidget === 0) {
                        $('#enable-widget').prop('checked', false);
                    } else {
                        $('#enable-widget').prop('checked', true);
                    }
                } else if (response.code === 400) {
                    $.each(response.message, function (index, value) {
                        $('#WidgetErrMessageArea .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                    });
                    showElement('#WidgetErrMessageArea .alert-danger');
                } else {
                    $('#WidgetErrMessageArea .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#WidgetErrMessageArea .alert-danger');
                }
            }
        });
    });
    $("#install-app").on('click', function (e) {
        var installapp = 0;
        if ($('#install-app').is(':checked')) {
            installapp = 1;
        }
        var formData = new FormData();
        formData.append('install_app', installapp);
        formData.append('shop', $('#shopify_store').val());
        $.ajax({
            type: 'POST',
            url: SiteUrl + '/api/installapprequest',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.code === 200) {
                    if (installapp === 0) {
                        $('#install-app').prop('checked', false);
                    } else {
                        $('#install-app').prop('checked', true);
                    }
                } else if (response.code === 400) {
                    $.each(response.message, function (index, value) {
                        $('#WidgetErrMessageArea .alert-danger').append('<p class="mb-2 mt-2">' + value + '</p>');
                    });
                    showElement('#WidgetErrMessageArea .alert-danger');
                } else {
                    $('#WidgetErrMessageArea .alert-danger').append('<p class="mb-2 mt-2">' + response.message + '</p>');
                    showElement('#WidgetErrMessageArea .alert-danger');
                }
            }
        });
    });
});

function removeCookieSec() {
    localStorage.setItem('hidecookie', 1);
    $('#hiredlite-cookie-sec').addClass('d-none');
    $('#hiredlite-cookie-sec').removeClass('d-block');
}

/**
 * Created by prashantsingh on 03/07/20.
 */
// Create a Stripe client.
var stripe = Stripe(publishableKeyStripe);

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function (event) {
    event.preventDefault();

    stripe.createToken(card).then(function (result) {
        if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
        }
    });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
