


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
                                            <h5> Reimbursement  </h5>
										</div>
									</div><!-- end col-->
                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting' || $this->session->userdata['logged_in']['department']  == 'HR' ){?> 
                                        <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Add Reimbursement Record  </button>                       
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
                                        <h4 class="card-title text-white mb-0">Reimbursement Reports</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table_id" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Title </th>
                                                    <th class="text-center"> Amount </th>
                                                    <th class="text-center"> Description</th>
                                                    <th class="text-center"> Receipt </th>
                                                    <th class="text-center"> Date Added </th>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting' || $this->session->userdata['logged_in']['department']  == 'HR' ){?> 
                                                        <th class="text-center"> Action </th>
                                                    <?php } ?>
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
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Accounting' || $this->session->userdata['logged_in']['department']  == 'HR' ){?> 
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Delete </button>                       
                                                    </td>
                                                    <?php } ?>
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
                                                                                   <img src="<?= base_url();?>/assets/reimbursement/<?= $i->receipt;?>" width="250px;">
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Reimbursement Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?= base_url("accounting/process-reimbursement");?>" method="POST"  enctype="multipart/form-data" class="process_expenses">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Title </label>
                                                        <input type="text" name="title" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Amount</label>
                                                        <input type="text" placeholder="" name="amount" class="form-control " value="" fdprocessedid="26svpg" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-email" class="form-label">Description</label>
                                                        <textarea type="text" name="description"  class="form-control" required></textarea>
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
                        <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_expenses">Process</button>
                    </div>
                </form>
            </div>
           </div>
        </div>


       
        <script>
        $(document).ready(function() {

            $(".process_expenses").submit(function() {
                $(".btn_expenses").prop("disabled", true).text("Processing...");
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

