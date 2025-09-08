
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
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Sales Agent </button>                       
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Agent List</h4>
                                    </div>
                                    <div class="card-body">

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>

                                                    <th class="text-center"> ID No </th>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Contact  </th>
                                                    <th class="text-center"> Email </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($agent as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->id_no;?></td>
                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <td class="text-center"> <?= $i->contact_no;?></td>
                                                    <td class="text-center"> <?= $i->email;?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $i->id;?>"> Update </button>                       
                                                        <?php if($i->is_system == 1) { ?>
                                                            <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#deactivate<?= $i->id;?>"> Deactivate </button>                       
                                                        <?php }  else { ?>
                                                            <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#activate<?= $i->id;?>"> Activate </button>                       
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                
                                                   
                                                    <div class="modal fade" id="update<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel"> Sales Agent Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">

                                                                                            <form action="<?= base_url("sales/update-sales-agent");?>" method="POST"  enctype="multipart/form-data" id="test">
                                                                                                <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                                <input type="hidden" name="id"  value="<?php echo $i->id; ?>">
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
                                                                                                        <input type="text" name="contact_no" class="form-control"  value="<?= $i->contact_no;?>" required>
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="simpleinput" class="form-label">Email Address </label>
                                                                                                        <input type="email" name="email" class="form-control"  value="<?= $i->email;?>"  required>
                                                                                                    </div>

                                                                                                    
                                                                                                    <div class="mb-3">
                                                                                                        <label for="simpleinput" class="form-label">Gender  </label>
                                                                                                        <select type="text" name="gender" class="form-control" required>
                                                                                                            <option value=""> - Select Gender - </option>
                                                                                                            <option value="Male" <?php if($i->gender == 'Male'){ echo 'selected';} else {} ?>> Male </option>
                                                                                                            <option value="Female" <?php if($i->gender == 'Male'){ echo 'Female';} else {} ?>>  Female </option>
                                                                                                        </select>
                                                                                                    </div>

                                                                                                

                                                                                            </div>

                                                                                            <div class="col-6">

                                                                                                    <div class="mb-3">
                                                                                                        <label for="simpleinput" class="form-label"> Age </label>
                                                                                                        <input type="text" name="age" class="form-control"  value="<?= $i->age;?>"  required>
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="simpleinput" class="form-label"> Birth Date </label>
                                                                                                        <input type="date" name="birthdate" class="form-control" value="<?= $i->birthdate;?>"  required>
                                                                                                    </div>


                                                                                                    <div class="mb-3">
                                                                                                        <label for="simpleinput" class="form-label"> Contact Incase of Emergency </label>
                                                                                                        <input type="text" name="incase_emegency" class="form-control"  value="<?= $i->incase_emegency;?>" required>
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="simpleinput" class="form-label"> Date Hired</label>
                                                                                                        <input type="date" name="date_hired" class="form-control"   value="<?= $i->date_hired;?>" required>
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="example-email" class="form-label"> Address</label>
                                                                                                        <textarea type="text" name="address"  class="form-control" value="" required><?= $i->address;?></textarea>
                                                                                                    </div>

                                                                                                    

                                                                                                    
                                                                                                </div>

                                                                                        </div>


                                                                                        
                                                                                        
                                                                                        </div> <!-- end col -->
                                                                                    </div>                                
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Process</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>

                                              

                                                <div class="modal fade" id="deactivate<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">De-activate</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("sales/deactivate-sales-agent");?>">
                                                                                        Are you sure to deactivate this sale agent account ?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade" id="activate<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Activate</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("sales/activate-sales-agent");?>">
                                                                                        Are you sure to activate this sale agent account ?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Yes</button>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Sales Agent Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                 <form action="<?= base_url("sales/process-sales-agent");?>" method="POST"  enctype="multipart/form-data" id="test">
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
                                                            <label for="example-email" class="form-label"> Address</label>
                                                            <textarea type="text" name="address"  class="form-control" required></textarea>
                                                        </div>

                                                        

                                                        
                                                    </div>

                                               </div>


                                              
                                              
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>

    