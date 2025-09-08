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
        .table-like {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .table-like {
            display: table-row;
        }
        .table-like .col {
            display: table-cell;
            border: 1px solid #ddd;
        }
        .table-like .header {
            font-weight: bold;
            background-color: #f8f9fa;
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
                                            <h5> Approved Orders </h5>
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
                                            <div class="row">
                                            <div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Total Quantity  </th>
                                                    <th class="text-center"> Process Quantity  </th>
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
                                                    <td class="text-center">  <a href="order-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>&status=approved"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= $i->total_qty;?></td>
                                                    <td class="text-center"> <?= $i->process_quantity;?></td>
                                                    <td class="text-center"> <?= number_format($i->total_amount,2);?></td>
                                                    <td class="text-center">  <span class="badge bg-info ">Approved</span> </td>
                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <td class="text-center">
                                                        <a href="order-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>&type=process&status=approved" type="btn" class="btn btn-outline-danger waves-effect waves-light"> Process Order </a>                       
                                                        <?php if( $i->process_quantity!= 0){?>

                                                            <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#fordelivery<?= $i->id;?>"> Process for Delivery </button>                       

                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="fordelivery<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Order Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form method="POST" action="<?= base_url("orders/process-for-delivery");?>" id="process_remove">
                                                                                        Are you sure to process this for delivery <b><?= $i->trans_code;?></b>?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <input type="hidden" name="email" class="form-control" value="<?= $i->email;?>">
                                                                                        <input type="hidden" name="fullname" class="form-control" value="<?= $i->fullname;?>">
                                                                                        <input type="hidden" name="customer_name" class="form-control" value="<?= $i->customer_name;?>">

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

                $("#customer_type").val(value[1]);
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
