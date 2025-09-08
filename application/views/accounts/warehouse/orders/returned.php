
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
                                            <h5> Delivered Orders </h5>
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
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Product Name </th>

                                                    <th class="text-center"> Total Return Quantity  </th>
                                                    <th class="text-center"> Total Amount  </th>
                                                    <th class="text-center"> Status </th>

                                                    <th class="text-center"> Action  </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($returned_1 as $i){ ?>
                                                <tr>
                                                <td class="text-center">  <a href="order-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>&status=returned"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= $i->total_return;?></td>
                                                    <td class="text-center"> <?= number_format($i->total_amount,2);?></td>
                                                    <td class="text-center">  
                                                    <?php if($i->is_returned_inventory == 1){?>
                                                        <span class="badge bg-success ">Returned</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-warning ">For Return</span>
                                                    <?php } ?>
                                                    </td>
                                                

                                                    <td class="text-center">
                                                        <?php if($i->is_returned_inventory == 1){} else { ?>
                                                          <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#return<?= $i->id;?>">Return to Inventory </button>                       
                                                        <?php } ?>
                                                    </td>
                                                  

                                                </tr>
                                                <div class="modal fade" id="return<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Return to Inventory</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("orders/process-return-inventory");?>" class="process_returned">
                                                                                        Process return <?= $i->product_name;?> - <?= $i->total_return;?> ?
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">
                                                                                        <input type="hidden" name="total_return" class="form-control" value="<?= $i->total_return;?>">
                                                                                        <input type="hidden" name="product_id" class="form-control" value="<?= $i->product_id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_process" id="btn_assign">Process</button>
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

            $(".process_returned").submit(function() {
                $(".btn_process").prop("disabled", true).text("Processing...");
            });

        });
    </script>