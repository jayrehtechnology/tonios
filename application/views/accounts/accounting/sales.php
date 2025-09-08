


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
                                            <h5> Sales  </h5>
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
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Sales Records </h4>
                                    </div>
                                    <div class="card-body">

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Delivered Quantity  </th>
                                                    <th class="text-center"> Returned Quantity  </th>
                                                    <th class="text-center"> Logistics  </th>
                                                    <th class="text-center"> Sales Collected   </th>
                                                    <th class="text-center"> Credits  Sales </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                            $total = 0;
                                            $qty   = 0;

                                            foreach($orders as $i){ 

                                                ?>
                                                <tr>
                                                   <td class="text-center">  <a href="delivered-list?transaction=<?= $i->trans_code;?>&customer=<?= $i->customer_name;?>"><b> <?= $i->trans_code;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= $i->total_delivered;?></td>
                                                    <td class="text-center"> <?= $i->total_return;?></td>
                                                    <td class="text-center"> <?= $i->fullname;?></td>
                                                    <td class="text-center"> <b><?= number_format($i->total_sales,2);?></b></td>
                                                    <td class="text-center"> <b><?= number_format($i->balance,2);?></b></td>

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
      
   

