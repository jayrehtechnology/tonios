
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
                                            <h5> Accounting Management </h5>
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
                                                        <a href="<?= base_url('accounting/view-credits-records?data='. $i->id.'&transcode='.$i->trans_code.'&customer_id='.$i->customer_id.'&customer_name='.$i->customer_name);?>" type="button" class="btn btn-outline-dark waves-effect waves-light"  "> View Records  </a>                       
                                                    </td>
                                                </tr>
                                               
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