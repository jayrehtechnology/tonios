	
    var urllink = UrlLink;

    $(document).ready(function () {

        var url   =  urllink + '/process-table-admin-appraisal';
        var table = $('#appraisal-table').DataTable({
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
                        "targets": [ 0 ,1],
                        "visible": false,
                        "searchable": false
                    }
                ],
                order: [[0, 'desc']]
        });
        $('#appraisal-table tbody').on( 'click', 'button', function () {
                var action = this.id;
                var data = table.row( $(this).parents('tr') ).data();
    
                if(action == 'view-project-appraisal'){
                    if(data[1] == 0){
                        window.location.href = UrlLink +  "appraisal/view/requirements-gathering/"+data[0];
                    } 
                    if(data[1] == 1){
                        window.location.href = UrlLink +  "appraisal/view/project-proposal-reports/"+data[0];
                    } 
                    if(data[1] == 2){
                        window.location.href = UrlLink +  "appraisal/view/project-proposal-approval/"+data[0];
                    } 
                    if(data[1] == 3){
                        window.location.href = UrlLink +  "appraisal/view/project-proposal-approved/"+data[0];
                    } 
                }
                if(action == 'view-project-appraisal-report'){
                    window.location.href = UrlLink +  "appraisal/reports/"+data[0];
                }
        } );
        
     });
    
    
     
     $('#process-appraisal').submit(function(e) {
        $('.btn').prop('disabled', true);
        $('#btn-process').html('');
        $('#btn-process').html('<i class="fa fa-spinner fa-spin"></i> Processing Project Appraisal..');
        e.preventDefault();
    
        var employee_id		     = $('#employee_id').val();
        var project_name	     = $('#project_name').val();
        var project_description	 = $('#project_description').val();
        var csrf_token_1         = $("#csrf_token_1").val();
        
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: urllink + '/process-project-appraisal-data',
                data: {
                     'employee_id'          : employee_id,
                     'project_name'         : project_name,
                     'project_description'  : project_description,
                     'csrf_token'           : csrf_token_1,
                },
                success: function(data) {
    
                 $('#btn-process').html('Success');
                    setTimeout(function() {
                       $("#appraisal-table").DataTable().ajax.reload();
                         Swal.fire({
                             icon: "success",
                             title: "Project Appraisal Added",
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

      
     $('.process_appraisal_stop').submit(function(e) {

        e.preventDefault();

        $('.btn').prop('disabled', true);

        //$('#process_submit').html('');
        $('.process_submit').html('<i class="fa fa-spinner fa-spin"></i> Pausing Turn Arround Time ..  ');

    
        var id                   = $(this).data("id");
        var employee_id		     = $('.employee_id' + id).val();
        var appraisal_id	     = $('.appraisal_id' + id).val();
        var time_tracker	     = $('.time_tracker' + id).val();
        var reason	             = $('#reason'  + id).val();
        var csrf_token_1         = $("#csrf_token_1").val();
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: urllink + '/process-tat-stop',
                data: {
                     'employee_id'          : employee_id,
                     'appraisal_id'         : appraisal_id,
                     'reason'               : reason,
                     'time_tracker'         : time_tracker,
                     'csrf_token'           : csrf_token_1,
                },
                success: function(data) {
    
                 $('#process_submit').html('Success');
                    setTimeout(function() {
                         Swal.fire({
                             icon: "success",
                             title: "Project Appraisal Paused",
                             text: "Paused!",
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
        

