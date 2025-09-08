
<div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                         <!-- start page title -->
                         <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
									<div class="col-lg-10 col-md-12 col-sm-12">
										<div class="">
                                            <h5> Production Planning Control  </h5>
										</div>
									</div><!-- end col-->
                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                      <button class="btn btn-outline-dark waves-effect waves-light" style="width:100%"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Category Data </button>                       
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Category</h4>
                                        <hr>

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <div class="row">
                                            <div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Category </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($category as $c){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $c->category;?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $c->id;?>"> Udpate </button>                       
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $c->id;?>"> Delete </button>                       
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="update<?= $c->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("production/update-production-inventory-category");?>">
                                                                                            <div class="mb-3">
                                                                                                <label for="simpleinput" class="form-label">Name</label>
                                                                                                <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                                <input type="text" name="category" class="form-control" value="<?= $c->category;?>">
                                                                                                <input type="hidden" name="id" class="form-control" value="<?= $c->id;?>">

                                                                                            </div>
                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade" id="delete<?= $c->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("production/delete-production-inventory-category");?>">
                                                                                        Are you sure to delete this data ?   
                                                                                    
                                                                                                <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                                <input type="hidden" name="id" class="form-control" value="<?= $c->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                            
                                             <?php } ?>
                                             </tbody>
                                             </table>
                                         </div>
                                        </div>
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

         
        </div>
    
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">
                                                <form id="process-submit">
                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Name</label>
                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                        <input type="text" id="category" class="form-control" >
                                                    </div>
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>



        <script>
          

            $('#process-submit').submit(function(e) {
                $('.btn').prop('disabled', true);
                $('#btn-process').html('');
                $('#btn-process').html('<i class="fa fa-spinner fa-spin"></i> Processing ..');
                e.preventDefault();
            
                var category	  = $('#category').val();
                var csrf_token_1  = $("#csrf_token_1").val();

                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        url:  'process-production-inventory-category',
                        data: {
                            'category'   : category,
                            'csrf_token' : csrf_token_1,
                        },
                        success: function(data) {
                            $('#btn-process').html('Success');
                            setTimeout(function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Category Data Added",
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
        
        </script>