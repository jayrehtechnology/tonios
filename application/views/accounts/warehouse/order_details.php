
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
                                            <h4> <?= $_GET['customer'];?>  Charity </h4>
                                            <h5> <a href="charity"> <i class="mdi mdi-chevron-left-circle-outline"> </i> Back </a></h5>

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
                                                    <th class="text-center"> Request Quantity </th>
                                                    <th class="text-center"> In Quantity </th>
                                                    <th class="text-center"> Total </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                                $grandtotal = 0;
                                                foreach($orders_list as $i){

                                                $grandtotal += $i->total;

                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= number_format($i->price,2);?></td>
                                                    <td class="text-center"> <?= $i->quantity;?></td>
                                                    <td class="text-center"> <?= $i->quantity_done;?></td>
                                                    <td class="text-center"> <?= number_format($i->total,2);?></td>
                                                    <td class="text-center"><button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#process<?= $i->id;?>"> Prepare </button></td>

                                                </tr>
                                                <div class="modal fade" id="process<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"> Prepare Order</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">


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
                                                                                <div> Process Quantity :</div>
                                                                                <div> <?= $i->quantity_done;?></div>
                                                                            </div>
                                                                          
                                                                    
                                                                        
                                                                        </div>
                                                                        <hr>
                                                                            <div class="row">
                                                                              <form method="POST" id="update_process" action="<?= base_url("warehouse/process-charity-order");?>"  enctype="multipart/form-data">
                                                                                    <div class="col-lg-12">
                                                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                    <input type="hidden" name="id"  value="<?php echo $i->id; ?>">
                                                                                    <input type="hidden" name="product_id"  value="<?php echo $i->product_id; ?>">
                                                                                    <input type="hidden" name="price" class="totalprice"  value="<?php echo $i->total; ?>">
                                                                                    <input type="hidden" name="transaction" value="<?php echo $_GET['transaction']; ?>">
                                                                                    <input type="hidden" name="customer"  value="<?php echo $_GET['customer']; ?>">

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Product Name </label>
                                                                                        <input type="text" name="product" class="form-control" value="<?= $i->product_name;?>" readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">In Quantity </label>
                                                                                        <input type="number" name="quantity" class="form-control quantity" value="<?= $i->quantity_done;?>" max="<?= $i->quantity;?>"   oninput="checkMaxValue(this,<?= $inqty;?>)" required>
                                                                                    </div>

                                                                                   TOTAL : <div class="total_price"><h2><?=  number_format($i->total,2); ?></h2></div>

                                                                                 

                                                                                    </div> <!-- end col -->
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
                                             <tfoot>
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"> </td>
                                                    <td class="text-center"> </td>
                                                    <td class="text-center"><h4> GRAND TOTAL</h4> </td>
                                                    <td class="text-center"><h4> <?= number_format($grandtotal,2);?></h4></td>
                                                    <td class="text-center"> </td>

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

