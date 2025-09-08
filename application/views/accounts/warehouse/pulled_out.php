
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
                                            <h5> Customers Pull Out </h5>
										</div>
									</div><!-- end col-->
                                    <?php if($this->session->userdata['logged_in']['department'] == 'Logistics'){?> 
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Pull Out Products     </button>                       
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
                                        <h4 class="card-title text-white mb-0">Pull Out  List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"> 
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Name </th>

                                                    <th class="text-center"> Status </th>

                                                    <th class="text-center"> Action </th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($pullouts as $i){ ?>
                                                <tr>
                                                   <td class="text-center"> <b> <?= $i->trans_code;?> </b></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>

                                                    <td class="text-center"> Pull Out</td>

                                                    <td class="text-center">
                                                       <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#view<?= $i->id;?>"> View </button>                       
                                                       
                                                    </td>
                                                 </tr>
                                           

                                                  <!-- Receipt Modal -->
                                                <div class="modal fade" id="view<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="receiptModalLabel">Pull Out</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
                                                                 
																<div class="receipt-container "  id="printDiv" >
																	<!-- Receipt Header -->
																

																	<!-- Receipt Details -->
																	<div class="receipt-body">
																		<div class="receipt-line"><strong>Order #:</strong> <b><?= $i->trans_code;?></b></div>
																	</div>
                                                                    <hr>
																	<!-- Receipt Items -->
																	<div class="receipt-footer">
                                                                        <div class="receipt-line">
																			<span>Product</span> 
																			<span>Pull Out</span>  
                                                                            <span>Disposal</span>  
																			<span>Inventory</span>  

																		</div>

                                                                        <?php
                                                                        $grandtotal = 0;

                                                                        $this->db->select('a.*,b.product_name');
                                                                        $this->db->from('tonios_pull_out_products a');
                                                                        $this->db->join('tonios_products b', 'a.product_id = b.id', 'left');
                                                                        $this->db->where("a.trans_code" , $i->trans_code);
                                                                
                                                                
                                                                        $query1 = $this->db->get();
                                                                        $totalqty = 0;
                                                                        foreach($query1->result() as $ii){
                                                                            $totalqty += $ii->quantity;

                                                                        ?>
																			<div class="receipt-line">
                                                                            <span><?= $ii->product_name;?></span> 
                                                                            <span><?= $ii->quantity;?></span> 
                                                                            <span><?= $ii->qty_disposal;?></span> 
                                                                            <span><?= $ii->qty_for_inventory;?></span> 

																			</div>
																			
																			<?php } ?>
																			


																
																</div>
                                                              
															</div>
															<br>
															  <div class="text-center">
                                                                    <button class="btn btn-outline-dark" id="printBtn"><i class="fas fa-print"></i> Print </button>
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
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('process_assign');
    const disposalInputs = document.querySelectorAll('.disposal');
    const inventoryInputs = document.querySelectorAll('.inventory');

    function clamp(value, max) {
        return value > max ? max : value;
    }

    function updateRemaining(index, source) {
        const disposalInput = document.querySelector(`.disposal[data-index="${index}"]`);
        const inventoryInput = document.querySelector(`.inventory[data-index="${index}"]`);
        const errorDiv = document.getElementById(`error_${index}`);
        const max = parseInt(disposalInput.dataset.max);

        let disposal = parseInt(disposalInput.value) || 0;
        let inventory = parseInt(inventoryInput.value) || 0;

        if (source === 'disposal') {
            disposal = clamp(disposal, max);
            inventory = max - disposal;
            inventoryInput.value = inventory;
        } else if (source === 'inventory') {
            inventory = clamp(inventory, max);
            disposal = max - inventory;
            disposalInput.value = disposal;
        }

        const total = disposal + inventory;

        if (total !== max) {
            errorDiv.textContent = `Total must equal pull out quantity (${max}).`;
            return false;
        } else {
            errorDiv.textContent = '';
            return true;
        }
    }

    disposalInputs.forEach(input => {
        input.addEventListener('input', () => updateRemaining(input.dataset.index, 'disposal'));
    });

    inventoryInputs.forEach(input => {
        input.addEventListener('input', () => updateRemaining(input.dataset.index, 'inventory'));
    });

    form.addEventListener('submit', function (e) {
        let valid = true;
        disposalInputs.forEach(input => {
            if (!updateRemaining(input.dataset.index, 'disposal')) valid = false;
        });
        if (!valid) {
            alert("Please fix invalid entries before submitting.");
            e.preventDefault();
        }
    });
});
</script>


    <script>
        $(document).ready(function() {

            $("#process_order").submit(function() {
                $("#btn_process").prop("disabled", true).text("Processing...");
            });


            $(".process_pull_out").submit(function() {
                $(".btn_pull_out").prop("disabled", true).text("Processing...");
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

        // Initial calculation on page load
        //updateTotals();
    });
</script>
