$('#formAuthentication').submit(function(e) {
	$('#toastr-login').trigger('click');
	$('#content').hide();
	$('.btn').prop('disabled', true);
	 var username     = $('#username').val();
	 var password     = $('#password').val();
     var csrf_token_1 = $("#csrf_token_1").val();
            e.preventDefault();
			setTimeout(function() {
			$.ajax({
			   type: "POST",
			   url:'authentication',
			   data : {
						 'username'     : username, 
						 'password'     : password,
                         'csrf_token'   :csrf_token_1,
				},
			   success: function(data)
			   {

                    var obj = jQuery.parseJSON(data);
				    if(obj.result == 'user'){
                        Swal.fire({
                            icon: "success",
                            title: "Login Success!",
                            text: "Welcome to your account",
                            customClass: {
                                confirmButton: "btn btn-primary waves-effect waves-light"
                            },
                            buttonsStyling: !1
                        })
						setTimeout(function() {  window.location.href = "dashboard";}, 2000);
				    } else {
						Swal.fire({
                            icon: "error",
                            title: "Login Error!",
                            text: "Please try again!",
                            customClass: {
                                confirmButton: "btn btn-danger waves-effect waves-light"
                            },
                            buttonsStyling: !1
                        })
						$('.btn').prop('disabled', false);
					}
			   }
		   });
		}, 3000);
   
}); 