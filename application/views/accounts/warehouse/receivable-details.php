

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
                                            <h4> <?= $_GET['batch_no'];?>   </h4>
                                            <h5> <a href="receivable"> <i class="mdi mdi-chevron-left-circle-outline"> </i> Back </a></h5>
										</div>
									</div><!-- end col-->
                                 
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
                                        <h4 class="card-title text-white mb-0"><?= $_GET['batch_no'];?> Receivable List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row">
                                           <div class="col-sm-12">
                                           <div class="table-responsive">
                                            <table id="table-order" class="table dt-responsive  dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Product </th>
                                                    <th class="text-center"> Receivable Quantity </th>
                                                    <th class="text-center"> Received Quantity </th>
                                                    <th class="text-center"> Status </th>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Warehouse'){?> 
                                                    <th class="text-center"> Action </th>
                                                    <?php } ?>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                                foreach($products as $i){


                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= $i->quantity;?></td>
                                                    <td class="text-center"> <?= $i->received_quantity;?></td>
                                                    <td class="text-center"> <?= $i->is_complete;?></td>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Warehouse'){?> 
                                                     <td class="text-center"><button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#process<?= $i->id;?>"> Process </button></td>
                                                    <?php } ?>
                                                  </tr>
                                                <div class="modal fade" id="process<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"> Receive Product</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                              <form method="POST" id="update_process" action="<?= base_url("warehouse/process-receive-product");?>"  enctype="multipart/form-data">
                                                                                    <div class="col-lg-12">
                                                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                    <input type="hidden" name="id"  value="<?php echo $i->id; ?>">
                                                                                    <input type="hidden" name="batch_no" value="<?php echo $_GET['batch_no']; ?>">

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Product Name </label>
                                                                                        <input type="text" name="product" class="form-control" value="<?= $i->product_name;?>" readonly>
                                                                                        <input type="hidden" name="product_id" class="form-control" value="<?= $i->product_id;?>" readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Receive Quantity </label>
                                                                                        <input type="number" name="received_quantity" class="form-control quantity" max="<?= $i->quantity - $i->received_quantity;?>" oninput="checkMaxValue(this,<?= $i->quantity;?>)" required>
                                                                                    </div>

                                                                                    <div class="mb-3">

                                                                                        <label for="simpleinput" class="form-label">Status </label>

                                                                                        <select type="text" name="status" class="form-control receive_status" id="" required>
                                                                                            <option value=""> - Select Status - </option>
                                                                                            <option value="Complete"> Complete </option>
                                                                                            <option value="In-complete"> In-complete </option>
                                                                                        </select>


                                                                                    </div> <!-- end col -->

                                                                                    <div class="mb-3 incomplete" id="" style="display:none;">
                                                                                        <label for="simpleinput" class="form-label">In-complete Reason</label>
                                                                                        <textarea name="reason" class="form-control " > </textarea>
                                                                                    </div>
                                                                                </div>     
                                                                                </div>                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_update">Process</button>
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
    
   
    <script>
        $(document).ready(function() {
            $("#update_process").submit(function() {
                $("#btn_update").prop("disabled", true).text("Processing...");
            });
        });
    </script>

    <script>
    function checkMaxValue(input,qty) {
        if (input.value > qty) {
        input.value = qty; // Set value back to 5 if it exceeds the max value
        }
    }
    </script>

    <script>
    $(document).ready(function() {
        // Listen for the change event on the select element
        $('.receive_status').change(function() {
            // Get the selected value
            var selectedValue = $(this).val();
            if(selectedValue == 'In-complete'){
                $(".incomplete").show();
            } else {
                $(".incomplete").hide();
            }
        });
    });
</script>

