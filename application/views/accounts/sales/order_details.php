
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>

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
                                            <h5> <?= $_GET['customer'];?>  Charity </h5>
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
                              
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0"><?= $_GET['transaction'];?> Order List</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row">
                                           <div class="col-sm-12">
                                           <div class="table-responsive">
                                            <table id="table-order" class="table dt-responsive  dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Product </th>
                                                    <th class="text-center"> Price  </th>
                                                    <th class="text-center"> Quantity </th>
                                                    <th class="text-center"> Total </th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                                $grandtotal = 0;
                                                foreach($orders_list as $i){

                                                $grandtotal += $i->total;

                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product_name;?></td>
                                                    <td class="text-center"> <?= number_format($i->price,2);?></td>
                                                    <td class="text-center"> <?= $i->quantity;?></td>
                                                    <td class="text-center"> <?= number_format($i->total,2);?></td>
                                                
                                                </tr>

                                             <?php } ?>
                                             </tbody>
                                             <tfoot>
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"> </td>
                                              
                                                    <td class="text-center"><h4> GRAND TOTAL</h4> </td>
                                                    <td class="text-center"><h4> <?= number_format($grandtotal,2);?></h4></td>
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
    
   
    
   