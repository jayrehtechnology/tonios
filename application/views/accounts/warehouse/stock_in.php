
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
                                            <h5> Warehouse  </h5>
										</div>
									</div><!-- end col-->
                                    
                                 
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Stock In</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Product Name </th>
                                                    <th class="text-center"> Stock  Quantity</th>
                                                    <th class="text-center"> Process By</th>
                                                    <th class="text-center"> Date </th>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Warehouse'){?> 
                                                    <th class="text-center"> Action </th>
                                                    <?php } ?>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($stock_in as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= $i->quantity;?></td>
                                                    <td class="text-center"> <?= $i->firstname .' '. $i->lastname;?></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>
                                                    <?php if($this->session->userdata['logged_in']['department'] == 'Warehouse'){?> 

                                                    <td class="text-center">
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#receive<?= $i->id;?>"> Delete</button>                       
                                                    </td>
                                                    <?php } ?>
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
  