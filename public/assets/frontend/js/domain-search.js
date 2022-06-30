// JavaScript Document
$(document).ready(function() {

    "use strict";
    
    $(".domain-form").submit(function(e) {
        e.preventDefault();
        var domain = $(".domain");
        var flag = false;
        if (domain.val() == "") {
            domain.closest(".form-control").addClass("error");
            domain.focus();
            flag = false;
            return false;
        } else {
            domain.closest(".form-control").removeClass("error").addClass("success");
            flag = true;
        }
        var dataString = "&domain=" + domain.val();
        $(".loading").fadeIn("slow").html("Loading...");
        $.ajax({
            type: "POST",
            data: dataString,
            url: "/check-domain",
            cache: false,
            success: function (d) {
                $(".form-control").removeClass("success");
					if(d.confirmed == 'success'){ // Message Sent? Show the 'Thank You' message and hide the form
                        $(".name").val(" ");	
                        $('.loading').fadeIn('slow').html('<font color="#48af4b">'+d.message+'</font></br>');
                        $(".suggestion-title").css("display", "inline-block");
                        // console.log(d.suggestions);
                        
                        // $('.suggestions').fadeIn('slow').html('<font color="#48af4b">'+d.message+'</font>');
                        
                        $.each(d.suggestions, function(index, value){
                            $("#suggestions").append('<span class="suggest-list-domain">'+value+'</span>');
                          
                        });
                    }else{
                          $(".suggestion-title").css("display", "none");
                           $("#suggestions").css("display", "none");
                          
						$('.loading').fadeIn('slow').html('<font color="#ff5607">'+d.message+'</font>');
                    }
				}
        });
        return false;
    });
    $("#reset").on('click', function() {
        $(".form-control").removeClass("success").removeClass("error");
    });
})





