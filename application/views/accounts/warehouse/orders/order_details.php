
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>
<style>
        /* Style the container div to behave like a table */

        /* Style the rows of the table */
        .table-row {
            display: flex;
            background-color: #fff;
            margin-top: 5px;
            padding: 10px;
            border-radius: 5px;
        }

        /* Alternate the row colors for better readability */
        .table-row:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Style each column in the rows */
        .table-row div {
            flex: 1;
            padding: 5px;
            text-align: left;
        }

        /* Optional: Add hover effect on rows */
        .table-row:hover {
            background-color: #ddd;
        }
    </style>
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
                                            <h4> <?= $_GET['customer'];?>  Orders </h4>
                                            <h5> <a href="<?= $_GET['status'];?>"> <i class="mdi mdi-chevron-left-circle-outline"> </i> Back </a></h5>
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
                                                    <th class="text-center"> Price  </th>
                                                    <th class="text-center"> Quantity </th>
                                                    <?php if($_GET['status'] == 'approved' || $_GET['status'] == 'logistics' ){?> 
                                                    <th class="text-center"> Process Quantity </th>
                                                    <th class="text-center"> Process Status </th>
                                                    <th class="text-center"> Total </th>
                                                    <?php } ?>
                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent' || isset($_GET['type'])){?> 
                                                    <th class="text-center"> Action </th>
                                                    <?php } ?>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $processqty = 0;
                                            $processtotal = 0;

                                            foreach($orders_list as $i){ 
                                                $processqty += $i->process_quantity;
                                                $processtotal += $i->process_quantity * $i->price ;

                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= number_format($i->price,2);?></td>
                                                    <td class="text-center"> <?= $i->quantity;?></td>
                                                    <?php if($_GET['status'] == 'approved' || $_GET['status'] == 'logistics' ){?> 
                                                        <td class="text-center"> <?= $i->process_quantity;?></td>
                                                    <td class="text-center">
                                                         <span class="badge bg-primary "><?= $i->is_complete;?></span>
                                                         <?php if($i->is_complete == 'Partial'){?>
                                                            - <a href="" type="button"   data-bs-toggle="modal" data-bs-target="#reason<?= $i->id;?>"> Reason </a>                       
                                                         <?php } ?>
                                                   </td>
                                                   <td class="text-center"> <?= number_format($i->process_quantity * $i->price ,2);?></td>
                                                   <?php } ?>
                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?> 

                                                        <td class="text-center">
                                                         <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $i->id;?>"> Update </button>                       
                                                        </td>

                                                    <?php } ?>

                                                    <?php  if(isset($_GET['type']) == 'process'){?> 

                                                        <td class="text-center">
                                                          <?php if($i->quantity == $i->process_quantity){?>
                                                          
                                                          <?php }  else {?>
                                                            <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#process<?= $i->id;?>"> Process </button>                       
                                                          <?php } ?>
                                                        </td>

                                                    <?php } ?>

                                                </tr>
                                                
                                                <div class="modal fade process" id="process<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"> Process Order</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                              <form method="POST" class="update_process_1" action="<?= base_url("orders/process-for-delivery-order");?>"  enctype="multipart/form-data">
                                                                                    <div class="col-lg-12">
                                                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                    <input type="hidden" name="id"  value="<?php echo $i->id; ?>">
                                                                                    <input type="hidden" name="product_id"  value="<?php echo $i->product_id;?>">

                                                                                    <input type="hidden" name="transaction"  value="<?php echo $_GET['transaction']; ?>">
                                                                                    <input type="hidden" name="customer"  value="<?php echo $_GET['customer']; ?>">
                                                                                    <input type="hidden" name="status_1"  value="<?php echo $_GET['status']; ?>">
                                                                                    <input type="hidden" name="type"  value="<?php echo $_GET['type']; ?>">

                                                                                    <?php

                                                                                        $getqty = $this->db->query("SELECT inventory_in from tonios_products where id='$i->product_id'");

                                                                                        $res = $getqty->result();

                                                                                    ?>  
                                                                                
                                                                                    <div class="tables">

                                                                                    <?php if($i->quantity > $res[0]->inventory_in){
                                                                                        $inqty = $res[0]->inventory_in;
                                                                                    ?>
                                                                                      <div class="alert alert-warning">Requested / Order Quantity is higher than Stock In Quantity</div>
                                                                                    <?php } else {
                                                                                       $inqty = $i->quantity;
                                                                                    } ?>

                                                                                            <!-- Table Rows (this acts like <tbody> in a normal table) -->
                                                                                            <div class="table-row">
                                                                                                <div> Product Name : </div>
                                                                                                <div><?= $i->product_name;?></div>  
                                                                                            </div>
                                                                                            <div class="table-row">
                                                                                                <div>  Requested Quantity : </div>
                                                                                                <div><?= $i->quantity;?></div>
                                                                                            </div>
                                                                                            <div class="table-row">
                                                                                                <div> Stock In Quantity :</div>
                                                                                                <div> <?= $res[0]->inventory_in;?></div>
                                                                                            </div>
                                                                                            <div class="table-row">
                                                                                                <div> Processed Quantity :</div>
                                                                                                <div><?= $i->process_quantity;?></div>
                                                                                            </div>
                                                                                      
                                                                                        
                                                                                        </div>
                                                                                   <hr>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Process Quantity </label>
                                                                                        <input type="number" name="quantity" class="form-control quantity"
                                                                                        min="0"
                                                                                        data-id="<?php echo $i->id; ?>" 
                                                                                        data-price="<?php echo $i->price; ?>" 
                                                                                        data-quantity="<?php echo $i->quantity; ?>" 
                                                                                        oninput="checkMaxValue(this,<?= $inqty;?>)"
                                                                                        required>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                    <label for="example-palaceholder" class="form-label">Process Status</label>
                                                                                    <select name="status" class="form-control process_status" fdprocessedid="gm8jcl" required>
                                                                                        <option value=""> - Select Status - </option>
                                                                                        <?php if($i->quantity > $res[0]->inventory_in){?>
                                                                                        <option value="Partial" <?php if($i->is_complete == 'Partial'){ echo "selected";} else {}?>> Partial </option>
                                                                                        <?php } else { ?> 
                                                                                         <option value="Complete" <?php if($i->is_complete == 'Complete'){ echo "selected";} else {}?>> Complete </option>
                                                                                         <option value="Partial" <?php if($i->is_complete == 'Partial'){ echo "selected";} else {}?>> Partial </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                    </div>

                                                                                    <div class="mb-3 partial-reason"  <?php if($i->is_complete == 'Partial'){} else { ?> style="display:none;" <?php } ?> >
                                                                                        <label for="simpleinput" class="form-label">Partial Reason  </label>
                                                                                        <textarea name="partial_reason_w" class="form-control " ><?= $i->partial_reason_w;?></textarea>
                                                                                    </div>

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_update_1"> Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade process" id="reason<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"> Partial Order</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                              <form method="POST" class="update_process_1" action="<?= base_url("orders/process-for-delivery-order");?>"  enctype="multipart/form-data">
                                                                                    <div class="col-lg-12">
                                                                                    <b>Reason : </b> <br>
                                                                                      <?= $i->partial_reason_w;?> <br>
                                                                                 


                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>


                                                <div class="modal fade " id="update<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"> Update Order</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                              <form method="POST" class="update_process" action="<?= base_url("customers/update-customer-order");?>"  enctype="multipart/form-data">
                                                                                    <div class="col-lg-12">
                                                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                    <input type="hidden" name="id"  value="<?php echo $i->id; ?>">
                                                                                    <input type="hidden" name="price" class="totalprice"  value="<?php echo $i->total; ?>">
                                                                                    <input type="hidden" name="transaction" value="<?php echo $_GET['transaction']; ?>">
                                                                                    <input type="hidden" name="customer"  value="<?php echo $_GET['customer']; ?>">

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Product Name </label>
                                                                                        <input type="text" name="product" class="form-control" value="<?= $i->product_name;?>" readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Quantity </label>
                                                                                        <input type="number" name="quantity" class="form-control quantity" value="<?= $i->quantity;?>"
                                                                                        
                                                                                        data-id="<?php echo $i->id; ?>" 
                                                                                        data-price="<?php echo $i->price; ?>" 
                                                                                        data-quantity="<?php echo $i->quantity; ?>" 

                                                                                        required>
                                                                                    </div>

                                                                                   TOTAL : <div class="total_price"><h2><?=  number_format($i->total,2); ?></h2></div>

                                                                                 

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_update"> Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                             <?php } ?>
                                             </tbody>
                                             <tfooot>
                                             <tr>
                                                    <th class="text-center">  </th>
                                                    <th class="text-center">   </th>
                                                    <th class="text-center">  </th>
                                                    <?php if($_GET['status'] == 'approved' || $_GET['status'] == 'logistics' ){?> 
                                                    <th class="text-center"> <h4><?= $processqty;?></h4> </th>
                                                    <th class="text-center"> </th>
                                                    <th class="text-center"><h4> <?= number_format($processtotal,2);?> </h4></th>
                                                    <?php } ?>
                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent' || isset($_GET['type'])){?> 
                                                    <th class="text-center">  </th>
                                                    <?php } ?>

                                                </tr>
                                             </tfoot>
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

            $(".update_process").submit(function() {
                $(".btn_update").prop("disabled", true).text("Processing...");
            });

            $(".update_process_1").submit(function() {
                $(".btn_update_1").prop("disabled", true).text("Processing...");
            });
        });
    </script>


<script type="text/javascript">
        $(document).ready(function() {
            // When the select value changes
            $('.process_status').on('change', function() {
                // Get the selected value
                var selectedColor = $(this).val();

                // Display the selected color in the div
                if (selectedColor == "Partial") {
                    $(".partial-reason").show();
                } else {
                    $(".partial-reason").hide();
                }
            });
        });
    </script> 
    
    <script type="text/javascript">
        $(document).ready(function() {
            // Event listener for when the modal is closed
            $('.process').on('hidden.bs.modal', function () {
                // Reload the page when the modal is closed
                location.reload();
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
