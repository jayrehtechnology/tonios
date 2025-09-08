
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
                                            <h5> Employee Records </h5>
										</div>
									</div><!-- end col-->
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Employee Data    </button>                       
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
                                        <h4 class="card-title text-white mb-0">Employee List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row">
                                                <div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> ID No. </th>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Contact  </th>
                                                    <th class="text-center"> Email </th>
                                                    <th class="text-center"> Position </th>
                                                    <th class="text-center"> Department </th>
                                                    <th class="text-center"> Access </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($customer as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->id_no;?></td>
                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <td class="text-center"> <?= $i->contact_no;?></td>
                                                    <td class="text-center"> <?= $i->email;?></td>
                                                    <td class="text-center"> <?= $i->position;?></td>
                                                    <td class="text-center"> <?= $i->department ;?></td>
                                                    <td class="text-center"> <?php if($i->is_system == 1){ echo "System Access";} else { echo "No Access";}?></td>

                                                    <td class="text-center">
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $i->id;?>"> Update </button>                       
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Delete </button>                       
                                                    </td>
                                                </tr>
                                                
                                                <div class="modal fade" id="update<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Inventory</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <form action="<?= base_url("employees/process-update-employee");?>" method="POST"  enctype="multipart/form-data" class="process_update">
                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                        <input type="hidden" name="id"  value="<?= $i->id;?>">
                                                                        <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label">ID No. </label>
                                                                                <input type="text" name="id_no" class="form-control" value="<?= $i->id_no;?>" required>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label">Full Name </label>
                                                                                <input type="text" name="full_name" class="form-control" value="<?= $i->fullname;?>" required>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label"> Contact No. </label>
                                                                                <input type="text" name="contact_no" class="form-control" value="<?= $i->contact_no;?>" required>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label">Email Address </label>
                                                                                <input type="email" name="email" class="form-control" value="<?= $i->email;?>" required>
                                                                            </div>

                                                                            
                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label">Gender  </label>
                                                                                <select type="text" name="gender" class="form-control" required>
                                                                                    <option value=""> - Select Gender - </option>
                                                                                    <option value="Male" <?php if($i->gender == "Male") { echo "selected";}else {};?>> Male </option>
                                                                                    <option value="Female" <?php if($i->gender == "Female") { echo "selected";}else {};?>> Female </option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="example-email" class="form-label"> Address</label>
                                                                                <textarea type="text" name="address"  class="form-control" required><?= $i->address;?></textarea>
                                                                            </div>


                                                                    </div>

                                                                    <div class="col-6">

                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label"> Age </label>
                                                                                <input type="text" name="age" class="form-control"  value="<?= $i->age;?>" required>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label"> Birth Date </label>
                                                                                <input type="date" name="birthdate" class="form-control"  value="<?= $i->birthdate;?>" required>
                                                                            </div>


                                                                        

                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label"> Contact Incase of Emergency </label>
                                                                                <input type="text" name="incase_emegency" class="form-control" value="<?= $i->incase_emegency;?>" required>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label"> Date Hired</label>
                                                                                <input type="date" name="date_hired" class="form-control"  value="<?= $i->date_hired;?>" required>
                                                                            </div>
                                                                            
                                                                            <div class="mb-3">
                                                                                <label for="simpleinput" class="form-label">Department  </label>
                                                                                <select type="text" name="department" class="form-control department" required>

                                                                                    <option value=""> - Select Department - </option>
                                                                                    <option value="Operation Management" <?php if($i->department == "Operation Management") { echo "selected";}else {};?>> Operation Management </option>
                                                                                    <option value="Sales" <?php if($i->department == "Sales") { echo "selected";}else {};?>> Sales </option>
                                                                                    <option value="Warehouse" <?php if($i->department == "Warehouse") { echo "selected";}else {};?>> Warehouse </option>
                                                                                    <option value="Accounting" <?php if($i->department == "Accounting") { echo "selected";}else {};?>> Accounting </option>
                                                                                    <option value="HR" <?php if($i->department == "HR") { echo "selected";}else {};?>> HR </option>
                                                                                    <option value="Production" <?php if($i->department == "Production") { echo "selected";}else {};?>> Production </option>
                                                                                    <option value="Production" <?php if($i->department == "Production Planning") { echo "selected";}else {};?>> Production Planning </option>
                                                                                    <option value="Logistics" <?php if($i->department == "Logistics") { echo "selected";}else {};?>> Logistics </option>

                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="mb-3 positions" <?php if($i->department != "Sales") {?> style="display:none;" <?php } else {}?>>
                                                                                <label for="simpleinput" class="form-label"> Position </label>
                                                                                <select type="text" name="position"  class="form-control" >

                                                                                    <option value=""> - Select Position - </option>
                                                                                    <option value="Manager" <?php if($i->position == "Manager") { echo "selected";}else {};?>> Manager </option>
                                                                                    <option value="Sales Agent" <?php if($i->position == "Sales Agent") { echo "selected";}else {};?>> Sales Agent </option>
                                                                                    <option value="Telemarketing" <?php if($i->position == "Telemarketing") { echo "selected";}else {};?>>Telemarketing</option>
                                                                                </select>
                                                                            </div>

                                                                            <?php if($i->is_system == "1") { ?>
                                                                            <div class="mb-3">
                                                                                <input type="checkbox" name="system_access"  value="1" <?php if($i->is_system == "1") { echo "checked";}else {};?>>
                                                                                System Access

                                                                            </div>

                                                                            <?php } ?>
                                                                            
                                                                        </div>

                                                                </div>


                                                                
                                                                
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
                                                                <h5 class="modal-title" id="staticBackdropLabel">Delete Employee</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("employees/delete-employees");?>" class="process_delete">
                                                                                        Are you sure to delete this employee data ?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_delete"">Yes</button>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Employee Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                 <form action="<?= base_url("employees/process-employee");?>" method="POST"  enctype="multipart/form-data" id="process_add">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">ID No. </label>
                                                            <input type="text" name="id_no" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Full Name </label>
                                                            <input type="text" name="full_name" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label"> Contact No. </label>
                                                            <input type="text" name="contact_no" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Email Address </label>
                                                            <input type="email" name="email" class="form-control" required>
                                                        </div>

                                                        
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Gender  </label>
                                                            <select type="text" name="gender" class="form-control" required>
                                                                <option value=""> - Select Gender - </option>
                                                                <option value="Male"> Male </option>
                                                                <option value="Female"> Female </option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="example-email" class="form-label"> Address</label>
                                                            <textarea type="text" name="address"  class="form-control" required></textarea>
                                                        </div>


                                                   </div>

                                                   <div class="col-6">

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label"> Age </label>
                                                            <input type="text" name="age" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label"> Birth Date </label>
                                                            <input type="date" name="birthdate" class="form-control" required>
                                                        </div>

                                                      

                                                      

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label"> Contact Incase of Emergency </label>
                                                            <input type="text" name="incase_emegency" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label"> Date Hired</label>
                                                            <input type="date" name="date_hired" class="form-control" required>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Department  </label>
                                                            <select type="text" name="department" id="department" class="form-control" required>

                                                                <option value=""> - Select Department - </option>
                                                                <option value="Operation Management"> Operation Management </option>
                                                                <option value="Sales"> Sales </option>
                                                                <option value="Warehouse"> Warehouse </option>
                                                                <option value="Accounting"> Accounting </option>
                                                                <option value="HR"> HR </option>
                                                                <option value="Production"> Production </option>
                                                                <option value="Production"> Production Planning </option>
                                                                <option value="Logistics"> Logistics </option>

                                                            </select>
                                                        </div>

                                                        <div class="mb-3" id="positions" style="display:none;">
                                                            <label for="simpleinput" class="form-label"> Position </label>
                                                            <select type="text" name="position"  class="form-control" id="sales-position">

                                                                <option value=""> - Select Position - </option>
                                                                <option value="Manager"> Manager </option>
                                                                <option value="Sales Agent"> Sales Agent </option>
                                                                <option value="Telemarketing">Telemarketing</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="checkbox" name="system_access"  value="1">
                                                            System Access

                                                        </div>
                                                        
                                                    </div>

                                               </div>


                                              
                                              
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process-add">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>


        <script>
            $(document).ready(function() {

                $(".process_delete").submit(function() {
                    $(".btn_delete").prop("disabled", true).text("Deleting...");
                });

                $("#process_add").submit(function() {
                    $("#btn-process-add").prop("disabled", true).text("Processing...");
                });

                $(".process_update").submit(function() {
                    $(".btn_update").prop("disabled", true).text("Processing...");
                });

            });
        </script>
        <script>
        $('#department').on('change', function () {
            var selectedValue = $(this).val();
            if(selectedValue == 'Sales'){
                $("#positions").show();
                $("#sales-position").prop("required", true);
            } else {
                $("#positions").hide();
                $("#sales-position").prop("required", false);
            }
        });
        </script>

        <script>
        $('.department').on('change', function () {
            var selectedValue = $(this).val();
            if(selectedValue == 'Sales'){
                $(".positions").show();
            } else {
                $(".positions").hide();
            }
        });
        </script>