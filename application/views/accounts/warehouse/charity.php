
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>

<style>
        /* Custom CSS to make the input box smaller */
        .quantity {
            max-width: 40px; /* Limit width */
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
                                            <h5> Charity Orders </h5>
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
                                        <h4 class="card-title text-white mb-0">Order List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Charity Details </th>
                                                    <th class="text-center"> Products Quantity</th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Process By </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($charity as $i){ ?>
                                                <tr>
                                                <td class="text-center">  <a href="order-details?transaction=<?= $i->trans_code;?>&customer=<?= $i->charity_name;?>"><b> <?= $i->trans_code;?> </b></a></td>
                                                <td class="text-center"> 

                                                        Charity / Organization : <?= $i->charity_name;?> <br>
                                                        Contact Person : <?= $i->contact_name;?><br>
                                                        Contact Person : <?= $i->contact_number;?><br>
                                                        Contact Person : <?= $i->location;?><br>
                                                        Contact Person : <?= $i->charity_date;?><br>

                                                    </td>
                                                    <td class="text-center"> 
                                        
                                                        Request Products : <?= $i->total_qty;?><br>
                                                        Process In Products : <?= $i->total_done_qty;?>

                                                    </td>

                                                    <td class="text-center"> 
                                                        <?php 
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

                                                        <td class="text-center">
                                                            <?php if($i->status == 3){ ?>
                                                                <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#process<?= $i->id;?>"> Process </button>
                                                            <?php } ?>
                                                            <?php if($i->status == 4){ ?>
                                                                <?php if($i->total_qty == $i->total_done_qty ){?>
                                                                <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#complete<?= $i->id;?>"> Complete </button>
                                                            <?php } else {  ?>
                                                                <a href="order-details?transaction=<?= $i->trans_code;?>&customer=<?= $i->charity_name;?>" type="button" class="btn btn-outline-dark waves-effect waves-light" > Prepare Products </a>
                                                            <?php } ?>
                                                            <?php } if($i->status == 5){ ?>
                                                                <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#fordelivery<?= $i->id;?>"> Ready for Delivery </button>
                                                            <?php } ?>
                                                             <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#receipt<?= $i->id;?>"> Receipt </button>

                                                        </td>

                                                </tr>
                                                

                                                <div class="modal fade" id="fordelivery<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Ready for Delivery Charity  (<?= $i->trans_code;?>)</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form action="<?= base_url("warehouse/process-charity");?>" method="POST"  id="process_removed">
                                                                                         Are you sure to process this charity to Ready for Delivery data?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <input type="hidden" name="status" class="form-control" value="6">
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

                                             


                                                <div class="modal fade" id="process<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Process Charity  (<?= $i->trans_code;?>)</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form action="<?= base_url("warehouse/process-charity");?>" method="POST"  id="process_removed">
                                                                                         Are you sure to process this charity data?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <input type="hidden" name="status" class="form-control" value="4">
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

                                                <div class="modal fade" id="complete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Complete  Charity  (<?= $i->trans_code;?>)</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form action="<?= base_url("warehouse/process-charity");?>" method="POST"  id="process_removed">
                                                                                         Are you sure to complete process in warehouse this charity data?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <input type="hidden" name="status" class="form-control" value="5">

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

                                                                        $grandtotal += $i->total;

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