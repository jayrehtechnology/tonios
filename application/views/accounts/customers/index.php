
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
                                            <h5> Customers Records </h5>
										</div>
									</div><!-- end col-->
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Customer Data    </button>                       
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
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Customers List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Contact  </th>
                                                    <th class="text-center"> Address </th>
                                                    <th class="text-center"> Type </th>
                                                    <th class="text-center"> Agent </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($customer as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= $i->customer_contact;?></td>
                                                    <td class="text-center"> <?= $i->customer_address;?></td>
                                                    <td class="text-center"> <?= $i->customer_type;?></td>
                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $i->id;?>"> Update </button>                       
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Delete </button>                       
                                                    </td>
                                                </tr>
                                                
                                                <div class="modal fade" id="update<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Customer Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                              <form method="POST" action="<?= base_url("customers/update-customers");?>"  enctype="multipart/form-data" class="process_update">
                                                                                    <div class="col-lg-12">
                                                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                    <input type="hidden" name="id"  value="<?php echo $i->id; ?>">
                                                                                    <div class="mb-3">
                                                                                            <label for="simpleinput" class="form-label">Customer Name </label>
                                                                                            <input type="text" name="customer_name" class="form-control" value="<?= $i->customer_name;?>" required>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="simpleinput" class="form-label">Customer Contact </label>
                                                                                            <input type="text" name="customer_contact" class="form-control" value="<?= $i->customer_contact;?>" required>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="example-email" class="form-label">Customer Address</label>
                                                                                            <textarea type="text" name="customer_address"  class="form-control" required><?= $i->customer_address;?></textarea>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="simpleinput" class="form-label">Customer Type </label>
                                                                                            <select type="text" name="customer_type" id="mySelect" class="form-control customer_type_1"  required>
                                                                                                <option value=""> - Select Type - </option>
                                                                                                <?php if($i->customer_type == 'Reseller'){ ?>
                                                                                                     <option value="Reseller" data-id="<?= $i->id;?>" selected> Reseller </option>
                                                                                                     <option value="Distributor" data-id="<?= $i->id;?>"> Distributor </option>
                                                                                                 <?php } else if($i->customer_type == 'Distributor'){ ?>
                                                                                                     <option value="Reseller"  data-id="<?= $i->id;?>"> Reseller </option>
                                                                                                     <option value="Distributor" data-id="<?= $i->id;?>" selected> Distributor </option>
                                                                                                <?php } else { ?>
                                                                                                    <option value="Reseller" data-id="<?= $i->id;?>"> Reseller </option>
                                                                                                    <option value="Distributor" data-id="<?= $i->id;?>"> Distributor </option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        
                                                                                        <div class="mb-3" <?php if($i->customer_type == 'Distributor'){} else { ?> style="display:none;" <?php } ?> id="distributor-type_1">
                                                                                            <label for="simpleinput" class="form-label">Distributor Type </label>
                                                                                            <select type="text" name="distributor_type" class="form-control distributor_type_1" >
                                                                                                <option value=""> - Select Type - </option>
                                                                                                <option value="Percentage" <?php if($i->distributor_type == 'Percentage'){ echo "selected"; } else {}?>> Percentage </option>
                                                                                                <option value="Amount" <?php if($i->distributor_type == 'Amount'){ echo "selected"; } else {}?>> Amount </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        
                                                                                        <div class="mb-3" <?php if($i->distributor_type == 'Percentage'){} else { ?> style="display:none;" <?php } ?> id="type-percentage_1">
                                                                                            <label for="simpleinput" class="form-label">Percentage  </label>
                                                                                            <input type="text" name="distributor_price_percentage"  class="form-control distributor_price_percentage_1" value="<?= $i->distributor_price_percentage;?>">
                                                                                        </div>
                                                                                        
                                                                                        <div class="mb-3" <?php if($i->distributor_type == 'Amount'){} else { ?> style="display:none;" <?php } ?> id="type-amount_1">
                                                                                            <label for="simpleinput" class="form-label"> Amount  </label>
                                                                                            <input type="text" name="distributor_price_amount" id="" class="form-control distributor_price_amount_1" value="<?= $i->distributor_price_amount;?>">
                                                                                        </div>

                                                                                        <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?>
                                                                                            <input type="hidden" name="agent_id" class="form-control" value="<?= $this->session->userdata['logged_in']['user_id'];?>" required>
                                                                                        <?php } else {?> 
                                                                                        <div class="mb-3">
                                                                                            <label for="simpleinput" class="form-label">Agent</label>
                                                                                            <select type="text" name="agent_id" class="form-control" required>
                                                                                                <option value=""> - Select Agent - </option>
                                                                                                <?php foreach($agent as $a){ 
                                                                                                    
                                                                                                    if($i->agent_id == $a->id){ 
                                                                                                    ?>
                                                                                                    <option value="<?= $a->id;?>" selected> <?= $a->fullname;?> </option>
                                                                                                    <?php } else { ?>           
                                                                                                    <option value="<?= $a->id;?>"> <?= $a->fullname;?> </option>
                                                                                                    <?php } } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <?php } ?>
                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_update" >Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                              

                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Customer Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("customers/delete-customers");?>" class="process_delete">
                                                                                        Are you sure to delete this data ?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_delete">Yes</button>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Customer Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                 <form action="<?= base_url("customers/process-customers");?>" method="POST"  enctype="multipart/form-data" id="process_add">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Customer Name </label>
                                                        <input type="text" name="customer_name" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Customer Contact </label>
                                                        <input type="text" name="customer_contact" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Customer Address</label>
                                                        <textarea type="text" name="customer_address"  class="form-control" required></textarea>
                                                    </div>
                                                    <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent' || $this->session->userdata['logged_in']['position'] == 'Telemarketing'){?>  
                                                        
                                                    <?php } else { ?>
                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Customer Type </label>
                                                        <select type="text" name="customer_type" id="customer_type" class="form-control" required>
                                                            <option value=""> - Select Type - </option>
                                                            <option value="Reseller"> Reseller </option>
                                                            <option value="Distributor"> Distributor </option>
                                                        </select>
                                                    </div>
													
													 <div class="mb-3" style="display:none;" id="distributor-type">
                                                        <label for="simpleinput" class="form-label">Distributor Type </label>
                                                        <select type="text" name="distributor_type" id="distributor_type" class="form-control" >
                                                            <option value=""> - Select Type - </option>
                                                            <option value="Percentage"> Percentage </option>
                                                            <option value="Amount"> Amount </option>
                                                        </select>
                                                    </div>
													
													<div class="mb-3" style="display:none;" id="type-percentage">
                                                        <label for="simpleinput" class="form-label">Percentage  </label>
                                                        <input type="text" name="distributor_price_percentage" id="distributor_price_percentage" class="form-control" >
                                                    </div>
													
													<div class="mb-3" style="display:none;" id="type-amount">
                                                        <label for="simpleinput" class="form-label"> Amount  </label>
                                                        <input type="text" name="distributor_price_amount" id="distributor_price_amount" class="form-control" >
                                                    </div>
                                                    <?php } ?>

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Agent</label>
                                                        <select type="text" name="agent_id" class="form-control" required>
                                                            <option value=""> - Select Agent - </option>
                                                            <?php foreach($agent as $a){ ?>
                                                                <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?> 

                                                                    <?php if($this->session->userdata['logged_in']['user_id'] == $a->id){?> 
                                                                        <option value="<?= $a->id;?>" selected> <?= $a->fullname;?> </option>
                                                                    <?php } ?>

                                                                <?php } else { ?>
                                                                <option value="<?= $a->id;?>"> <?= $a->fullname;?> </option>
                                                                <?php }?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                              
                                              
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn_add">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>

        <script>
            $(document).ready(function() {

                $("#process_add").submit(function() {
                    $("#btn_add").prop("disabled", true).text("Processing...");
                });

                $(".process_update").submit(function() {
                    $(".btn_update").prop("disabled", true).text("Updating...");
                });

                $(".process_delete").submit(function() {
                    $(".btn_delete").prop("disabled", true).text("Deleting...");
                });

            });
        </script>
		<script>
		  $('#customer_type').change(function() {
			const selectedValue = $(this).val();
			if(selectedValue == 'Distributor'){
				$("#distributor-type").show();
                $("#distributor_type").prop("required",true);
			} else {
                $("#distributor_type").prop("required",false);
				$("#distributor-type").hide();
				$("#type-percentage").hide();
				$("#type-amount").hide();
			}
				
		  });
		  
		 $('#distributor_type').change(function() {

			const selectedValue1 = $(this).val();

			if(selectedValue1 == 'Percentage'){

				$("#type-percentage").show();
				$("#type-amount").hide();
                $("#distributor_price_percentage").prop("required",true);
                $("#distributor_price_amount").prop("required",false);

			} else {

				$("#type-percentage").hide();
				$("#type-amount").show();

                $("#distributor_price_percentage").prop("required",false);
                $("#distributor_price_amount").prop("required",true);

			}
				
		  });
		</script>


        <script>
		$('.customer_type_1').change(function () {
            const selectedValue = $(this).val();
            const modal = $(this).closest('.modal');

            if (selectedValue == 'Distributor') {
                modal.find('#distributor-type_1').show();
                modal.find('.distributor_type_1').prop("required", true);
            } else {
                modal.find('#distributor-type_1').hide();
                modal.find('.distributor_type_1').prop("required", false);
                modal.find('#type-percentage_1').hide();
                modal.find('#type-amount_1').hide();
            }
        });

        $('.distributor_type_1').change(function () {
            const selectedValue = $(this).val();
            const modal = $(this).closest('.modal');

            if (selectedValue == 'Percentage') {
                modal.find('#type-percentage_1').show();
                modal.find('#type-amount_1').hide();
                modal.find('.distributor_price_percentage_1').prop("required", true);
                modal.find('.distributor_price_amount_1').prop("required", false);
            } else if (selectedValue == 'Amount') {
                modal.find('#type-percentage_1').hide();
                modal.find('#type-amount_1').show();
                modal.find('.distributor_price_percentage_1').prop("required", false);
                modal.find('.distributor_price_amount_1').prop("required", true);
            } else {
                modal.find('#type-percentage_1').hide();
                modal.find('#type-amount_1').hide();
                modal.find('.distributor_price_percentage_1').prop("required", false);
                modal.find('.distributor_price_amount_1').prop("required", false);
            }
        });
		</script>