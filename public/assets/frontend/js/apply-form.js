// JavaScript Document
$(document).ready(function() {

    "use strict";

    $(".apply-form").submit(function(e) {
        e.preventDefault();
        var name = $(".name");
        var phone = $(".phone");
        var email = $(".email");
        var address = $(".address");
        var msg = $(".message");
        var attachcv = $(".attachcv");
        var flag = false;

        if (address.val() == "") {
            address.closest(".form-control").addClass("error");
            address.focus();
            flag = false;
            return false;
        } else {
            address.closest(".form-control").removeClass("error").addClass("success");
        }

        if (attachcv.val() == "") {
            attachcv.closest(".form-control").addClass("error");
            attachcv.focus();
            flag = false;
            return false;
        } else {
            attachcv.closest(".form-control").removeClass("error").addClass("success");
        }

        if (name.val() == "") {
            name.closest(".form-control").addClass("error");
            name.focus();
            flag = false;
            return false;
        } else {
            name.closest(".form-control").removeClass("error").addClass("success");
        }

        if (phone.val() == "") {
            phone.closest(".form-control").addClass("error");
            phone.focus();
            flag = false;
            return false;
        } else {
            phone.closest(".form-control").removeClass("error").addClass("success");
        }


        if (email.val() == "") {
            email.closest(".form-control").addClass("error");
            email.focus();
            flag = false;
            return false;
        } else {
            email.closest(".form-control").removeClass("error").addClass("success");
        }
        if (msg.val() == "") {
            msg.closest(".form-control").addClass("error");
            msg.focus();
            flag = false;
            return false;
        } else {
            msg.closest(".form-control").removeClass("error").addClass("success");
            flag = true;
        }
        // var dataString = "name=" + name.val() + "&phone=" + phone.val() + "&email=" + email.val() + "&address=" + address.val() + "&msg=" + msg.val();
        var form = $('#jobform')[0];
        var dataString = new FormData(form);
        $(".loading").fadeIn("slow").html("Loading...");
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            data: dataString,
            url: "/career",
            processData: false, //prevent jQuery from automatically transforming the data into a query string
            contentType: false,
            cache: false,
            success: function(d) {
                $(".form-control").removeClass("success");
                if (d == 'success') { // Message Sent? Show the 'Thank You' message and hide the form
                    $(".name").val(" ");
                    $(".phone").val(" ");
                    $(".email").val(" ");
                    $(".address").val(" ");
                    $(".message").val(" ");
                    $(".attachcv").val(null);
                    $('.loading').fadeIn('slow').html('<font color="#48af4b">Thank you! You have successfully submit your CV.</font>').delay(3000).fadeOut('slow');

                } else {
                    $('.loading').fadeIn('slow').html('<font color="#ff5607">Failed to submit.</font>').delay(3000).fadeOut('slow');
                }
            }
        });
        return false;
    });
    $("#reset").on('click', function() {
        $(".form-control").removeClass("success").removeClass("error");
    });

})