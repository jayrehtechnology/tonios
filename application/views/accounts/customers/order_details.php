
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>

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
                                            <h5> <a href="order"> <i class="mdi mdi-chevron-left-circle-outline"> </i> Back </a></h5>

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
                                                    <th class="text-center"> Total </th>
                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?> 
                                                    <th class="text-center"> Action </th>
                                                    <?php } ?>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($orders_list as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= number_format($i->price,2);?></td>
                                                    <td class="text-center"> <?= $i->quantity;?></td>
                                                    <td class="text-center"> <?= number_format($i->total,2);?></td>
                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?> 

                                                    <td class="text-center">
                                                    <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $i->id;?>"> Update </button>                       
                                                    </td>

                                                    <?php } ?>

                                                </tr>

                                                <div class="modal fade" id="update<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
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
                                                                                        data-totalprice="<?php echo $i->total; ?>" 

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
        });
    </script>

<script>

    $(document).ready(function () {

        // Trigger calculation when quantity changes
        $(".quantity").on("change", function () {

            let id       = $(this).data("id");
            let price    = parseInt( $(this).data("price"));
            let quantity = parseInt($(this).data("quantity"));
            let tp       = parseInt($(this).data("totalprice"));

            let qty      = parseInt(this.value);


            let totalqty = quantity + 1;
            let total    = price * qty;
            let ttp      = tp + total;


            $(".total_price").html("<h2>" + total.toFixed(2) + "</h2>");
            $(".totalprice").val(total);
          
        });

      
    });
</script>

   