$('#user-add-button').on('click', function(e) {
    var form            = $('#user-add-form')[0]; //get the form using ID
    if (!form.reportValidity()) { return false;}
    var formData        = new FormData(form); //Creates new FormData object
    var url             = $(this).attr("cs-create-route");
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

            if(response.status=='slug duplicate'){
                Toastify({ newWindow: !0, text: response.message, gravity: 'top', position: 'center', stopOnFocus: !0, duration: 3000, close: "close",className: "bg-warning",style: "style" == e.style ? { background: "linear-gradient(to right, #0AB39C, #405189)" } : "" }).showToast();
                return;
            }
            if(response.status=='email duplicate'){
                Toastify({ newWindow: !0, text: response.message, gravity: 'top', position: 'center', stopOnFocus: !0, duration: 3000, close: "close",className: "bg-warning" ,style: "style" == e.style ? { background: "linear-gradient(to right, #0AB39C, #405189)" } : "" }).showToast();
                return;
            }
            var cover = (response.user.cover !== null) ? "/images/user/cover/"+response.user.cover :  "/assets/backend/images/profile-bg.jpeg";
            var image = (response.user.image !== null) ? "/images/user/"+response.user.image :  "/assets/backend/images/default.png";
            var status = (response.user.status == 0) ? "Inactive" :  "Active";
            var status_icon = (response.user.status == 0) ? "ri-close-circle-line" :  "ri-checkbox-circle-line";
            var status_type = (response.user.status == 0) ? "text-warning" :  "text-success";
            var contact = (response.user.contact == null) ? "Not Added":response.user.contact;
            var slug = '/profile/'+ response.user.slug;
            $('#addmembers').modal('hide');
            if(response.status=='success'){
                console.log(response.user);
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 60,
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                        '</lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Success !</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        response.message +
                        '</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 2e3,
                    showConfirmButton: !1
                });
                var append = '<div class="col" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">' +
                    '<div class="card team-box"> ' +
                    '<div class="team-cover"> ' +
                    '<img  src="'+cover+'" alt="user-cover" class="img-fluid" />' +
                    '</div>' +
                    '<div class="card-body p-4">' +
                    '<div class="row align-items-center team-row">' +
                    '<div class="col-lg-4 col team-settings">' +
                    '<div class="row">' +
                    '<div class="col '+status_type+'" style="font-weight: 500">' +
                    '<i class=" '+status_icon+' fs-16 align-middle"></i> '+
                    status
                    +
                    '</div>' +
                    '<div class="col text-end dropdown">' +
                    '<a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">' +
                    '<i class="ri-more-fill fs-17"></i>' +
                    '</a>' +
                    '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">' +
                    '<li><a class="dropdown-item cs-status-change"><i class="ri-bar-chart-line me-2 align-middle"></i>Status</a></li>'+
                    '<li><a class="dropdown-item cs-role-change"><i class="ri-shield-user-line me-2 align-middle"></i>User Type</a></li>'+
                    '<li><a class="dropdown-item cs-user-remove"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>'+
                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 col">' +
                    '<div class="team-profile-img">' +
                    '<div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">' +
                    '<img  src="'+image+'" alt="" class="img-fluid d-block rounded-circle" /> ' +
                    '</div>' +
                    '<div class="team-content">' +
                    '<h5 class="fs-16 mb-1" style="text-transform:capitalize;">'+ response.user.name +'<span class="badge bg-success ms-1">Recently added</span></h5>' +
                    '<p class="text-muted mb-0">'+ response.user.email +'</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 col"><div class="row text-muted text-center"> ' +
                    '<div class="col-6 border-end border-end-dashed">' +
                    '<h5 class="mb-1" style="text-transform:capitalize;">'+response.user.user_type+'</h5>'+
                    '<p class="text-muted mb-0">User Role</p> ' +
                    '</div> ' +
                    '<div class="col-6"> ' +
                    '<h5 class="mb-1">'+ contact +'</h5>'+
                    '<p class="text-muted mb-0">Contact</p>'+
                    '</div>' +
                    '</div>' +
                    '</div> ' +
                    '<div class="col-lg-2 col">' +
                    '<div class="text-end">' +
                    '<a href="'+slug+'" class="btn btn-light view-btn">View Profile</a> ' +
                    '</div>' +
                    '</div> ' +
                    '</div>' +
                    '</div>' +
                    '</div> ' +
                    '</div>';
                $("#user-list").prepend(append);
            }
            else{
                Swal.fire({
                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                    imageHeight: 60,
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Oops...! </h4>' +
                        '<p class="text-muted mx-4 mb-0">' + response.message +
                        '</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 3000,
                    showConfirmButton: !1
                });
            }
        }, error: function(response) {
            console.log(response);
        }



    });

});
