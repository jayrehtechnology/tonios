
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
                                            <h5> Sales Management </h5>
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
                                        <h4 class="card-title text-white mb-0">Credit Collection List</h4>
                                    </div>
                                    <div class="card-body">

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>

                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Credit Amount  </th>
                                                    <th class="text-center"> Paid Amount </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($collection as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->trans_code;?></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= number_format($i->amount,2);?></td>
                                                    <td class="text-center"> <?= $i->paid_amount;?></td>
                                                    <td class="text-center">
                                                        <?php if($i->is_collected == 1){ echo "Collected";} else{ ?>
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#assign<?= $i->id;?>"> Collect  </button>                       
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="assign<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"> Collect - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("logistics/process-collection");?>" class="process_assign" enctype= "multipart/form-data">
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">
                                                                                        <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label"> Collected Amount </label>
                                                                                        <input type="text" name="total_collected" class="form-control"  required>
                                                                                     </div>

                                                                                         <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Mode of Payment</label>
                                                                                        <select  name="mop"  class="form-control mop"  required>
                                                                                            <option value=""> - Select Mode of Payment - </option>
                                                                                            <option value="CASH"> CASH </option>
                                                                                            <option value="GCASH">GCASH </option>
                                                                                            <option value="BANK TRANSFER">BANK TRANSFER </option>
                                                                                            <option value="CHEQUE">CHEQUE</option>
                                                                                        </select>
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
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_assign">Process</button>
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

            $(".process_assign").submit(function() {
                $(".btn_assign").prop("disabled", true).text("Processing...");
            });

        });
    </script>

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