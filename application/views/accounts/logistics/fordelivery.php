
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
                                        <h5> Logistics </h5>
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
                                        <h4 class="card-title text-white mb-0">Delivered Order</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row">
                                            <div class="col-sm-12">
                                            <div class="table-responsive">

                                            <table id="table-1" class="table  nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Total Quantity  </th>
                                                    <th class="text-center"> Total Amount  </th>
                                                    <th class="text-center"> Delivered   </th>
                                                    <th class="text-center"> Returned   </th>
                                                    <th class="text-center"> Logistics  </th>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Logistics'){?> 
                                                        <th class="text-center"> Action  </th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                            $total = 0;
                                            $qty   = 0;

                                            foreach($orders as $i){ 
                                                ?>
                                                <tr>
                                                   <td class="text-center">  <a href="delivery-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= $i->process_quantity;?></td>
                                                    <td class="text-center"> <?= number_format($i->totalprocesssum,2);?></td>
                                                    <td class="text-center"> <?= $i->total_delivered;?></td>
                                                    <td class="text-center"> <?= $i->total_return;?></td>

                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Logistics'){?> 
                                                    <td class="text-center">

                                                      <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delivered<?= $i->id;?>"> Process Delivered </button>                       
                                                      <a href="delivery-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>" type="button" class="btn btn-outline-warning waves-effect waves-light" > Process Products </a>                       

                                                    </td>
                                                    <?php } ?>
                                                </tr>

                                                <div class="modal fade" id="delivered<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Order Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form method="POST" action="<?= base_url("logistics/process-delivered");?>" class="process_process"  enctype= "multipart/form-data">
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <input type="hidden" name="customer_id" class="form-control" value="<?= $i->customer_id;?>">

                                                                                    <h2>Delivery Details : </h2>
                                                                                    <hr>
                                                                                 
                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Total Quantity Delivered</label>
                                                                                        <input type="text" name="total_quantity" class="form-control" value="<?= $i->total_delivered;?>"  required readonly>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Total Quantity Returned</label>
                                                                                        <input type="text" name="total_quantity" class="form-control"  value="<?= $i->total_return;?>" required readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Total Collected</label>
                                                                                        <input type="text" name="total_collected" class="form-control"  value="<?= $i->total_amount_delivered;?>" required>
                                                                                    </div>

                                                                                    
                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Mode of Payment</label>
                                                                                        <select  name="mop"  class="form-control mop"  required>
                                                                                            <option value=""> - Select Mode of Payment - </option>
                                                                                            <option value="CASH"> CASH </option>
                                                                                            <option value="GCASH">GCASH </option>
                                                                                            <option value="BANK TRANSFER">BANK TRANSFER </option>
                                                                                            <option value="CHEQUE">CHEQUE</option>
                                                                                            <option value="FULL CREDIT">FULL CREDIT</option>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="mb-3 check-partial">
                                                                                    <input type="checkbox" name="is_partial" value="1" class="partial" >
                                                                                    <label for="simpleinput" class="form-label">Is Partial Credit?</label>
                                                                                    </div>

                                                                                    <div class ="credit-amount mb-3" style="display:none;">
                                                                                        <label for="simpleinput" class="form-label">Credit Amount</label>
                                                                                        <input type="text" name="credit_amount" class="form-control" >
                                                                                    </div>

                                                                                    <div class ="due-date mb-3" style="display:none;">
                                                                                        <label for="simpleinput" class="form-label">Due Date</label>
                                                                                        <input type="date" name="due_date" class="form-control" >
                                                                                    </div>

                                                                                    <div class="mb-3 receipt-show" style="display:none;">
                                                                                        <label for="simpleinput" class="form-label">Receipt</label>
                                                                                        <input type="file" name="file" class="form-control receipt" >
                                                                                    </div>
                                                                                 
                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_process">Process</button>
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

            $(".process_process").submit(function() {
                $(".btn_process").prop("disabled", true).text("Processing...");
            });

        });

        $('.mop').on('change', function() {
            var selectedValue = $(this).val();
            if(selectedValue == 'CASH'){
                $(".receipt").prop("required", false);
                $(".receipt-show").hide();
                $('.due-date').hide();
                $('.credit-amount').hide();
                $(".check-partial").show();
            } else if( selectedValue == 'FULL CREDIT'){
                $(".receipt").prop("required", false);
                $(".check-partial").hide();
                $('.due-date').show();
                $('.credit-amount').hide();
            } else {
                $(".receipt").prop("required", true);
                $(".receipt-show").show();
                $('.due-date').hide();
                $('.credit-amount').hide();
                $(".check-partial").show();

            }
        });
    </script>

<script>
$(document).ready(function() {
    $('.partial').on('change', function() {
        if ($(this).is(':checked')) {
            $('.credit-amount').show();
            $('.due-date').show();
        } else {
            $('.credit-amount').hide();
            $('.due-date').hide();
        }
    });
});
</script>

    
  