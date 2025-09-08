
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
                                            <h5> Production  </h5>
										</div>
									</div><!-- end col-->
                                    <?php if($this->session->userdata['logged_in']['department'] == 'Production Planning' || $this->session->userdata['logged_in']['department'] == 'Production' ){?> 
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Expenses Record  </button>                       
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Expenses Reports</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Title </th>
                                                    <th class="text-center"> Amount </th>
                                                    <th class="text-center"> Description</th>
                                                    <th class="text-center"> Receipt </th>
                                                    <th class="text-center"> Date Added </th>

                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($expenses as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->title;?></td>
                                                    <td class="text-center"> <?= number_format($i->amount,2);?></td>
                                                    <td class="text-center"> <?= $i->description;?></td>
                                                    <td class="text-center"> <a href="#"  data-bs-toggle="modal" data-bs-target="#receipt<?= $i->id;?>"> Receipt </a></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Delete </button>                       
                                                    </td>
                                                </tr>
                                                
                                                <div class="modal fade" id="receipt<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Receipt</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                   <img src="<?= base_url();?>/assets/expenses/receipt/<?= $i->receipt;?>" width="250px;">
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <a href="<?= base_url();?>/assets/expenses/receipt/<?= $i->receipt;?>" type="button" class="btn btn-outline-dark waves-effect waves-light" download>Download</a>
                                                            </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("production/delete-expenses-reports");?>">
                                                                                        Are you sure to delete this data ?   
                                                                                    
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Expenses Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?= base_url("production/process-expenses-reports");?>" method="POST"  enctype="multipart/form-data" id="test">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Title </label>
                                                        <input type="text" name="title" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Amount</label>
                                                        <input type="text" placeholder="" name="amount" class="form-control " value="" fdprocessedid="26svpg">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Description</label>
                                                        <textarea type="text" name="description"  class="form-control" required></textarea>
                                                    </div>

                                                    
                                                    <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Category  </label>
                                                            <select type="text" name="category" class="form-control" required>

                                                                <option value=""> - Select Category - </option>
                                                                <option> Raw Materials </option>
                                                                <option> Production Supply </option>
                                                            

                                                            </select>
                                                        </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Receipt </label>
                                                        <input type="file" name="file"class="form-control" accept="image/x-png,image/jpeg" required>
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


       
