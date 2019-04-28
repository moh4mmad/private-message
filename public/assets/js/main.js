
(function ($) {
    "use strict";

    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
	
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(event){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
		
	   if(check){
		
	   var request;
	   
	   event.preventDefault();
	   $("#loading").show();
	   if (request) {
        request.abort();
		}
		
		var $form = $(this);
		var $inputs = $form.find("input, select, button, textarea");

		$.ajax({
        url: submit,
        type: "post",
        data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data, statusText, resObject) {
						$("#loading").hide();
						$inputs.prop("disabled", true);
						$("#submit").hide();
						$("#show_result").show();
						$('#result').modal('show');
						var mdl = $('#result');
						var url = resObject.responseJSON.message.message;
						$('#result .modal-body').empty();
						mdl.find('.modal-body').append("<p class=\"text-primary\"> Share this link to access into the secret message <br><a href=\""+ url +"\">"+ url +"</a></p>");
					},
					error: function (xhr) {
						$("#loading").hide();
						$.each(xhr.responseJSON.errors, function(key,value) {
							grecaptcha.reset();
							$.notify(value, "info");
							});
							}
		});
		
	}
        return check;
    });


	
	
	$('#password_verification').on('submit',function(event){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
		
	   if(check){
		
	   var request;
	   
	   event.preventDefault();
	   $("#loading").show();
	   if (request) {
        request.abort();
		}
		
		var $form = $(this);
		var $inputs = $form.find("input, select, button, textarea");

		$.ajax({
        url: passwordverification,
        type: "post",
        data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data) {
						$("#loading").hide();
						$inputs.prop("disabled", true);
						$.notify("Please wait...", "info");
						$.notify("Password varified", "success");
						setTimeout(location.reload.bind(location), 5000);
					},
					error: function (xhr) {
						$("#loading").hide();
						$.each(xhr.responseJSON.errors, function(key,value) {
							grecaptcha.reset();
							$.notify(value, "info");
							});
							}
		});
		
	}
        return check;
    });
	
	
	 $('#password_verification').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

	
	
	
    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
      
	  $(":checkbox").change(function () {
            var id = $(this).attr("name");
            var ischedked = $(this).is(":checked");

            if (id == "use_password" && ischedked) {
				
				//$("#use_password").removeAttr("style");
				$("#use_password").attr("style","border-bottom:1px solid #b2b2b2;");
                $('#use_password').append
		       (
						'<span class="label-input100">Password:</span>' +
							'<input class="input100" type="text" name="password" placeholder="Enter password">'+
								'<span class="focus-input100"></span>'
					);
            }
			
			if (id == "use_password" && !ischedked)
			{
				 $('#use_password').empty();
				 $("#use_password").attr("style","border-bottom:none;");
			}
			
			if (id == "ip_restriction" && ischedked) {
				
				$("#ip_restriction").attr("style","border-bottom:1px solid #b2b2b2;");
                $('#ip_restriction').append
		       (
						'<span class="label-input100">IP Address:</span>' +
							'<textarea class="input100" name="ips" placeholder="128.11.10.1\n128.11.10.2"></textarea>'+
								'<span class="focus-input100"></span>'
					);
            }
			if (id == "ip_restriction" && !ischedked)
			{
				 $('#ip_restriction').empty();
				 $("#ip_restriction").attr("style","border-bottom:none;");
			}
			
			if (id == "file_attach" && ischedked) {
				
				$("#file_attach").attr("style","margin-top: 14px; margin-bottom: 14px;");
                $('#file_attach').append
		       (
						'<div class="custom-file">' +
							'<input type="file" name="attachment" class="custom-file-input">'+
								'<label class="custom-file-label" style="width: 50%" for="inputGroupFile01">Choose file</label>'+
								'</div>'
					);
            }
			if (id == "file_attach" && !ischedked)
			{
				 $('#file_attach').empty();
				 $("#file_attach").attr("style","border-bottom:none;");
			}
        });
})(jQuery);

jQuery('#datetimepicker').datetimepicker({format:'Y-m-d h:m:s'});