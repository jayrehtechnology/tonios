
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

                                                    <th class="text-center"> Collected Amount </th>
                                                    <th class="text-center"> Mode of Payment </th>
                                                    <th class="text-center"> Date Added </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($collection as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= number_format($i->total_collected,2);?></td>
                                                    <td class="text-center"> <?= $i->mop;?></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>
                                                    <td class="text-center">
                                                    <?php if($i->is_collected ==1 ) { echo "Colledted";} else { ?>
                                                    <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#process<?= $i->id;?>"> Process </button>                       
                                                      <?php } ?>    
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="process<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Collection</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("accounting/process-collection-to-sales");?>" class="process">
                                                                                        Are you sure to process this collection as sales ?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">
                                                                                        <input type="hidden" name="transcode" class="form-control" value="<?= $_GET['transcode'];?>">
                                                                                        <input type="hidden" name="customer_id" class="form-control" value="<?= $_GET['customer_id'];?>">
                                                                                        <input type="hidden" name="total_collected" class="form-control" value="<?= $i->total_collected;?>">
                                                                                        <input type="hidden" name="customer_name" class="form-control" value="<?= $_GET['customer_name'];?>">
                                                                                        <input type="hidden" name="data" class="form-control" value="<?= $_GET['data'];?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-ligh btn-process">Yes</button>
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

            $(".process").submit(function() {
                $(".btn-process").prop("disabled", true).text("Processing...");
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