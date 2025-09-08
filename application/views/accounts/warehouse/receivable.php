
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
                                        <h4 class="card-title text-white mb-0">Receivable Records</h4>
                                    </div>
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Batch No. </th>
                                                    <th class="text-center"> Total Quantity </th>
                                                    <th class="text-center"> Total Received </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Endorse By </th>
                                                    <th class="text-center"> Endorse Date </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($products as $i){ ?>

                                                <tr>
                                                    <td class="text-center">  <a href="receivable-details?batch_no=<?= $i->batch_no;?>"><b> <?= $i->batch_no;?> </b></a></td>
                                                    <td class="text-center"> <?= $i->total_quantity;?></td>
                                                    <td class="text-center"> <?= $i->received_quantity;?></td>
                                                    <td class="text-center"> <?= $i->is_complete;?></td>
                                                    <td class="text-center"> <?= $i->endorse_by;?></td>
                                                    <td class="text-center"> <?= $i->endorse_date;?></td>
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
                             
      