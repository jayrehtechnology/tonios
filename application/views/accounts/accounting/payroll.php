
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
                                     <h5> Payroll Records </h5>
                                  </div>
                                </div><!-- end col-->
                                <?php if($this->session->userdata['logged_in']['department'] == 'Accounting' || $this->session->userdata['logged_in']['department']  == 'HR' ){?> 
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Payroll Data    </button>                       
                                      </div>
                                      <?php } ?>
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
                                        <h4 class="card-title text-white mb-0">Payroll Record</h4>
                                    </div>
                                    
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Title </th>
                                                    <th class="text-center">  Date </th>
                                                    <th class="text-center"> Week  </th>
                                                    <th class="text-center"> Process By   </th>
                                                    <th class="text-center"> Date Added  </th>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting' || $this->session->userdata['logged_in']['department']  == 'HR' ){?> 
                                                        <th class="text-center"> Action  </th>
                                                        <?php } ?>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                            foreach($payroll as $i){ 
                                                ?>
                                                <tr>
                                                   <td class="text-center">  <b> <?= $i->payroll_title;?> </b></td>
                                                    <td class="text-center"> <?= $i->payroll_date;?></td>
                                                    <td class="text-center"> <?= $i->week;?></td>
                                                    <td class="text-center"> <?= $i->process_by;?></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>
                                               
                                                    <td class="text-center"> 
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting' || $this->session->userdata['logged_in']['department']  == 'HR' ){?> 
                                                        <a href="payroll-list?payroll_date=<?= $i->payroll_date;?>&week=<?= $i->week;?>&data=<?= $i->id;?>" type="button" class="btn btn-outline-dark waves-effect waves-light"  > Process to Payroll </a>                       
                                                    <?php } ?>
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

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"> Payroll Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                 <form action="<?= base_url("accounting/process-payroll");?>" method="POST"  enctype="multipart/form-data" id="process_payroll">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Payroll Title </label>
                                                        <input type="text" name="title" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Payroll Date</label>
                                                        <input type="text" name="date" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Payroll Week</label>
                                                        <input type="text" name="week" class="form-control" required>
                                                    </div>

                                                 
                                              
                                              
                                              </div> <!-- end col -->
                                        </div>                                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process-payroll">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>

    
        <script>
        $(document).ready(function() {

            $("#process_payroll").submit(function() {
                $("#btn-process-payroll").prop("disabled", true).text("Processing...");
            });

        });
    </script>

  