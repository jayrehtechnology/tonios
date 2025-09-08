	
    var urllink = UrlLink;

    $(document).ready(function () {
        var url   =  urllink + '/process-table-admin-appraisal-reports';
        var table = $('#project-appraisal-table').DataTable({
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
        $('#project-appraisal-table tbody').on( 'click', 'button', function () {
                var action = this.id;
                var data = table.row( $(this).parents('tr') ).data();
    
                if(action == 'project-appraisal-report'){
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
        