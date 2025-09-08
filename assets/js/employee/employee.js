	
    var urllink = UrlLink;

    $(document).ready(function () {
        var url   =  urllink + '/process-table-admin-employee';
        var table = $('#employee-table').DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            'ajax': {
            'url': url,
            'data': function (d) {
                d.csrf_test_name = _CSRF_NAME_;
                return JSON.stringify( d );
            },
            "dataSrc": function (json) {
            return json.data;
                }
            }, "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ] 
        });
        $('#employee-table tbody').on( 'click', 'button', function () {
                var action = this.id;
                var data = table.row( $(this).parents('tr') ).data();
    
                if(action == 'view-employee'){
                    window.location.href = UrlLink +  "employee/view/"+data[0];
                }
                if(action == 'remove-employee'){
                    $('#delete-employee').modal('show'); 
                    $(".employee_id").val(data[0]);
                }
                if(action == 'activate-employee'){
                    $('#activates-employee').modal('show'); 
                    $(".employee_id").val(data[0]);
                }
        } );
        
     });
    
    
     
     $('#process-employee').submit(function(e) {
        $('.btn').prop('disabled', true);
        $('#btn-process').html('');
        $('#btn-process').html('<i class="fa fa-spinner fa-spin"></i> Processing Employee Record..');
        e.preventDefault();
    
        var employee_id		  = $('#employee_id').val();
        var employee_fname	  = $('#employee_fname').val();
        var employee_lname	  = $('#employee_lname').val();
        var employee_contact  = $('#employee_contact').val();
        var employee_email	  = $('#employee_email').val();
        var employee_position = $('#employee_position').val();
        var employee_units	  = $('#employee_units').val();
        var employee_roles	  = $('#employee_roles').val();
        //var username	      = $('#username').val();
        var password	      = $('#password').val();
        var csrf_token_1      = $("#csrf_token_1").val();
        
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: urllink + '/process-employee-data',
                data: {
    
                     'employee_id'       : employee_id,
                     'employee_fname'    : employee_fname,
                     'employee_lname'    : employee_lname,
                     'employee_contact'  : employee_contact,
                     'employee_email'    : employee_email,
                     'employee_position' : employee_position,
                     'employee_units'    : employee_units,
                     'employee_roles'    : employee_roles,
                     'username'          : '',
                     'password'          : password,
                     'csrf_token'        : csrf_token_1,
                },
                success: function(data) {
    
                 $('#btn-process').html('Success');
                    setTimeout(function() {
    
                       $("#employee-table").DataTable().ajax.reload();
                         Swal.fire({
                             icon: "success",
                             title: "Employee Data Added",
                             text: "Added!",
                             customClass: {
                                 confirmButton: "btn btn-primary waves-effect waves-light"
                             },
                             buttonsStyling: !1
                         })
                         setTimeout(function() {  window.location.reload(); }, 2000);
                    
                    }, 1000);
                }
    
            });
        }, 3000);
           
     });
        

     $('.remove-employee').submit(function(e) {

        $('.btn').prop('disabled', true);
    
         var employee_id      = $('.employee_id').val();
         var csrf_token_1      = $('#csrf_token_1').val();

            e.preventDefault();
                setTimeout(function() {
                $.ajax({
                   type: "POST",
                   url:UrlLink+'post-remove-employee',
                   data : {
                             'id'         : employee_id, 
                             'csrf_token' : csrf_token_1,

                    },
                   success: function(data)
                   {
                    if(data == '1'){
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Employee Deactivated!",
                            customClass: {
                                confirmButton: "btn btn-primary waves-effect waves-light"
                            },
                            buttonsStyling: !1
                        })
                       setTimeout(function() {  window.location.reload(); }, 2000);
                       
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Process Error!",
                            text: "Please try again",
                            customClass: {
                                confirmButton: "btn btn-primary waves-effect waves-light"
                            },
                            buttonsStyling: !1
                        })
                        setTimeout(function() {  window.location.reload(); }, 2000);
                    }
                    
                   }
               });
            }, 3000);
       
    }); 

    $('.activate-employee').submit(function(e) {

        $('.btn').prop('disabled', true);
    
         var employee_id      = $('.employee_id').val();
         var csrf_token_1      = $('#csrf_token_1').val();

            e.preventDefault();
                setTimeout(function() {
                $.ajax({
                   type: "POST",
                   url:UrlLink+'post-activate-employee',
                   data : {
                             'id'         : employee_id, 
                             'csrf_token' : csrf_token_1,

                    },
                   success: function(data)
                   {
                    if(data == '1'){
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Employee Activated!",
                            customClass: {
                                confirmButton: "btn btn-primary waves-effect waves-light"
                            },
                            buttonsStyling: !1
                        })
                       setTimeout(function() {  window.location.reload(); }, 2000);
                       
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Process Error!",
                            text: "Please try again",
                            customClass: {
                                confirmButton: "btn btn-primary waves-effect waves-light"
                            },
                            buttonsStyling: !1
                        })
                        setTimeout(function() {  window.location.reload(); }, 2000);
                    }
                    
                   }
               });
            }, 3000);
       
    }); 

    $("#employee_email").on('keyup', function(){   

        var employee_email  = $("#employee_email").val();
        var csrf_token_1    = $("#csrf_token_1").val();
   
        $.ajax({
            type: "POST",
            url: urllink + '/get-employee-employee-email',
            dataType: 'json',
            data: {
                 'email'             : employee_email,
                 'csrf_token'        : csrf_token_1,
            },
            success: function(data) {
                if(data == '0'){
                   $("#email-duplicate").html("");
                   $("#btn-process").prop("disabled",false);
                } else {
                    $("#email-duplicate").html("<p style='color:red'> <b> Email Already Exist </b></p>");
                    $("#btn-process").prop("disabled",true);
                }
               
            }
    
        });
       
    
    });
    
