
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
                                            <h5> Customers Orders </h5>
										</div>
									</div><!-- end col-->
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Create Order    </button>                       
                                    </div>
                                 
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
                                                    <th class="text-center"> Contact  </th>
                                                    <th class="text-center"> Address </th>
                                                    <th class="text-center"> Total Quantity </th>
                                                    <th class="text-center"> Total Amount </th>

                                                    <th class="text-center"> Status </th>

                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?> 
                                                    <th class="text-center"> Action </th>
                                                    <?php } else { ?> 
                                                    <th class="text-center"> Sales Agent </th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($orders as $i){ ?>
                                                <tr>
                                                   <td class="text-center">  <a href="order-details?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= $i->customer_contact;?></td>
                                                    <td class="text-center"> <?= $i->customer_address;?></td>
                                                    <td class="text-center"> <?= $i->total_quantity;?></td>
                                                    <td class="text-center"> <?= number_format($i->total,2);?></td>

                                                    <td class="text-center"> 
                                                        <?php if($i->status == 0){
                                                            echo '<span class="badge bg-warning ">Pending</span>';
                                                        }
                                                        ?>
                                                        <?php if($i->status == 1){
                                                            echo '<span class="badge bg-info ">Approved</span>';
                                                        }
                                                        ?>
                                                        <?php if($i->status == 2){
                                                            echo '<span class="badge bg-info ">Ready for Delivery</span>';
                                                        }
                                                        ?>
                                                        <?php if($i->status == 3){
                                                            echo '<span class="badge bg-info ">For Delivery</span>';
                                                        }
                                                        ?>
                                                        <?php if($i->status == 4){
                                                            echo '<span class="badge bg-info "> Delivered </span>';
                                                        }
                                                        ?>
                                                    </td>

                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?> 
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Remove </button>                       
                                                    </td>
                                                    <?php } else { ?>
                                                        <td class="text-center"> <?= $i->fullname;?></td>
                                                    <?php } ?>
                                                </tr>
                                                
                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Order Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("customers/remove-order");?>" id="process_remove">
                                                                                        Are you sure to delete this data <b><?= $i->trans_code;?></b>?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_remove">Yes</button>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                            <form action="<?= base_url("customers/process-customer-order");?>" method="POST"  enctype="multipart/form-data" id="process_order">
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

                                                    <input type="hidden" name="customer_type" id="customer_type" >
                                                    <input type="hidden" name="distributor_type" id="distributor_type" >
                                                    <input type="hidden" name="distributor_price_percentage" id="distributor_price_percentage" >
                                                    <input type="hidden" name="distributor_price_amount" id="distributor_price_amount" >

                                                    <input type="hidden" name="agent_id" value="<?= $this->session->userdata['logged_in']['user_id'];?>">

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
                                                                <?= $i->product_name;?> - <?= $i->amount;?>
                                                                <input type="hidden" class="price" value="<?= $i->amount;?>" name="price[]" >
                                                                <input type="hidden" class="total-product" name="price_product[]" >
                                                                <input type="hidden" class="product_id" value="<?= $i->id;?>" name="product_id[]" >
                                                                </td>
                                                                
                                                                <td class="quantity-column">
                                                                <input type="text" value="0" name="quantity[]" class="form-control quantity">
                                                               </td>
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

            $("#process_order").submit(function() {
                $("#btn_process").prop("disabled", true).text("Processing...");
            });


            $("#process_remove").submit(function() {
                $("#btn_remove").prop("disabled", true).text("Processing...");
            });

            $("#staticBackdrop").on("shown.bs.modal", function() {
                $(".btn-primary").prop("disabled", true);
                $(".btn-outline-dark").prop("disabled", true);

            });
            $("#customers").change(function() {
                
                let selectedOption = $(this).find(":selected"); // Get selected option
                let productId = selectedOption.data("id"); // Get data-id
                let value = productId.split(" - "); // Get value and split

                $("#customer_type").val(value[0]);
                $("#distributor_type").val(value[1]);
                $("#distributor_price_percentage").val(value[2]);
                $("#distributor_price_amount").val(value[3]);

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
           
            let c_type           =  $("#customer_type").val();


            $("#table-order tbody tr").each(function () {
                let nprice   = 0;
                let price    = parseFloat($(this).find(".price").val());
                let quantity = parseInt($(this).find(".quantity").val());
                let amounr   = 0;

                if(c_type == 'Distributor'){

                    let distributor_type =  $("#distributor_type").val();
                    if(distributor_type == 'Percentage'){

                        let distributor_price_percentage =  $("#distributor_price_percentage").val();

                         amount = (distributor_price_percentage / 100) * price;

                    } else {

                         amount =  $("#distributor_price_amount").val();

                    }

                     nprice = price -amount;

                } else {

                     nprice = price;

                }

                
                let total = nprice * quantity;


                $(this).find(".total").text(total.toFixed(2) );
                $(this).find(".total-product").val(total.toFixed(2) );

                grandTotal += total;
            });

            $("#grand-total").text(grandTotal.toFixed(2)); // Format grand total
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
