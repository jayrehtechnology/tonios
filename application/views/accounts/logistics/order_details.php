
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>

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
                                            <h5> <?= $_GET['customer'];?>  Orders </h5>
                                            <h5> <a href="delivery"> <i class="mdi mdi-chevron-left-circle-outline"> </i> Back </a></h5>

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
                                        <h4 class="card-title text-white mb-0"><?= $_GET['transaction'];?> Order List</h4>
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
                                                    <th class="text-center"> Quantity </th>
                                                    <th class="text-center"> Quantity Delivered</th>
                                                    <th class="text-center"> Quantity Returned</th>
                                                    <th class="text-center"> Total </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $totaldelivered = 0;
                                                $totalreturned  = 0;
                                                $totalearned    = 0;

                                                foreach($orders_list as $i){ 
                                                
                                                $totaldelivered +=$i->delivered_quantity;
                                                $totalreturned  +=$i->total_return;
                                                $totalearned    +=$i->delivered_quantity * $i->price;

                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= $i->process_quantity;?></td>
                                                    <td class="text-center"> <?= $i->delivered_quantity?></td>
                                                    <td class="text-center"> <?= $i->total_return;?> 
                                                    
                                                        <?php if($i->total_return !=0){?>
                                                            -  <a href="#"   data-bs-toggle="modal" data-bs-target="#reason<?= $i->id;?>"> Reason </a>
                                                        <?php } ?>
                                                
                                                    </td>

                                                    <td class="text-center"> <?= number_format($i->delivered_quantity * $i->price,2);?></td>
                                                    <td class="text-center">

                                                       <?php 
                                                       
                                                       if($i->is_delivered_complete == 1){

                                                            echo "Completed Delivery";

                                                       }

                                                       if($i->is_delivered_complete == 2){

                                                         echo "Delivered with Return";

                                                      }

                                                      if($i->is_delivered_complete == 0){
                                                       ?>

                                                     

                                                       <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#complete<?= $i->id;?>"> Complete  </button>                       
                                                       <button class="btn btn-outline-warning waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#return<?= $i->id;?>">  Return </a>                       
                                                     
                                                       <?php } ?>
                                                    </td>



                                                </tr>
                                                
                                                <div class="modal fade" id="complete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Order Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form method="POST" action="<?= base_url("logistics/process-delivery-completed");?>" class="process_order">
                                                                                        Are you sure to tag this product <b> <?= $i->product_name;?> - <?= $i->process_quantity;?> </b> completed?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">
                                                                                        <input type="hidden" name="transaction" class="form-control" value="<?= $_GET['transaction'];?>">
                                                                                        <input type="hidden" name="customer" class="form-control" value="<?= $_GET['customer'];?>">
                                                                                        <input type="hidden" name="quantity" class="form-control" value=" <?= $i->process_quantity;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_process">Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade" id="reason<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Order Transaction - <?= $i->trans_code;?> - Return Reason</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <?= $i->return_reason;?>
                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                    </div>
                                                </div>
                                                </div>


                                                <div class="modal fade" id="return<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Order Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form method="POST" action="<?= base_url("logistics/process-delivery-return");?>" class="process_order">
                                                                                     Product Name : <?= $i->product_name;?>  <br>
                                                                                     For Delivery Quantity : <?= $i->process_quantity;?>  <br>
                                                                                     <br>
                                                                                     <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Total Return</label>
                                                                                        <input type="text" name="total_return" class="form-control"   oninput="checkMaxValue(this,<?= $i->process_quantity;?>)"  required>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label"> Return Reason</label>
                                                                                        <textarea name="return_reason" class="form-control"  required></textarea>
                                                                                    </div>

                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">
                                                                                        <input type="hidden" name="transaction" class="form-control" value="<?= $_GET['transaction'];?>">
                                                                                        <input type="hidden" name="customer" class="form-control" value="<?= $_GET['customer'];?>">
                                                                                        <input type="hidden" name="quantity" class="form-control" value=" <?= $i->process_quantity;?>">
                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_process">Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>


                                                
                                             <?php } ?>
                                             <tfoot>
                                             <tr>
                                                    <th class="text-center">  </th>
                                                    <th class="text-center"> </th>
                                                    <th class="text-center">  Total Delivered Quantity : <h4> <?= $totaldelivered; ?></h4></th>
                                                    <th class="text-center">  Total Returned Quantity : <h4><?= $totalreturned; ?></h4></th>
                                                    <th class="text-center"> <h4><?=  number_format($totalearned,2);?></h4> </th>
                                                    <th class="text-center">  </th>

                                                </tr>
                                            </tfoot>
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

            $(".process_order").submit(function() {
                $(".btn_process").prop("disabled", true).text("Processing...");
            });


        });
    </script>

   <script>
        // Function to allow only numbers in the input field
        function restrictToNumbers(event) {
            const input = event.target;
            const value = input.value;

            // Use a regular expression to check if the input is numeric
            if (/[^0-9]/g.test(value)) {
                // Remove any non-numeric characters
                input.value = value.replace(/[^0-9]/g, '');
            }
        }
    </script>

   <script>
    function checkMaxValue(input,qty) {
        if (input.value > qty) {
        input.value = qty; // Set value back to 5 if it exceeds the max value
        }
    }
    </script>