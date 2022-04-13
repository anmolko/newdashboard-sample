//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms, 1 second for example
var $input     = $('#oldpasswordInput');
var allclearpass = 'no';
var $inputPass = $('#confirmpasswordInput');
var request_method  = 'POST'; //get form GET/POST method


//on keyup, start the countdown
$input.on('keyup click', function () {
    clearTimeout(typingTimer);
});

//on keydown, clear the countdown
$input.on('keydown blur', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

$inputPass.on('keyup click', function () {
    checkPasswordMatch();
});

//user is "finished typing," do something
function doneTyping () {
    var value  = $input.val();
    var userID = $input.attr("cs-user-id");
    var url = $input.attr("cs-check-route");
    var formData = new FormData();
    formData.append('oldpassword', value);
    formData.append('userid', userID);

    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status =='error'){
                $('#profile-password-btn').prop('disabled', true);
                $('#old-password-error').css('display', 'block');
                $('#old-password-error').css('color', '');
                $('#old-password-error').text(response.message);
                allclearpass = 'no';
                // old-password-error
            }else{
                $('#profile-password-btn').prop('disabled', false);
                $('#old-password-error').css('display', 'block');
                $('#old-password-error').css('color', '#0ab39c');
                $('#old-password-error').text(response.message);
                allclearpass = 'clear';
            }
        },
        error: function(response) {
            console.log(response);
        }
    })
}

function checkPasswordMatch() {
    var password = $('#newpasswordInput').val();
    var confirmPassword = $inputPass.val();
    if (password !== confirmPassword) {
        $('#profile-password-btn').prop('disabled', true);
        $('#confirm-password-error').css('display', 'block');
        $('#confirm-password-error').css('color', '');
        $('#confirm-password-error').text("Your confirm password doesn't match.");
    } else {
        if(allclearpass == 'clear'){
            $('#profile-password-btn').prop('disabled', false);
        }
        $('#confirm-password-error').css('display', 'block');
        $('#confirm-password-error').css('color', '#0ab39c');
        $('#confirm-password-error').text("Your confirm is a match.");
    }
}

$('#profile-foreground-img-file-input, #profile-img-file-input').on('change', function() {
    var cover  = this.files[0];
    var userID = $(this).attr("cs-user-id");
    var name   = $(this).attr("name");
    var url    = $(this).attr("cs-update-route");
    var imagereplaceID = '#header-profile-user-updates';
    var formData = new FormData();
    formData.append('name', name);
    formData.append('userid', userID);
    formData.append('image', cover);
    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status=='success'){
                if(name == 'image'){
                    var imagename = 'profile image';
                    $(imagereplaceID).attr("src",'/images/user/'+response.image );
                }else{
                    var imagename = 'cover photo';
                }
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 50,
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                        '</lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Success !</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your '+ imagename +' has been changed .</p>'
                        + '</div>' +
                        '</div>',
                    animation: !1,
                    timerProgressBar: !0,
                    timer: 2e3,
                    showConfirmButton: !1
                });
            }
            else{
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 50,
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Oops...!</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your'+ imagename +' could not be changed at the moment .</p>'
                        + '</div>' +
                        '</div>',
                    animation: !1,
                    timerProgressBar: !0,
                    timer: 3000,
                    showConfirmButton: !1
                });
            }
        },
        error: function(response) {
            console.log(response);
        }
    })


});

$('#profile-password-btn').on('click', function() {
    var form            = $('#profile-password-form')[0]; //get the form using ID
    if (!form.reportValidity()) { return false;}
    var formData        = new FormData(form); //Creates new FormData object
    var url             = $(this).attr("cs-store-route");
    var request_method  = 'POST'; //get form GET/POST method
    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status=='success'){
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 50,
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                        '</lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Success !</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your password has been changed .</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 2e3,
                    showConfirmButton: !1
                });
                $('#oldpasswordInput').val('');
                $('#newpasswordInput').val('');
                $('#confirmpasswordInput').val('');
                $('#old-password-error').css('display', 'none');
                $('#confirm-password-error').css('display', 'none');
            }
            else{
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 50,
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Oops...! </h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your password could not be changed at the moment .</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 3000,
                    showConfirmButton: !1
                });
            }
        },
        error: function(response) {
            console.log(response);
        }
    })


});




