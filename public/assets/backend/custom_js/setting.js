$(document).ready(function () {
    createEditor('ckeditor-classic-privacy');
    createEditor('ckeditor-classic-terms');
});
function createEditor(id){
    ClassicEditor.create(document.querySelector("#"+id))
        .then( editor => {
            window.editor = editor;
            editor.ui.view.editable.element.style.height="200px";
            editor.model.document.on( 'change:data', () => {
                $( '#' + id).text(editor.getData());
            } );
        } )
        .catch(function(e){console.error(e)});
}

$(document).on('click','.cs-faq-edit', function (e) {
    e.preventDefault();
    var url =  $(this).attr('cs-edit-route');
    var action = $(this).attr('cs-update-route');
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult){
            $("#edit_faq").modal("toggle");
            console.log(dataResult.date);
            $('#update-name').attr('value',dataResult.name);
            $('#update-description').text(dataResult.description);
            $('.updatefaq').attr('action',action);
        },
        error: function(error){
            console.log(error)
        }
    });
});

$(document).on('click','.cs-faq-remove', function (e) {
    e.preventDefault();
    var form = $('#deleted-form');
    var action = $(this).attr('cs-delete-route');
    form.attr('action',action);
    var url = form.attr('action');
    var form_data = form.serialize();
    Swal.fire({
        imageUrl: "/assets/backend/images/canosoft-logo.png",
        imageHeight: 60,
        html: '<div class="mt-2">' +
            '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
            ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
            'style="width:120px;height:120px"></lord-icon>' +
            '<div class="mt-4 pt-2 fs-15">' +
            '<h4>Are your sure? </h4>' +
            '<p class="text-muted mx-4 mb-0">' +
            'You want to Remove this Record ?</p>' +
            '</div>' +
            '</div>',
        showCancelButton: !0,
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        cancelButtonClass: "btn btn-danger w-xs mt-2",
        confirmButtonText: "Yes!",
        buttonsStyling: !1,
        showCloseButton: !0
    }).then(function(t)
    {
        t.value
            ?
            $.post( url, form_data)
                .done(function(response) {
                    if(response.status == "success") {
                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 60,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                '</lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Success !</h4>' +
                                '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 2e3,
                            showConfirmButton: !1
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }else{
                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 60,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                'style="width:120px;height:120px"></lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Oops...! </h4>' +
                                '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 3000,
                            showConfirmButton: !1
                        });
                    }
                })
                .fail(function(response){
                    console.log(response)
                })

            :
            t.dismiss === Swal.DismissReason.cancel &&
            Swal.fire({
                title: "Cancelled",
                text: "FAQ detail was not removed.",
                icon: "error",
                confirmButtonClass: "btn btn-primary mt-2",
                buttonsStyling: !1
            });
    });



})

