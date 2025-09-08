$('#formAuthentication').submit(function(e) {
	$('#toastr-login').trigger('click');
	$('#content').hide();
	$('.btn').prop('disabled', true);
	 var username     = $('#username').val();
	 var password     = $('#password').val();
		e.preventDefault();
			setTimeout(function() {
			$.ajax({
			   type: "POST",
			   url:'http://localhost/logistics/authentication',
			   data : {
						 'username'     : username, 
						 'password'     : password,
				},
			   success: function(data)
			   {
				    if(data =='user'){
                        Swal.fire({
                            icon: "success",
                            title: "Login Success!",
                            text: "Welcome to your account",
                            customClass: {
                                confirmButton: "btn btn-primary waves-effect waves-light"
                            },
                            buttonsStyling: !1
                        })
						setTimeout(function() {  window.location.href = "accounts";}, 2000);
				    } else if(data =='admin'){
						$(".iziToast-wrapper").show();
						$('#success-login').trigger('click');
						setTimeout(function() {window.location.href = "administrator/index"; }, 1000);
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
				   }
			   }
		   });
		}, 3000);
   
}); 