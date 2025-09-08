
<style>
  
    .payroll-slip {
      width: auto;
      border: 2px solid black;
      padding: 10px;
    }
    .header {
      text-align: center;
      margin-bottom: 10px;
    }
    .info p {
      margin: 4px 0;
    }
    .section {
      display: flex;
      justify-content: space-between;
      gap: 10px;
    }
    .table1 {
      width: 100%;
      border: 1px solid black;
    }
    .table-header {
      background-color: #f0f0f0;
      font-weight: bold;
      text-align: center;
      padding: 5px;
      border-bottom: 1px solid black;
    }
    .table-row {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid black;
    }
    .cell {
      flex: 1;
      padding: 5px;
      text-align: center;
      border-right: 1px solid black;
    }
    .cell:last-child {
      border-right: none;
    }
    .totals {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      font-weight: bold;
    }
    .net-pay {
      text-align: center;
      margin-top: 10px;
      font-size: 1.2em;
      font-weight: bold;
    }
  </style>
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
                                     <h4> <b><?= $_GET['payroll_date'];?></b> Payroll Records </h4>
                                     <h5> <a href="payroll"> <i class="mdi mdi-chevron-left-circle-outline"> </i> Back </a></h5>

                                  </div>
                                </div><!-- end col-->
                                <div class="col-lg-2 col-md-3 col-sm-3">
                                      <button class="btn btn-outline-dark waves-effect waves-light"   style="width:100%"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Import  Data    </button>                       
                                                  </div>
                                              
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
                                        <h4 class="card-title text-white mb-0">Payroll List</h4>
                                    </div>
                                    
                                    <div class="card-body">


                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Employee Name </th>
                                                    <th class="text-center"> Work Days </th>
                                                    <th class="text-center"> Net Pay  </th>
                                                    <th class="text-center"> Process By   </th>
                                                    <th class="text-center"> Date Added  </th>
                                                    <th class="text-center"> Action  </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                            foreach($payroll as $i){ 
                                                ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->employee_name;?></td>
                                                    <td class="text-center"> <?= $i->work_days;?></td>
                                                    <td class="text-center"> <?= number_format($i->netpay,2);?></td>
                                                    <td class="text-center"> <?= $i->process_by;?></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>
                                               
                                                    <td class="text-center"> 
                                                   
                                                    <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#payslip<?= $i->id;?>"> Payslip </button>                       
                                                     
                                                    </td>
                                                  

                                                </tr>

                                                <div class="modal fade" id="payslip<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="receiptModalLabel"><?= $i->employee_name;?> Payslip</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
                                                                 
																<div class="payslip-container"  id="printDiv<?= $i->id;?>" >

																  <div class="payroll-slip">
																	<div class="header">
																	  <h2>PAYROLL SLIP</h2>
																	</div>
																	<div class="info">
																	  <p>Name: <span style="text-decoration: underline;"><?= $i->employee_name;?></span></p>
																	  <p>Payroll: <?= $_GET['payroll_date'];?></p>
																	  <p>Week:  <?= $_GET['week'];?></p>
																	  <p>Rate: <?= $i->rate;?></p>
																	</div>

																	<div class="section">
																	  <!-- Earnings -->
																	  <div style="width: 48%;">
																		<div class="table1">
																		  <div class="table-header">EARNINGS</div>
																		  <div class="table-row"><div class="cell">Work days</div><div class="cell"> <?= $i->work_days;?></div></div>
																		  <div class="table-row"><div class="cell">SIL</div><div class="cell"> <?= $i->sil;?></div></div>
																		  <div class="table-row"><div class="cell">S. Holiday</div><div class="cell"> <?= $i->holiday_special;?></div></div>
																		  <div class="table-row"><div class="cell">R. Holiday</div><div class="cell"> <?= $i->holiday_regular;?></div></div>
																		  <div class="table-row"><div class="cell">RestDay OT</div><div class="cell"> <?= $i->restday_ot;?></div></div>
																		  <div class="table-row"><div class="cell"><strong>TOTAL DAYS</strong></div><div class="cell"> <?= $i->total_days;?></div></div>
																		  <div class="table-row"><div class="cell">Overtime</div><div class="cell"> <?= $i->overtime;?></div></div>
																		</div>
																	  </div>

																	  <!-- Deductions -->
																	  <div style="width: 48%;">
																		<div class="table1">
																		  <div class="table-header">DEDUCTIONS</div>
																		  <div class="table-row"><div class="cell">Late</div><div class="cell"> <?= $i->late_2;?></div></div>
																		  <div class="table-row"><div class="cell">Cash Adv.</div><div class="cell"> <?= $i->cash_adv;?></div></div>
																		  <div class="table-row"><div class="cell">SSS</div><div class="cell">- <?= $i->sss;?></div></div>
																		  <div class="table-row"><div class="cell">PhilHealth</div><div class="cell"> <?= $i->philhealth;?></div></div>
																		  <div class="table-row"><div class="cell">Pag-Ibig</div><div class="cell"> <?= $i->pagibig;?></div></div>
																		  <div class="table-row"><div class="cell">Credit</div><div class="cell"> <?= $i->credit;?></div></div>
																		  <div class="table-row"><div class="cell">Credit Sisig</div><div class="cell"> <?= $i->credit_sisig;?></div></div>
																		</div>
																	  </div>
																	</div>

																	<div class="totals">
																	  <div>GROSS PAY: <?= $i->grosspay;?></div>
																	  <div>TOTAL DEDUCTION:  <?= $i->late_2 + $i->cash_adv + $i->sss + $i->philhealth + $i->pagibig + $i->credit +  $i->credit_sisig;?></div>
																	</div>

																	<div class="net-pay">
																	  NET PAY: <?= $i->netpay;?>
																	</div>
																  </div>

                                                              
															</div>
															<br>
															  <div class="text-center">
                                                                    <button class="btn btn-outline-dark printBtn" data-id="<?= $i->id;?>"><i class="fas fa-print"></i> Print Payslip</button>
															        <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>

															 </div>
														</div>
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
                        <h5 class="modal-title" id="staticBackdropLabel"> Payroll List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                       <div class="row">
                                            <div class="col-lg-12">

                                                 <form action="<?= base_url("accounting/process-payroll-list");?>" method="POST"  enctype="multipart/form-data" id="process_payroll">
                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <input type="hidden" name="payroll_date" value="<?php echo $_GET['payroll_date']; ?>">
                                                    <input type="hidden" name="week" value="<?php echo $_GET['week']; ?>">
                                                    <input type="hidden" name="data"  value="<?php echo $_GET['data']; ?>">

                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Excel File </label>
                                                        <input type="file" name="csv_file" accept=".csv" required class="form-control" >
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

    <script>
        $(document).ready(function() {
            $(".printBtn").click(function() {
                var id = $(this).data("id");
              
                var printContent = document.getElementById ("printDiv" + id).innerHTML;
                var printWindow = window.open('', '_blank');

                var styles = `
                 <style>
                
                    .payroll-slip {
                    width: auto;
                    border: 2px solid black;
                    padding: 10px;
                    }
                    .header {
                    text-align: center;
                    margin-bottom: 10px;
                    }
                    .info p {
                    margin: 4px 0;
                    }
                    .section {
                    display: flex;
                    justify-content: space-between;
                    gap: 10px;
                    }
                    .table1 {
                    width: 100%;
                    border: 1px solid black;
                    }
                    .table-header {
                    background-color: #f0f0f0;
                    font-weight: bold;
                    text-align: center;
                    padding: 5px;
                    border-bottom: 1px solid black;
                    }
                    .table-row {
                    display: flex;
                    justify-content: space-between;
                    border-bottom: 1px solid black;
                    }
                    .cell {
                    flex: 1;
                    padding: 5px;
                    text-align: center;
                    border-right: 1px solid black;
                    }
                    .cell:last-child {
                    border-right: none;
                    }
                    .totals {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 10px;
                    font-weight: bold;
                    }
                    .net-pay {
                    text-align: center;
                    margin-top: 10px;
                    font-size: 1.2em;
                    font-weight: bold;
                    }
                </style>
                `;

                printWindow.document.write('<html><head><title>Print</title>' + styles + '</head><body>' + printContent + '</body></html>');
                printWindow.document.close();

                printWindow.print();
                printWindow.close(); // Close after printing
            });

           
        });
    </script>