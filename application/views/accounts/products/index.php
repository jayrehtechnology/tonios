
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
                                            <h5> Products Records </h5>
										</div>
									</div><!-- end col-->
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Product    </button>                       
                                    </div>
                                 
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                                <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-primary"><?= $this->session->flashdata('success'); ?></div>
                                <?php endif; ?>
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Products List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">  </th>
                                                    <th class="text-center"> Amount </th>
                                                    <th class="text-center"> Product Name </th>
                                                    <th class="text-center"> Description</th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($products as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <img src='<?= base_url();?>assets/products/<?= $i->image;?>' width="200px;"></td>
                                                    <td class="text-center"> <?= $i->amount;?></td>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= $i->description;?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $i->id;?>"> Udpate </button>                       
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Delete </button>                       
                                                    </td>
                                                </tr>
                                                
                                                <div class="modal fade" id="update<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Product Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                              <form method="POST" action="<?= base_url("products/update-products");?>"  enctype="multipart/form-data" class="process_update">
                                                                                    <div class="col-lg-12">
                                                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                    <input type="hidden" name="id"  value="<?php echo $i->id; ?>">
                                                                                    <input type="hidden" name="file1"  value="<?php echo $i->image; ?>">

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Product Name </label>
                                                                                        <input type="text" name="product" class="form-control" value="<?= $i->product_name;?>" required>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="example-email" class="form-label"> Price</label>
                                                                                        <input type="text" placeholder="" name="amount" value="<?= $i->amount;?>" class="form-control " value="" fdprocessedid="26svpg">
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="example-email" class="form-label">Description</label>
                                                                                        <textarea type="text" name="description"  class="form-control" required><?= $i->description;?></textarea>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="example-email" class="form-label"> Image</label>
                                                                                        <input type="file" name="file" class="form-control" accept="image/x-png,image/jpeg">
                                                                                    </div>

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_update" >Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                              

                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Product Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("products/delete-products");?>" class="process_delete">
                                                                                        Are you sure to delete this data ?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_delete">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                            
                                             <?php } ?>
                                             </tbody>
                                             </table>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                 <form action="<?= base_url("products/process-products");?>" method="POST"  enctype="multipart/form-data" id="process_add">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Product Name </label>
                                                        <input type="text" name="product" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label"> Price</label>
                                                        <input type="text" placeholder="" name="amount" class="form-control" value="" fdprocessedid="26svpg">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Description</label>
                                                        <textarea type="text" name="description"  class="form-control" required></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label"> Image</label>
                                                        <input type="file" name="file" class="form-control" accept="image/x-png,image/jpeg" required>
                                                    </div>
                                              
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_add">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>
        

        <script>
            $(document).ready(function() {

                $("#process_add").submit(function() {
                    $("#btn_add").prop("disabled", true).text("Processing...");
                });

                $(".process_update").submit(function() {
                    $(".btn_update").prop("disabled", true).text("Updating...");
                });

                $(".process_delete").submit(function() {
                    $(".btn_delete").prop("disabled", true).text("Deleting...");
                });

            });
        </script>
  