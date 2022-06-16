$(document).on('click','#change-theme-mode', function (e) {
    e.preventDefault();
    var mode = $('html').attr('data-layout-mode');
    var formData = new FormData();
    formData.append('setting_id', set_id);
    formData.append('mode', mode);
    var url = "/auth/dashboard-settings/theme-mode/"
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
            if(response.status=='success') {
            }

        }, error: function(response) {
            console.log(response);
        }
    });
});
function sendMarkRequest(id = null, name = null) {
    return $.ajax("/auth/mark-as-read", {
        method: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        data: {
            id,
            name
        }
    });
}
$(function() {
    $('.mark-as-read').click(function() {
        var id      = $(this).data('id');
        var type    = $(this).data('name');
        var value   = $(this).data('type');
        let request = sendMarkRequest(id,value);
        var div     = '#notification-'+type+id;
        var mark    = '#all-read-'+type;
        var count_type = '#'+type+'-count';
        var holder = '#main-'+type+'-holder';

        request
            .done(function(response) {
                console.log(response);
                $("#top-unread").html('');
                $("#top-unread").append(response.unread+'<span class="visually-hidden">unread messages</span>');
                $("#new-unread").html('');
                if(type == 'service'){
                    $(count_type).html('');
                    $(count_type).append('Service (' + response.service_num +')');
                }else if(type == 'career'){
                    $(count_type).html('');
                    $(count_type).append('Career (' + response.career_num +')');
                }
                $("#new-unread").append(response.unread+' New');
                $(div).remove();
                if(response.service_num == 0 || response.career_num == 0){
                    $(mark).remove();
                    var replacement = '  <div class="w-25 w-sm-50 pt-3 mx-auto">' +
                        '<img src="/assets/backend/images/svg/bell.svg" class="img-fluid" alt="user-pic">' +
                        '</div>' +
                        '<div class="text-center pb-5 mt-2">'+
                        '<h6 class="fs-18 fw-semibold lh-base">Hey! You have no '+type+' notifications </h6>'+
                        '</div>';
                    $(holder).append(replacement);
                }
            })
            .fail(function(response){
                console.log(response)
            });
    });

    $('.mark-all').click(function() {

        var name       = $(this).data('name');
        var type       = $(this).data('id');
        let request    = sendMarkRequest(null,name);
        var mark       = '#all-read-'+type;
        var holder     = '#main-'+type+'-holder';
        var container  = 'div.notify-item-'+type;
        var count_type = '#'+type+'-count';

        request
            .done(function(response) {
                console.log(response);
                var unread = (response.service_num + response.career_num);
                $("#top-unread").html('');
                $("#top-unread").append(unread +' <span class="visually-hidden">unread messages</span>');
                $("#new-unread").html('');
                if(type == 'service'){
                    $(count_type).html('');
                    $(count_type).append('Service (' + response.service_num +')');
                }else if(type == 'career'){
                    $(count_type).html('');
                    $(count_type).append('Career (' + response.career_num +')');
                }
                $("#new-unread").append(unread+' New');
                $(container).remove();
                $(mark).remove();
                var replacement = '  <div class="w-25 w-sm-50 pt-3 mx-auto">' +
                    '<img src="/assets/backend/images/svg/bell.svg" class="img-fluid" alt="user-pic">' +
                    '</div>' +
                    '<div class="text-center pb-5 mt-2">'+
                    '<h6 class="fs-18 fw-semibold lh-base">Hey! You have no '+type+' notifications </h6>'+
                    '</div>';
                $(holder).append(replacement);
            })
    });
});
