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
                                            <h5> For Delivery Orders </h5>
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
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Total Process Quantity  </th>
                                                    <th class="text-center"> Total Amount  </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Sales Agent </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                            $total = 0;
                                            $qty   = 0;

                                            foreach($orders as $i){ 
                                            
                                                ?>
                                                <tr>
                                                <td class="text-center">  <a href="order-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>&status=fordelivery"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= $i->process_quantity;?></td>
                                                    <td class="text-center"> <?= number_format($i->total_sum,2);?></td>
                                                    <td class="text-center">  <span class="badge bg-primary ">For Delivery</span> </td>
                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <td class="text-center">
                                                    <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#receipt<?= $i->id;?>"> Receipt </button>
                                                    <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#approved<?= $i->id;?>"> Assign Logistic </button>                       
                                                    </td>
                                                </tr>

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
                                                                        <p> Customer : <?= $i->customer_name;?> <br>
                                                                            Contact : <?= $i->customer_contact;?><br>
                                                                            Address: <?= $i->customer_address;?></p>

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
                                                                        $this->db->from('tonios_customer_orders a');
                                                                        $this->db->join('tonios_products b', 'a.product_id = b.id', 'left');
                                                                        $this->db->where("a.trans_code" , $i->trans_code);
                                                                
                                                                
                                                                        $query1 = $this->db->get();

                                                                        foreach($query1->result() as $ii){

                                                                        $grandtotal += $ii->price * $ii->process_quantity;

                                                                        ?>
																			<div class="receipt-line">
                                                                            <span><?= $ii->product_name;?></span> 
                                                                            <span><?= number_format($ii->price,2);?></span>  
                                                                            <span> <?= $ii->process_quantity;?></span>  
                                                                            <span><?= number_format($ii->price * $ii->process_quantity,2);?></span> 
																			</div>
																			
																			<?php } ?>
																			<div class="receipt-line">
																			<span></span> 
																			<span></span>  
																			<span></span>  
																			<div class="receipt-line total"><strong>Total : &nbsp; </strong> <span> <?= number_format($grandtotal,2);?></span></div>
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
											

                                                <div class="modal fade" id="approved<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Assign Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("orders/process-for-delivery-logistic");?>" id="process_assign">
                                                                                        Process for Delivery this Order <b><?= $i->trans_code;?></b>?   
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <hr>
                                                                                        <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Select Logistic </label>
                                                                                        <select type="text" name="logistic_id" class="form-control"required>
                                                                                            <option value=""> - Select Logistic - </option>
                                                                                            <?php foreach($logistics_1 as $a){ ?>
                                                                                                <option value="<?= $a->id;?>" data-id="<?= $a->fullname;?>"> <?= $a->fullname;?> </option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="example-email" class="form-label">Helper Name</label>
                                                                                        <input type="text" placeholder="" name="helper_name" class="form-control " value="" fdprocessedid="26svpg" required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="example-email" class="form-label">Plate Number</label>
                                                                                        <input type="text" placeholder="" name="plate_number" class="form-control " value="" fdprocessedid="26svpg" required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="example-email" class="form-label">Vehicle Type</label>
                                                                                        <input type="text" placeholder="" name="vehicle_type" class="form-control " value="" fdprocessedid="26svpg" required>
                                                                                    </div>

                                                                                    <input type="hidden" name="email" class="form-control" value="<?= $i->email;?>">
                                                                                    <input type="hidden" name="fullname" class="form-control" value="<?= $i->fullname;?>">
                                                                                    <input type="hidden" name="customer_name" class="form-control" value="<?= $i->customer_name;?>">

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

            $("#process_assign").submit(function() {
                $("#btn_assign").prop("disabled", true).text("Processing...");
            });

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