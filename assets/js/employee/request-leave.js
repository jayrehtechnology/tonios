var urllink = UrlLink;


$(document).ready(function () {
    var url   =  urllink + '/process-table-admin-leave-request';
    var table = $('#leave-table').DataTable({
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
                $(".date_of_acceptance").val(data[3])
                $(".date_hired").val(data[4])
                $(".hired_name").val(data[5])

            }
    } );
    
 });


$("#date_to").on('change', function(){    // 2nd way

    var date_from =  $("#date_from").val();
    var date_to = this.value;

    var start = new Date(date_from);
    var end = new Date(date_to);

    var diffDate = (end - start) / (1000 * 60 * 60 * 24);
    var days = Math.round(diffDate);

    if(days == 0){
        var d = 1;
    } else {
        var d = days + 1
    }

    $("#display_days").html("<b>Total Requesting Days : " + d + "</b><hr>");
    $("#days").val(days);
});

$("#leave").on('change', function(){   

    var leave        = $("#leave").val();
    var days         = $("#days").val();

    var employee_id  = $("#employee_id").val();
    var csrf_token_1 = $("#csrf_token_1").val();

    if(leave == 4){
        $("#sick-leave").show();
        if(days == 0) {
            $('#attach').prop('required',false);
        } else {
            $('#attach').prop('required',true);
        }

    } else { 

    
            $('#attach').prop('required',true);

        $("#sick-leave").hide();

    }

    $.ajax({
        type: "POST",
        url: urllink + '/get-employee-leave-credits',
        dataType: 'json',
        data: {
             'leave'             : leave,
             'employee_id'       : employee_id,
             'csrf_token'        : csrf_token_1,
        },
        success: function(data) {
            if(data['result'] == ''){
                $("#displayerror").html("<font color=red><b>Sorry! We cannot process your request,No Leave Credits on this Leave Category</font>");
                $("#btn-process").prop('disabled',true);
            }
            $.each(data['result'], function(index, credits) {

                $("#display_credits").html("<b>Total Credits Remaining : " +  credits.credits + "</b><hr>");
                $("#credits").val(credits.credits);

                var days =  $("#days").val();

                
                if(parseInt(days) > parseInt(credits.credits)){
                    $("#displayerror").html("<font color=red><b>Sorry! We cannot process your request, your Leave Credits is not applicable to your requesting days!</font>");
                    $("#btn-process").prop('disabled',true);
                }
               
                else {
                    $("#displayerror").html("");
                    $("#btn-process").prop('disabled',false);
                }
             
            });

        }

    });
   

});


$('#process-leave-request').submit(function(e) {
    $('.btn').prop('disabled', true);
    $('#btn-process').html('');
    $('#btn-process').html('<i class="fa fa-spinner fa-spin"></i> Processing Leave Request..');
    e.preventDefault();
    var file          = $('#attach').prop('files')[0];   
    var employee_id	  = $('#employee_id').val();
    var date_from	  = $('#date_from').val();
    var date_to	      = $('#date_to').val();
    var days	      = $('#days').val();
    var leave	      = $('#leave').val();
    var reason	      = $('#reason').val();
    var csrf_token_1  = $("#csrf_token_1").val();

    var form_data = new FormData(document.getElementById("process-leave-request"));


    setTimeout(function() {
        $.ajax({
            type: "POST",
            url: urllink + '/process-leave-request',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {

             $('#btn-process').html('Success');
                setTimeout(function() {

                   $("#leave-table").DataTable().ajax.reload();
                     Swal.fire({
                         icon: "success",
                         title: "Leave Request Submitted!",
                         text: "Submitted!",
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

}
);
       