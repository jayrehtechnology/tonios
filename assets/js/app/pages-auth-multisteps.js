 const formAuthentication = document.querySelector("#multiStepsForm");
 const submitButton = formAuthentication.querySelector('button[type="submit"]');


document.addEventListener("DOMContentLoaded", function(e) {
    var t;
    formAuthentication && FormValidation.formValidation(formAuthentication, {
        fields: {
            firstname: {
                validators: {
                    notEmpty: {
                        message: "Please enter firstname"
                    }
                }
            },
            lastname: {
                validators: {
                    notEmpty: {
                        message: "Please enter lastname"
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: "Please enter mobile number"
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: "Please enter mobile address"
                    }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        message: "Please enter username"
                    }
                }
            },
         
            email: {
                validators: {
                    notEmpty: {
                        message: "Please enter your email"
                    },
                    emailAddress: {
                        message: "Please enter valid email address"
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: "Please enter your password"
                    }
                }
            },
            "confirm-password": {
                validators: {
                    notEmpty: {
                        message: "Please confirm password"
                    },
                    identical: {
                        compare: function() {
                            return formAuthentication.querySelector('[name="password"]').value
                        },
                        message: "The password and its confirm are not the same"
                    },
                    stringLength: {
                        min: 6,
                        message: "Password must be more than 6 characters"
                    }
                }
            },
            terms: {
                validators: {
                    notEmpty: {
                        message: "Please agree terms & conditions"
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger,
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "",
                rowSelector: ".mb-5"
            }),
            submitButton: new FormValidation.plugins.SubmitButton,
            defaultSubmit: new FormValidation.plugins.DefaultSubmit,
            autoFocus: new FormValidation.plugins.AutoFocus
        }, init: e => {
            e.on("plugins.message.placed", function(e) {
                e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement)
            }).on("core.form.valid", function() {
                submitButton.setAttribute('disabled', true);
                submitButton.innerHTML = 'Processing Registration...';
                formAuthentication.delay(2000).submit();
            });
        }
    })
});


$("#email").keyup(function(){
    var email = $("#email").val();
    var csrf_token_1 = $("#csrf_token_1").val();

    $.ajax({
        type: "POST",
        url:'check-email',
        data : {
                  'email'     :email , 
                  'csrf_token':csrf_token_1
         },
        success: function(data)
        {
            var obj = jQuery.parseJSON(data);

             if(obj.result != 'duplicated'){
                $("#email-duplicate").html("");
                $(".btn-next").prop("disabled",false);
            } else {
               $("#email-duplicate").html("<font color=red><small> * Email Already Registered</small></font>");
               $(".btn-next").prop("disabled",true);
             }
        }
    });
});


$("#username").keyup(function(){
    
    var username = $("#username").val();
    var csrf_token_1 = $("#csrf_token_1").val();

    $.ajax({
        type: "POST",
        url:'check-username',
        data : {
                  'username'     :username , 
                  'csrf_token':csrf_token_1
         },
        success: function(data)
        {
            var obj = jQuery.parseJSON(data);
            
            if(obj.result != 'duplicated'){
                $("#username-duplicate").html("");
                $(".btn-next").prop("disabled",false);
            } else {
               $("#username-duplicate").html("<font color=red><small> * User Name Already Registered</small></font>");
               $(".btn-next").prop("disabled",true);
             }
        }
    });
});