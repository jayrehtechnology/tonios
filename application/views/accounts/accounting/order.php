
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

								<form  method="GET">
                                <div class="row">
                                  <div class="col-lg-3">
                                 
                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                     <div class="mb-3">
                                         <label for="simpleinput" class="form-label">Select Driver (Logistics) </label>
                                            <select type="text" name="logistic_id" class="form-control"required>
                                                <option value=""> - Select Logistic - </option>
                                                    <?php foreach($logistics as $a){ 
														if($_GET['logistic_id'] == $a->id){
													?>
                                                         <option value="<?= $a->id;?>" data-id="<?= $a->fullname;?>" selected> <?= $a->fullname;?> </option>
														<?php } else { ?>
                                                         <option value="<?= $a->id;?>" data-id="<?= $a->fullname;?>"> <?= $a->fullname;?> </option>
                                                    <?php } } ?>
                                            </select>
                                      </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-3">
                                         <div style="height:27px;"></div>
                                         <button type="submit" class="btn btn-outline-dark"> Filter </button>
                                    </div> <!-- end col -->
                                    </form>
                                </div>   
                               
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
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center">MOP </th>

                                                    <th class="text-center"> Total Amount  </th>

                                                    <th class="text-center"> Delivery Summary  </th>

                                                    <th class="text-center"> Logistics  </th>
                                                    <th class="text-center"> Action  </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                            $total = 0;
                                            $qty   = 0;
                                            $totalcollected = 0;

                                            foreach($orders as $i){ 

                                                $totalcollected +=  $i->total_collected;
                                                
                                                ?>
                                                <tr>
                                                   <td class="text-center">  <a href="delivered-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?php if($i->mop=='CASH'){ echo "CASH";} else { ?> <a href="#" data-bs-toggle="modal" data-bs-target="#delivered<?= $i->id;?>"> <?= $i->mop;?> </a> <?php } ?> </td>
                                                    <td class="text-center"> <?= number_format($i->totalprocesssum,2);?></td>

                                                    <td class="text-center">  

                                                            Delivered Quantity : <b><?= $i->total_delivered;?> </b><br>
                                                            Returned Quantity : <b><?= $i->total_return;?>  </b><br>
                                                            Total Collected  :<b> <?= number_format($i->total_collected,2);?> </b> <br>
                                                            Total Credit  :<b> <?= number_format($i->balance,2);?> </b> <br>

                                                    </td>

                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <td class="text-center"> 
                                                       <?php if($i->orders_with_status_3 == $i->orders_with_status_2){ ?>
                                                        <?php if($i->is_sales == 1){ ?>
                                                        <?php } else { ?>
                                                         <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#tosales<?= $i->id;?>"> Process to Sales </button>                       
                                                       <?php  }  } ?>
                                                       <?php if($i->total_return == 0){ } else {?>
                                                       <?php if($i->is_sales == 1){} else{ ?>
                                                       <a href="delivered-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>" type="button" class="btn btn-outline-warning waves-effect waves-light"  > Process Return </a>                       
                                                       <?php  } } ?>
                                                    </td>
                                                  

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
                                                <div class="modal fade" id="tosales<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Order Transaction - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                    <form method="POST" action="<?= base_url("accounting/process-sales");?>" class="process_process">
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="trans_code" class="form-control" value="<?= $i->trans_code;?>">
                                                                                        <input type="hidden" name="customer_id" class="form-control" value="<?= $i->customer_id;?>">
                                                                                        <input type="hidden" name="mop" class="form-control" value="<?= $i->mop;?>">
                                                                                        <input type="hidden" name="is_credit_sales" class="form-control" value="<?= $i->is_credit_sales;?>">

                                                                                    <h2>Sales Details : </h2>
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
                                                                                        <input type="text" name="total_collected" class="form-control total_collected<?= $i->id;?>"   value="<?= $i->total_collected;?>" required readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Total Credits</label>
                                                                                        <input type="text" name="total_credits" class="form-control total_credits<?= $i->id;?>"   value="<?= $i->balance;?>" required readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Total Remittance</label>
                                                                                        <input type="text" name="total_remittance" class="form-control total_remittance" data-id = "<?= $i->id;?>"  id="total_remittance<?= $i->id;?>" required >
                                                                                    </div>
                                                                                 
                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light btn-close-1"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_process" style="display:none;">Process</button>
                                                                <div class="error-remittance"></div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                             
                                             <?php } ?>

                                           
                                             </tbody>
                                             <tfoot>
                                                <tr>
                                                    <th class="text-center"> </th>
                                                    <th class="text-center">  </th>
                                                    <th class="text-center">  </th>

                                                    <th class="text-center"> <h4> Total Collected</h4> </th>
                                                    <th class="text-center"> <h4><?= number_format($totalcollected,2);?></h4>  </th>
                                                    <th class="text-center">   </th>
                                                    <th class="text-center">   </th>
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

            $(".process_process").submit(function() {
                $(".btn_process").prop("disabled", true).text("Processing...");
            });

        });
    </script>

    <script>
      $('.total_remittance').on('keyup', function() {
    
            var id = $(this).data("id");
      
            var total_collected  = $('.total_collected' +  id ).val();
            var total_remittance = $('#total_remittance' +  id).val();

          
            if (total_collected != total_remittance) {

              $(".error-remittance").html("<b> <font color=red> Please check total collected not match to inputted remittance!</font></b>");
              $(".btn_process").hide();

            } else {

                $(".error-remittance").html("");
                $(".btn_process").show();

            }
        });
    </script>

    <script>
        $('.btn-close-1').on('click', function() {
            location.reload(); // Reload the page
        });
    </script>
  