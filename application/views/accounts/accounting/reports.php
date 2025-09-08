


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

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
                                            <h5> Daily Sales Reports  </h5>
										</div>
									</div><!-- end col-->
                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting' ){?> 
                                        <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Reports Record  </button>                       
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
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Daily Sales Reports</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table_id" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Date </th>
                                                    <th class="text-center"> Processed By </th>
                                                    <th class="text-center"> Receipt </th>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting'  ){?> 
                                                        <th class="text-center"> Action </th>
                                                    <?php } ?>
                                                  </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($expenses as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->date_today;?></td>
                                                    <td class="text-center"> <?= $i->process_by;?></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting'){?> 
                                                    <td class="text-center">
                                                    <a href="<?= base_url("accounting/reports-data?id=".$i->id."&date=".$i->date_today);?>" type="button" class="btn btn-outline-dark waves-effect waves-light"  > Reports </a>                       
                                                    <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Delete </button>                       
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                

                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Sales Report - <?= $i->date_today;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("accounting/delete-sales-reports");?>" class="process_delete">
                                                                                        Are you sure to delete this data ?   
                                                                                    
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_delete" >Yes</button>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Daily Sales Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?= base_url("accounting/process-daily-sales");?>" method="POST"  class="process_daily"">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Date </label>
                                                        <input type="date" name="date_today" value="<?= date('Y-m-d');?>" class="form-control" required>
                                                    </div>

                                              
                                              </div> <!-- end col -->
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


       
        <script>
        $(document).ready(function() {

            $(".process_daily").submit(function() {
                $(".btn_process").prop("disabled", true).text("Processing...");
            });

            $(".process_delete").submit(function() {
                $(".btn_delete").prop("disabled", true).text("Processing...");
            });

        });
    </script>

        
<script>
    $(document).ready(function() {
                $('#table_id').DataTable({

                    dom: 'Bfrtip',
                    responsive: true,
                    pageLength: 25,
                    // lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

                    buttons: [
                      
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> CSV',
                            className: 'btn btn-info'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            className: 'btn btn-success'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            className: 'btn btn-danger'
                        },
                       
                    ]

                });
            });
    </script>

