// JavaScript Document
$(document).ready(function() {

    "use strict";

    $(".request-quote").submit(function(e) {
        e.preventDefault();
        var name = $(".name");
        var phone = $(".phone");
        var email = $(".email");
        var service = $(".service_id");
        var msg = $(".message");
        var flag = false;

        if (service.val() == "") {
            service.closest(".form-control").addClass("error");
            service.focus();
            flag = false;
            return false;
        } else {
            service.closest(".form-control").removeClass("error").addClass("success");
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
        var dataString = "name=" + name.val() + "&phone=" + phone.val() + "&email=" + email.val() + "&service_id=" + service.val() + "&msg=" + msg.val();
        $(".loading").fadeIn("slow").html("Loading...");
        $.ajax({
            type: "POST",
            data: dataString,
            url: "/request-quote",
            cache: false,
            success: function(d) {
                $(".form-control").removeClass("success");
                if (d == 'success') { // Message Sent? Show the 'Thank You' message and hide the form
                    $(".name").val(" ");
                    $(".phone").val(" ");
                    $(".email").val(" ");
                    $(".service_id").val(" ");
                    $(".message").val(" ");
                    $('.loading').fadeIn('slow').html('<font color="#48af4b">Mail sent Successfully.</font>').delay(3000).fadeOut('slow');

                } else {
                    $('.loading').fadeIn('slow').html('<font color="#ff5607">Mail not sent.</font>').delay(3000).fadeOut('slow');
                }
            }
        });
        return false;
    });
    $("#reset").on('click', function() {
        $(".form-control").removeClass("success").removeClass("error");
    });

})
