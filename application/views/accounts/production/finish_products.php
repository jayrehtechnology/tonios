
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>
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
                                            <h5> Production </h5>
										</div>
									</div><!-- end col-->
                                    <div class="col-lg-2 col-md-3col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"    style="width:100%" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fe-plus-circle"></i> Add Finish Products  </button>                       
                                    </div>
                                 
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Finished Products</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="finish_products" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Batch No. </th>
                                                    <th class="text-center"> Total Quantity </th>
                                                    <th class="text-center"> Process By </th>
                                                    <th class="text-center"> Process Date </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($finish as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <a href="#" data-bs-toggle="modal" data-bs-target="#batch<?= $i->id;?>"><b> <?= $i->batch_no;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->total_quantity;?></td>
                                                    <td class="text-center"> <?= $i->process_by;?></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>

                                                    <td class="text-center">
                                                        <?php if($i->is_status == 1){
                                                            echo '<span class="badge bg-soft-primary text-primary"> Endorse to Warehouse</span>';
                                                        } else { ?>
                                                        <?php if($this->session->userdata['logged_in']['department'] == 'Production' ){?> 

                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#endorse<?= $i->id;?>"> Endorse to Warehouse </button>                       
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Remove </button>                       
                                                        
                                                        <?php } ?>
                                                        <?php } ?>

                                                    </td>
                                                </tr>

                                                												
												
												<!-- Receipt Modal -->
                                                <div class="modal fade" id="batch<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="receiptModalLabel"><b> <?= $i->batch_no;?> </b> Products</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
                                                                 
																<div class="receipt-container "  id="printDiv" >
																
																	<!-- Receipt Items -->
																	<div class="receipt-footer">
                                                                        <div class="receipt-line">
																			<span>Product</span> 
																			<span>Quantity</span>  
																		</div>

                                                                        <?php
                                                                        $grandtotal = 0;

                                                                        $this->db->select('a.*,b.product_name');
                                                                        $this->db->from('tonios_warehouse_stock_receivable a');
                                                                        $this->db->join('tonios_products b', 'a.product = b.id', 'left');
                                                                        $this->db->where("a.batch_no" , $i->batch_no);
                                                                
                                                                
                                                                        $query1 = $this->db->get();

                                                                        foreach($query1->result() as $ii){

                                                                        $grandtotal += $ii->quantity;

                                                                        ?>
																			<div class="receipt-line">
                                                                            <span><?= $ii->product_name;?></span> 
                                                                            <span> <?= $ii->quantity;?></span>  
																			</div>
																			
																			<?php } ?>
																			<div class="receipt-line">
																			<span></span> 
																			<span></span>  
																			<span></span>  
																			<div class="receipt-line total"><strong>Total Quantity:</strong> <span><?= $grandtotal;?></span></div>
																			</div>


																
																</div>
                                                              
															</div>
															<br>
															  <div class="text-center">
                                                                    <button class="btn btn-outline-dark" id="printBtn"><i class="fas fa-print"></i> Print <b> <?= $i->batch_no;?> </b></button>
															        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>

															 </div>
														</div>
													</div>
												</div>
												</div>

                                                <div class="modal fade" id="endorse<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Endorse to Warehouse</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("production/endorse-batch-products");?>" class="process_endorse">
                                                                                        Are you sure to endorse this batch products ?   
                                                                                    
                                                                                                <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                                <input type="hidden" name="batch_no" class="form-control" value="<?= $i->batch_no;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn-endorse" >Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Remove Batch Products</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("production/remove-batch-products");?>">
                                                                                        Are you sure to remove this Batch Products ?   
                                                                                    
                                                                                                <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                                <input type="hidden" name="batch_no" class="form-control" value="<?= $i->batch_no;?>">

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
                        <h5 class="modal-title" id="staticBackdropLabel"> Finsih Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                            <form action="<?= base_url("production/process-finish-products");?>" method="POST"  enctype="multipart/form-data" id="process_order">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Batch Name / Number </label>
                                                       
                                                        <input type="text" name="batch_no" id="batch_no" class="form-control">

                                                    </div>

                                                    <input type="hidden" name="customer_type" id="customer_type" >
                                                    <input type="hidden" name="agent_id" value="<?= $this->session->userdata['logged_in']['user_id'];?>">

                                                    <table id="table-order" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"> Product Name </th>
                                                            <th class="quantity-column text-center">Quantity</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($products as $i){ ?>
                                                            <tr>
                                                                <td class="text-center"> 
                                                                <?= $i->product_name;?>
                                                                <input type="hidden" class="product_id" value="<?= $i->id;?>" name="product_id[]" >
                                                                </td>
                                                                
                                                                <td class="quantity-column">
                                                                <input type="text" value="0" name="quantity[]" class="form-control quantity"></td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                             <tfoot>
                                                <tr>
                                                    <td><strong> Total Quantity:</strong></td>
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

            $("#process_order").submit(function() {
                $("#btn_process").prop("disabled", true).text("Processing...");
            });

            $(".process_endorse").submit(function() {
                $(".btn-endorse").prop("disabled", true).text("Processing...");
            });


            $("#process_remove").submit(function() {
                $("#btn_remove").prop("disabled", true).text("Processing...");
            });

            $("#staticBackdrop").on("shown.bs.modal", function() {
                $(".btn-primary").prop("disabled", true);
                $(".btn-outline-dark").prop("disabled", true);

            });
            $("#batch_no").keyup(function() {
                $(".btn-primary").prop("disabled", false);
                $(".btn-outline-dark").prop("disabled", true);

            });
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


            $("#table-order tbody tr").each(function () {
                let quantity = parseInt($(this).find(".quantity").val());


                grandTotal += quantity;
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

