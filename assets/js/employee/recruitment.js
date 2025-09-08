	
    var urllink = UrlLink;

    $(document).ready(function () {
        var url   =  urllink + '/process-table-admin-recruitment';
        var table = $('#recruitment-table').DataTable({
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
        $('#recruitment-table tbody').on( 'click', 'button', function () {
                var action = this.id;
                var data = table.row( $(this).parents('tr') ).data();
    
                if(action == 'modal-recruitment'){
                    $('#update-recruitment').modal('show'); 
                    $(".recruitment_id").val(data[0])
                    $(".date_added").val(data[7])
                    $(".date_of_acceptance").val(data[3])
                    $(".date_hired").val(data[5])
                    $(".hired_name").val(data[7])
                    $(".date_vacated").val(data[2])

                }
        } );
        
     });
    
    
     
     $('#process-reruitment').submit(function(e) {
        $('.btn').prop('disabled', true);
        $('#btn-process').html('');
        $('#btn-process').html('<i class="fa fa-spinner fa-spin"></i> Processing Recruitment Data..');
        e.preventDefault();
    
        var vacant_position	  = $('#vacant_position').val();
        var vacant_date	      = $('#vacant_date').val();
        var csrf_token_1      = $("#csrf_token_1").val();

        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: urllink + '/process-recruitment-data',
                data: {
    
                     'vacant_position'   : vacant_position,
                     'vacant_date'       : vacant_date,
                     'csrf_token'        : csrf_token_1,
                },
                success: function(data) {
    
                 $('#btn-process').html('Success');
                    setTimeout(function() {
    
                       $("#recruitment-table").DataTable().ajax.reload();
                         Swal.fire({
                             icon: "success",
                             title: "Recruitment Data Added",
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

     $('#process-reruitment-update').submit(function(e) {
        $('.btn').prop('disabled', true);
        $('#btn-update').html('');
        $('#btn-update').html('<i class="fa fa-spinner fa-spin"></i> Processing Recruitment Data..');
        e.preventDefault();
    
        var date_of_acceptance	  = $('.date_of_acceptance').val();
        var date_hired	          = $('.date_hired').val();
        var hired_name	          = $('.hired_name').val();
        var recruitment_id	      = $('.recruitment_id').val();
        var date_added            = $('.date_added').val();
        var date_vacated          = $('.date_vacated').val();
        var csrf_token_1          = $("#csrf_token_1").val();

        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: urllink + '/process-recruitment-update-data',
                data: {
    
                     'date_of_acceptance'   : date_of_acceptance,
                     'date_hired'           : date_hired,
                     'hired_name'           : hired_name,
                     'recruitment_id'       : recruitment_id,
                     'date_added'           : date_added,
                     'date_vacated'         : date_vacated,
                     'csrf_token'           : csrf_token_1,
                },
                success: function(data) {
    
                 $('#btn-update').html('Success');
                    setTimeout(function() {
    
                       $("#recruitment-table").DataTable().ajax.reload();
                         Swal.fire({
                             icon: "success",
                             title: "Recruitment Data Updated",
                             text: "Updated!",
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
        