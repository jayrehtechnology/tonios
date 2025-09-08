
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
                                        <h4 class="card-title text-white mb-0">For Delivery Orders</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Delivered Quantity  </th>
                                                    <th class="text-center"> Returned Quantity  </th>
                                                    <th class="text-center"> Total Collected  </th>
                                                    <th class="text-center"> Total Balance (Credits)  </th>

                                                    <th class="text-center"> MOP </th>

                                                    <th class="text-center"> Logistics  </th>

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
                                                    <td class="text-center"> <?= $i->is_delivered_complete;?></td>
                                                    <td class="text-center"> <?= $i->total_delivered;?></td>
                                                    <td class="text-center"> <?= $i->receipt;?></td>
                                                    <td class="text-center"> <?= number_format($i->total_collected,2);?></td>
                                                    <td class="text-center"> <?= number_format($i->balance,2);?></td>
                                                    <td class="text-center"> <?php if($i->mop=='CASH'){ echo "CASH";} if($i->mop=='FULL CREDIT'){ echo "FULL CREDIT";}  else { ?> <a href="#" data-bs-toggle="modal" data-bs-target="#delivered<?= $i->id;?>"> <?= $i->mop;?> </a> <?php } ?> <?php if($i->is_credit_sales=='1'){ echo "<font color=red><b>(Credits)</b></font>";} ?>  </td>
                                                    <td class="text-center"> <?= $i->fullname;?></td>
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
                                                                        <img src="<?= base_url();?>/assets/receipt/<?= $i->receipt;?>" width="250px;">
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

                $("#process_process").submit(function() {
                    $(".btn_process").prop("disabled", true).text("Processing...");
                });

            });
        </script>
  