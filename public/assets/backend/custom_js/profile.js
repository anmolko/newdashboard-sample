$('#profile-foreground-img-file-input, #profile-img-file-input').on('change', function() {
    var cover  = this.files[0];
    var userID = "{{$user->id}}";
    var name   = $(this).attr("name");
    var url    = $(this).attr("cs-update-route");
    var imagereplaceID = '#header-profile-user-updates';
    var formData = new FormData();
    formData.append('name', name);
    formData.append('image', cover);
    $.ajax({
        type : 'POST',
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            console.log(response);

            if(response.status=='success'){
                if(name == 'image'){
                    var imagename = 'profile image';
                    $(imagereplaceID).attr("src",'/images/user/'+response.image );
                }else{
                    var imagename = 'cover photo';
                }
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 40,
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
            }else{
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 40,
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
