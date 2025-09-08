
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
                                                   <td class="text-center">  <a href="order-details?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>

                                                    <td class="text-center"> Pull Out</td>

                                                    <td class="text-center">
                                                       <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#view<?= $i->id;?>"> View </button>                       
                                                       
                                                       <?php if( $i->is_process == 1){ echo "<b> Processed Pullout </b>";} else {?>
                                                       <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#process<?= $i->id;?>"> Process </button>                       
                                                       <?php } ?>
                                                    </td>
                                                 </tr>
                                                 <div class="modal fade" id="process<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Pull Out Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("warehouse/process-pullout");?>" id="process_assign">
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <hr>
                                                                                        <div class="receipt-line">
                                                                                            <span>Product</span> 
                                                                                            <span>Pull Out</span>  
                                                                                            <span>For Disposal</span>  
                                                                                            <span>For Iventory</span>  

                                                                                        </div>

                                                                                        <?php
                                                                                            $grandtotal = 0;

                                                                                            $this->db->select('a.*,b.product_name');
                                                                                            $this->db->from('tonios_pull_out_products a');
                                                                                            $this->db->join('tonios_products b', 'a.product_id = b.id', 'left');
                                                                                            $this->db->where("a.trans_code" , $i->trans_code);
                                                                                    
                                                                                    
                                                                                            $query1 = $this->db->get();
                                                                                            $totalqty = 0;
                                                                                            foreach ($query1->result() as $index => $ii) {

                                                                                                $totalqty += $ii->quantity;

                                                                                            ?>
																			<div class="receipt-line">
                                                                            <span><?= $ii->product_name;?></span> 
                                                                            <span><?= $ii->quantity;?></span> 
                                                                            <span>
                                                                                <input type="number" 
                                                                                    name="for_disposal[<?= $ii->product_id ?>]" 
                                                                                    class="form-control disposal" 
                                                                                    data-index="<?= $index ?>" 
                                                                                    data-max="<?= $ii->quantity ?>" 
                                                                                     min="0" max="<?= $ii->quantity ?>"
                                                                                    style="width:70px;" 
                                                                                    required>
                                                                            </span>
                                                                            <span>
                                                                                <input type="number" 
                                                                                    name="for_inventory[<?= $ii->product_id ?>]" 
                                                                                    class="form-control inventory" 
                                                                                    data-index="<?= $index ?>" 
                                                                                    data-max="<?= $ii->quantity ?>" 
                                                                                     min="0" max="<?= $ii->quantity ?>"
                                                                                    style="width:70px;" 
                                                                                    required>
                                                                            </span>
																			</div>
                                                                            <input type="hidden" id="quantity_<?= $index ?>" value="<?= $ii->quantity ?>">
                                                                            <input type="text" name="product_id[]" id="product_id<?= $index ?>" value="<?= $ii->product_id ?>">

																			<?php } ?>
                                                                              

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_assign">Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                                

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
																			<span>Quantity</span>  
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
																			</div>
																			
																			<?php } ?>
																			<div class="receipt-line">
																			<span></span> 
																			<span></span>  
																			<span></span>  
																			<div class="receipt-line total"><strong>Total : &nbsp; </strong> <span> <?= $totalqty;?></span></div>
																			</div>


																
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
    
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"> Pull Out Products </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                            <form action="<?= base_url("customers/process-pullout-order");?>" method="POST"  enctype="multipart/form-data" class="process_pull+out">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Customer Name </label>
                                                        <select type="text" name="customer_id" class="form-control" id="customers" required>
                                                            <option value=""> - Select Customer - </option>
                                                            <?php foreach($customer as $a){ ?>
                                                                <option value="<?= $a->id;?>" data-id="<?= $a->customer_type ." - " . $a->distributor_type ." - " . $a->distributor_price_percentage ." - " . $a->distributor_price_amount;?>"> <?= $a->customer_name ." - " . $a->customer_type;?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                  

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
                                                                <?= $i->product_name;?> - <?= $i->amount;?>
                                                                <input type="hidden" class="price" value="<?= $i->amount;?>" name="price[]" >
                                                                <input type="hidden" class="total-product" name="price_product[]" >
                                                                <input type="hidden" class="product_id" value="<?= $i->id;?>" name="product_id[]" >
                                                                </td>
                                                                
                                                                <td class="quantity-column">
                                                                <input type="text" value="0" name="quantity[]" class="form-control quantity">
                                                               </td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                          
                                             </table>
                                              
                                              
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_pull_out">Process</button>
                    </div>
                </form>
            </div>
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
