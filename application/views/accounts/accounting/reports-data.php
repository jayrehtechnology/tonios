


<div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                         <!-- start page title -->
                          <hr>
                         <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
									<div class="col-lg-10 col-md-12 col-sm-12">
										<div class="">
                                            <h2> <b> Daily Sales Reports </b> </h2>
                                            <h3> <b>  DATE : <?= $_GET['date'];?>  </b>  </h3>
                                            <button id="exportAll" class="btn btn-success mb-3">Download All Sales (Excel/PDF)</button>

										</div>
									</div><!-- end col-->
                                 
                                </div>
                            </div>
                        </div>     
                        <hr>
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-6">
                             
                                <div class="card">
                                  
                                    <div class="card-body">

									<h4 class="card-title mb-0">Cash Sales</h4>
                                        <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
										 <div class="row">
                                            <div class="row">
											<div class="col-sm-12">
                                            <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code</th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Mode of Payment </th>
                                                    <th class="text-center"> Amount </th>
                                                  </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $totalcashsales = 0;
                                                foreach($cash as $c){ 
                                                
                                                    $totalcashsales += $c->total_collected;
                                                
                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $c->transcode;?></td>
                                                    <td class="text-center"> <?= $c->customer_name;?></td>
                                                    <td class="text-center"> <?= $c->mop;?></td>
                                                    <td class="text-end"> <?= number_format($c->total_collected,2) ;?></td>
                                                </tr>
                                              
                                            
                                             <?php } ?>
                                             </tbody>
                                             </table>

                                            <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"> <h5><b>TOTAL CASH SALES </b></h5></td>
                                                    <td class="text-end">  <h5><?= number_format($totalcashsales,2) ;?></h5></td>
                                                
                                                  </tr>
                                             </table>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>

                        
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

        </div>
		
		
		  <div class="row">
                            <div class="col-6">
                             
                                <div class="card">
                                  
                                    <div class="card-body">
                                        <h4 class="card-title  mb-0">Non - Cash Sales</h4>

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
										 <div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code</th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Mode of Payment </th>
                                                    <th class="text-center"> Amount </th>
                                                  </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $totalnoncash = 0;
                                                foreach($non_cash as $nc){ 
                                                    
                                                    $totalnoncash +=$nc->total_collected;
                                                    
                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $nc->transcode;?></td>
                                                    <td class="text-center"> <?= $nc->customer_name;?></td>
                                                    <td class="text-center"> <?= $nc->mop;?></td>
                                                    <td class="text-end"> <?= number_format($nc->total_collected,2) ;?></td>
                                                </tr>
                                              
                                            
                                             <?php } ?>
                                             </tbody>
                                             </table>
                                             <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"> <h5><b>TOTAL NON CASH SALES </b></h5></td>
                                                    <td class="text-end">  <h5><?= number_format($totalnoncash,2) ;?></h5></td>
                                                
                                                  </tr>
                                             </table>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>

                        
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

        </div>
		
		
				  <div class="row">
                            <div class="col-6">
                             
                                <div class="card">
                                   
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Credit Sales</h4>

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
										 <div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code</th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Mode of Payment </th>
                                                    <th class="text-center"> Amount </th>
                                                
                                                  </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $totalcreditsales = 0;
                                                foreach($credit_sales as $cs){ 
                                                $totalcreditsales += $cs->total_credit;
                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $cs->transcode;?></td>
                                                    <td class="text-center"> <?= $cs->customer_name;?></td>
                                                    <td class="text-center"> CREDITS </td>
                                                    <td class="text-end"> <?= number_format($cs->total_credit,2) ;?></td>
                                                </tr>
                                              
                                             <?php } ?>
                                             </tbody>
                                             </table>
                                             <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"> <h5><b>TOTAL CREDIT SALES </b></h5></td>
                                                    <td class="text-end">  <h5><?= number_format($totalcreditsales,2) ;?></h5></td>
                                                
                                                  </tr>
                                             </table>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>

                        
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

        </div>
   
    
    	  <div class="row">
                            <div class="col-6">
                             
                                <div class="card">
                                   
                                    <div class="card-body">
											<h4 class="card-title mb-0">Collection</h4>

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
										 <div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Transaction Code</th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Mode of Payment </th>
                                                    <th class="text-center"> Amount </th>
                                                
                                                  </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $totalcollection  = 0;
                                                foreach($collection as $c){ 
                                                    $totalcollection  += $c->total_collected;
                                                    ?>
                                                <tr>
                                                    <td class="text-center"> <?= $c->transcode;?></td>
                                                    <td class="text-center"> <?= $c->customer_name;?></td>
                                                    <td class="text-center"> COLLECTION </td>
                                                    <td class="text-end"> <?= number_format($c->total_collected,2) ;?></td>
                                                </tr>
                                              
                                            
                                             <?php } ?>
                                             </tbody>
                                             </table>
                                             <table id="table_id" class="table nowrap w-100 dataTable no-footer dtr-inline">
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"> <h5><b>TOTAL COLLECTION </b></h5></td>
                                                    <td class="text-end">  <h5><?= number_format($totalcollection,2) ;?></h5></td>
                                                
                                                  </tr>
                                             </table>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>

                        
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

        </div>
       
        <table id="all_sales_export" class="table d-none">
    <thead>
        <tr>
            <th>Type</th>
            <th>Transaction Code</th>
            <th>Customer Name</th>
            <th>Mode of Payment</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cash as $c): ?>
            <tr>
                <td>Cash</td>
                <td><?= $c->transcode; ?></td>
                <td><?= $c->customer_name; ?></td>
                <td><?= $c->mop; ?></td>
                <td><?= number_format($c->total_collected, 2); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($non_cash as $nc): ?>
            <tr>
                <td>Non-Cash</td>
                <td><?= $nc->transcode; ?></td>
                <td><?= $nc->customer_name; ?></td>
                <td><?= $nc->mop; ?></td>
                <td><?= number_format($nc->total_collected, 2); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($credit_sales as $cs): ?>
            <tr>
                <td>Credit</td>
                <td><?= $cs->transcode; ?></td>
                <td><?= $cs->customer_name; ?></td>
                <td>CREDITS</td>
                <td><?= number_format($cs->total_credit, 2); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($collection as $c): ?>
            <tr>
                <td>Collection</td>
                <td><?= $c->transcode; ?></td>
                <td><?= $c->customer_name; ?></td>
                <td>COLLECTION</td>
                <td><?= number_format($c->total_collected, 2); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
$(document).ready(function () {
    var exportTable = $('#all_sales_export').DataTable({
        dom: 'Bfrtip',
        paging: false,
        searching: false,
        ordering: false,
        info: false,
        buttons: ['excel', 'pdf']
    });

    // Hide the export buttons
    $('.dt-buttons').hide();

    // Trigger export when button is clicked
    $('#exportAll').on('click', function () {
        // You can change to 'pdf' or 'excel' here
        exportTable.button('.buttons-excel').trigger();
        // Or use: exportTable.button('.buttons-pdf').trigger();
    });
});
</script>
