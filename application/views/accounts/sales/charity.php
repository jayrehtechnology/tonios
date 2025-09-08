
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>

<style>
        /* Custom CSS to make the input box smaller */
        .quantity {
            max-width: 50px; /* Limit width */
            width:20px !important; /* Adjust width */
            text-align: center;
        }
        .quantity-column {
            width: 150px; /* Adjust as needed */
            min-width: 120px; /* Prevent shrinking too much */
        }

        /* Make the quantity input and buttons inline */
        .quantity-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
</style>
 <style>
        .modal-content {
            border-radius: 10px;
        }
        .receipt-container {
            padding: 15px;
            border: 1px dashed #ccc;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .receipt-header, .receipt-body, .receipt-footer {
            margin-bottom: 10px;
        }
        .receipt-header h5 {
            margin-bottom: 5px;
        }
        .receipt-line {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
        }
        .total {
            font-weight: bold;
            border-top: 2px solid #000;
            padding-top: 5px;
        }
        .thank-you {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            font-style: italic;
            color: #6c757d;
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
                                            <h5> Charity / Donation  </h5>
										</div>
									</div><!-- end col-->
                                    <?php if($this->session->userdata['logged_in']['department'] == 'Sales'){?> 

                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Create For Charity  </button>                       
                                    </div>

                                    <?php } ?>
                                 
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                         
                            <div class="col-12">
                                <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-primary"><?= $this->session->flashdata('success'); ?></div>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata('removed')): ?>
                                    <div class="alert alert-warning"><?= $this->session->flashdata('removed'); ?></div>
                                <?php endif; ?>
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Charity / Donation List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Charity / Organization Name </th>
                                                    <th class="text-center"> Contacts  </th>
                                                    <th class="text-center"> Charity Date </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Process By </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($charity as $i){ ?>
                                                <tr>
                                                   <td class="text-center">  <a href="order-details?transaction=<?= $i->trans_code;?>&customer=<?= $i->charity_name;?>"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->charity_name;?></td>
                                                    <td class="text-center"> Name : <?= $i->contact_name;?> <br> Contact : <?= $i->contact_number;?> <br> Address : <?= $i->location;?></td>
                                                    <td class="text-center"> <?= $i->charity_date;?></td>

                                                    <td class="text-center"> 
                                                        <?php 
                                                             if($i->status == 0){
                                                                 echo '<span class="badge bg-warning ">Pending</span>';
                                                              } 

                                                              if($i->status == 1){
                                                                echo '<span class="badge bg-success ">Approved</span>';
                                                              } 
                                                              if($i->status == 2){
                                                                echo '<span class="badge bg-danger ">Declined</span>';
                                                              } 
															  if($i->status == 3){
                                                                echo '<span class="badge bg-info ">Requested to Warehouse</span>';
                                                              } 
                                                              if($i->status == 4){
                                                                echo '<span class="badge bg-info ">Processing Request</span>';
                                                             } 

                                                             if($i->status == 5){
                                                                echo '<span class="badge bg-info ">Process Completed</span>';
                                                             } 

                                                             if($i->status == 6){
                                                                echo '<span class="badge bg-info ">Ready for Delivery</span>';
                                                            } 
                                                        ?>
                                                    </td>
                                                    <td class="text-center"> <?= $i->process_by;?></td>

                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Sales'){?> 
                                                      
                                                        <td class="text-center">
                                                        <?php if($i->status == 0){ ?>
                                                            <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Remove </button>                       
                                                        <?php }  if($i->status ==1){ ?>
                                                            <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#warehouse<?= $i->id;?>"> Process to Warehouse  </button>                       
                                                            <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#receipt<?= $i->id;?>"> Receipt  </button>                       
                                                        <?php }  if($i->status == 2){ ?>
                                                            <a href="#"  data-bs-toggle="modal" data-bs-target="#reason<?= $i->id;?>"> <span class="badge bg-danger ">Reason</span> </a>
                                                       <?php } ?>

                                                        </td>
                                                     

                                                    <?php } ?>

                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Administrator'){?> 

                                                        <td class="text-center">
                                                            <?php if($i->status == 0){ ?>
                                                             <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#approve<?= $i->id;?>"> Apporove </button>                       
                                                             <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#decline<?= $i->id;?>"> Decline </button>                       
                                                            <?php } ?>
                                                        </td>

                                                    <?php } ?>
                                                
                                                </tr>
                                                
                                                <div class="modal fade" id="reason<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Declined Reason</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?= $i->reason;?>                          
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>



                                                <div class="modal fade" id="approve<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Approve Charity (<?= $i->trans_code;?>)</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form action="<?= base_url("sales/process-approve-charity");?>" method="POST"  id="process_approve">
                                                                                         Are you sure to approve this charity data?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_approve">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade" id="warehouse<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Process to Warehouse (<?= $i->trans_code;?>)</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form action="<?= base_url("sales/process-warehouse-charity");?>" method="POST"  id="process_warehouse">
                                                                                         Are you sure to process to warehouse this charity data?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_warehouse">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Remove Charity  (<?= $i->trans_code;?>)</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form action="<?= base_url("sales/process-remove-charity");?>" method="POST"  id="process_removed">
                                                                                         Are you sure to remove this charity data?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_removed">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>


                                                <div class="modal fade" id="decline<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Approve Charity  (<?= $i->trans_code;?>)</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form action="<?= base_url("sales/process-declined-charity");?>" method="POST"  id="process_declined">
                                                                                         Are you sure to decline this charity data?   
                                                                                         <br> <br>
                                                                                         <div class="mb-3">

                                                                                            <label for="simpleinput" class="form-label">Reason : </label>
                                                                                            <textarea type="text" name="reason" class="form-control"  required></textarea>
                                                                                        
                                                                                        </div>
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_declined">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
												
												
												<!-- Receipt Modal -->
                                                <div class="modal fade" id="receipt<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
                                                                 
																<div class="receipt-container "  id="printDiv" >
																	<!-- Receipt Header -->
																	<div class="receipt-header ">
                                                                        <img src="<?= base_url();?>assets/images/tonios.png" alt="profile Pic" height="65">
                                                                        <br>
																		<p>Maharlika Highway Baranggay Calumpang , <br>  Tayabas, Philippines</p>
																		<small>Date: <span id="date"><?=  date("F j, Y");?></span></small>
                                                                        <br>
                                                                        <p> Customer : <?= $i->charity_name;?> (Charity)</p>
																	</div>

																	<!-- Receipt Details -->
																	<div class="receipt-body">
																		<div class="receipt-line"><strong>Order #:</strong> <b><?= $i->trans_code;?></b></div>
																	</div>
                                                                    <hr>
																	<!-- Receipt Items -->
																	<div class="receipt-footer">
                                                                        <div class="receipt-line">
																			<span>Product</span> 
																			<span>Price</span>  
																			<span>Quantity</span>  
																			<span>Total</span>
																		</div>

                                                                        <?php
                                                                        $grandtotal = 0;

                                                                        $this->db->select('a.*,b.product_name');
                                                                        $this->db->from('tonios_charity_orders a');
                                                                        $this->db->join('tonios_products b', 'a.product_id = b.id', 'left');
                                                                        $this->db->where("a.trans_code" , $i->trans_code);
                                                                
                                                                
                                                                        $query1 = $this->db->get();

                                                                        foreach($query1->result() as $ii){

                                                                        $grandtotal += $ii->total;

                                                                        ?>
																			<div class="receipt-line">
                                                                            <span><?= $ii->product_name;?></span> 
                                                                            <span><?= number_format($ii->price,2);?></span>  
                                                                            <span> <?= $ii->quantity;?></span>  
                                                                            <span><?= number_format($ii->total,2);?></span> 
																			</div>
																			
																			<?php } ?>
																			<div class="receipt-line">
																			<span></span> 
																			<span></span>  
																			<span></span>  
																			<div class="receipt-line total"><strong>Total:</strong> <span><?= number_format($grandtotal,2);?></span></div>
																			</div>


																
																</div>
                                                              
															</div>
															<br>
															  <div class="text-center">
                                                                    <button class="btn btn-outline-dark" id="printBtn"><i class="fas fa-print"></i> Print Receipt</button>
															        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>

															 </div>
														</div>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Charity Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                            <form action="<?= base_url("sales/process-charity-order");?>" method="POST"  enctype="multipart/form-data" id="process_order">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Organization / Charity Name </label>
                                                        <input type="text" name="charity" class="form-control" id="charity" required>
                                                      
                                                    </div>


                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Contact Name </label>
                                                        <input type="text" name="contact_name" class="form-control"  required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Contact Number </label>
                                                        <input type="text" name="contact_number" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Charity Date </label>
                                                        <input type="date" name="charity_date" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Address / Location</label>
                                                        <input type="text" name="location" class="form-control" required>
                                                    </div>

                                                    <input type="hidden" name="process_by" value="<?= $this->session->userdata['logged_in']['name'];?>">

                                                    <table id="table-order" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"> Product Name </th>
                                                            <th class="quantity-column text-center">Quantity</th>
                                                            <th class="text-center"> Total </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($products as $i){ ?>
                                                            <tr>
                                                                <td class="text-center"> 
                                                                <?= $i->product_name;?>
                                                                <input type="hidden" class="price" value="<?= $i->amount;?>" name="price[]" >
                                                                <input type="hidden" class="total-product" name="price_product[]" >
                                                                <input type="hidden" class="product_id" value="<?= $i->id;?>" name="product_id[]" >
                                                                </td>
                                                                
                                                                <td class="quantity-column">
                                                                <input type="text" value="0" name="quantity[]" class="form-control quantity"></td>
                                                                <td class="total">0</td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                             <tfoot>
                                                <tr>
                                                    <td colspan="2"><strong>Grand Total:</strong></td>
                                                    <td id="grand-total">0</td>
                                                </tr>
                                            </tfoot>
                                             </table>
                                              
                                              
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_process">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>

    
    <script>
        $(document).ready(function() {

            $("#process_removed").submit(function() {
                $("#btn_removed").prop("disabled", true).text("Processing...");
            });

            $("#process_warehouse").submit(function() {
                $("#btn_warehouse").prop("disabled", true).text("Processing...");
            });


            $("#process_order").submit(function() {
                $("#btn_process").prop("disabled", true).text("Processing...");
            });


            $("#process_approve").submit(function() {
                $("#btn_approve").prop("disabled", true).text("Processing...");
            });

            $("#process_declined").submit(function() {
                $("#btn_declined").prop("disabled", true).text("Processing...");
            });

            <?php if($this->session->userdata['logged_in']['department'] == 'Sales'){?> 

                $("#staticBackdrop").on("shown.bs.modal", function() {
                    $(".btn-primary").prop("disabled", true);
                    $(".btn-outline-dark").prop("disabled", true);

                });

                $("#charity").on("keyup", function() {
        
                    $(".btn-primary").prop("disabled", false);
                    $(".btn-outline-dark").prop("disabled", true);

                });

            <?php } ?>

        });
    </script>
    <script>

    $(document).ready(function () {
        // Initialize TouchSpin on all quantity inputs
        $(".quantity").TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            boostat: 5,
            maxboostedstep: 10,
            buttondown_class: "btn btn-primary",
            buttonup_class: "btn btn-primary"
        });

        // Function to update totals
        function updateTotals() {

            let grandTotal = 0;
           
            let c_type =  $("#customer_type").val();


            $("#table-order tbody tr").each(function () {
                let nprice = 0;
                let price = parseFloat($(this).find(".price").val());
                let quantity = parseInt($(this).find(".quantity").val());

                if(c_type == 'Distributor'){

                     nprice = price - 3;

                } else {

                     nprice = price;

                }

                
                let total = nprice * quantity;


                $(this).find(".total").text(total);
                $(this).find(".total-product").val(total);

                grandTotal += total;
            });

            $("#grand-total").text(grandTotal); // Format grand total
        }

        // Trigger calculation when quantity changes
        $(".quantity").on("change", function () {
            updateTotals();
            $(".btn-outline-dark").prop("disabled", false);
        });

        // Initial calculation on page load
        //updateTotals();
    });
</script>

<script>
        $(document).ready(function() {
            $("#printBtn").click(function() {
                var printContent = document.getElementById("printDiv").innerHTML;
                var printWindow = window.open('', '_blank');

                var styles = `
                    <style>
                        .receipt-container {
                            padding: 15px;
                            border: 1px dashed #ccc;
                            background: #f8f9fa;
                            border-radius: 10px;
                        }
                        .receipt-header, .receipt-body, .receipt-footer {
                            margin-bottom: 10px;
                        }
                        .receipt-header h5 {
                            margin-bottom: 5px;
                        }
                        .receipt-line {
                            display: flex;
                            justify-content: space-between;
                            padding: 3px 0;
                        }
                        .total {
                            font-weight: bold;
                            border-top: 2px solid #000;
                            padding-top: 5px;
                        }
                        .thank-you {
                            text-align: center;
                            margin-top: 10px;
                            font-size: 14px;
                            font-style: italic;
                            color: #6c757d;
                        }
                    </style>
                `;

                printWindow.document.write('<html><head><title>Print</title>' + styles + '</head><body>' + printContent + '</body></html>');
                printWindow.document.close();

                printWindow.print();
                printWindow.close(); // Close after printing
            });

           
        });
    </script>