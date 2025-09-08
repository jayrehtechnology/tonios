
<script src="https://code.highcharts.com/highcharts.js"></script>
<style>
.red-bg{
    background-color:#fff;
    color: #00000;
}
.text-dark{
    color: #0000 !important;
}
</style>
 
            <div class="flex w-full">
                <div class="px-6 pt-6 2xl:container">
                <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h2 class="page-title">TONIO'S SISIG DASHBOARD</h2>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                         <hr>
						<?php if($this->session->userdata['logged_in']['department'] == 'Warehouse' || $this->session->userdata['logged_in']['department'] == 'Sales' || $this->session->userdata['logged_in']['department'] == 'Administrator'){?> 

                         <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="avatar-lg text-center bg-light rounded-circle">
                                               <i class="fe-clipboard avatar-title  font-28 text-black"></i>
                                            </div>
                                            <div class="text-end">
                                                <p class="text-uppercase"> Order Transactions</p>
                                                <h2 class="mb-0"><span data-plugin="counterup"><?= $order_transactions;?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="bg-icon avatar-lg text-center bg-light rounded-circle">
                                             <i class="fe-check-circle avatar-title  font-28 text-black"></i>
                                            </div>
                                            <div class="text-end">
                                                <p class="text-uppercase">Product Sold</p>
                                                <h2 class="mb-0"><span data-plugin="counterup"><?= $product_sold->delivered_quantity;?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="bg-icon avatar-lg text-center bg-light rounded-circle">
                                            <i class="fe-heart-on avatar-title  font-28 text-black"></i>
                                            </div>
                                            <div class="text-end">
                                            <p class="text-uppercase">Charity / Donations</p>
                                            <h2 class="mb-0"><span data-plugin="counterup"><?= $charity_donation->total_charity;?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="bg-icon avatar-lg text-center bg-light rounded-circle">
                                            <i class="fe-users avatar-title  font-28 text-black"></i>
                                            </div>
                                            <div class="text-end">
                                                <p class="text-uppercase">Total Customers</p>
                                                <h2 class="mb-0"><span data-plugin="counterup"><?= $total_customers->total_customer;?></span></h2>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            
                        <div class="col-md-6 col-xl-4">
                        <div class="widget-rounded-circle card red-bg shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-alert-circle-outline font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-black mt-2"><span data-plugin="counterup"><?= $pending;?></span></h2>
                                                    <p class="text-black mb-0 text-truncate">PENDING ORDERS</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-check-circle font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup"><?= $approved;?></span></h2>
                                                <p class="text-black mb-0 text-truncate">APPROVED ORDERS</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-chevron-right-circle-outline font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup"><?= $fordelivery;?></span></h2>
                                                <p class="text-black mb-0 text-truncate">FOR DELIVERY ORDERS</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-arrow-bottom-right-thin-circle-outline font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup"><?= $logistics;?></span></h2>
                                                <p class="text-black mb-0 text-truncate">IN TRANSIT ORDERS</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                <i class="mdi mdi-check-decagram font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup"><?= $delivered;?></span></h2>
                                                <p class="text-black mb-0 text-truncate">DELIVERED ORDERS</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-keyboard-return font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup"><?= $returned->total_return;?></span></h2>
                                                <p class="text-black mb-0 text-truncate">PRORUCT DELIVERY RETURNED</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->


                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-arrow-left-bold-circle-outline font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup">0</span></h2>
                                                <p class="text-black mb-0 text-truncate">PULL OUT PRODUCTS</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->


                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-arrow-left-bold-circle-outline font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup">0</span></h2>
                                                <p class="text-black mb-0 text-truncate">DISPOSED PRODUCTS</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card red-bg shadow-none">
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="mdi mdi-arrow-left-bold-circle-outline font-28 avatar-title text-black"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                <h2 class="text-black mt-2"><span data-plugin="counterup">0</span></h2>
                                                <p class="text-black mb-0 text-truncate">PULL OUT RETURNED TO INVENTORY </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->



                        </div>
						<?php } ?>
                        <!-- end row-->
						<?php if($this->session->userdata['logged_in']['department'] == 'Accounting' || $this->session->userdata['logged_in']['department'] == 'Administrator'){?> 
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                       
    
                                        <h4 class="header-title mb-3"> Products Report</h4>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Product Name</th>
                                                        <th class="text-center">Total Sold Quantity</th>
                                                        <th class="text-center">Total Sales</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($products_reports as $pr){ ?>
                                                    <tr>
                                                        <td class="text-center"><b><?= $pr->product_name;?></b></td>
                                                        <td class="text-center"><?= $pr->total_qty;?></td>
                                                        <td class="text-center"> <?= number_format($pr->total_sum,2);?></td>
                                                    </tr>
                                                   
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table responsive-->
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <h4 class="header-title mb-3">Accounting</h4>

                                        <div class="align-items-center border-bottom border-light pb-2 mb-1">
                                            <h3 class="float-end my-2 py-1"><?= number_format($report_sales->total_sales,2);?></h3>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-md rounded-circle bg-soft-info">
                                                    <i class="fe-bar-chart-line- font-26 avatar-title text-info"></i>
                                                </div>
                                                
                                                <div class="ms-2">
                                                    <h5 class="mb-1 mt-0 fw-bold">Total Sales</h5>
                                                    <p class="text-muted mb-0"></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="align-items-center border-bottom border-light pb-2 mb-1">
                                            <h3 class="float-end my-2 py-1"><?= number_format($credits_sales->total_credit,2);?></h3>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-md rounded-circle bg-soft-info">
                                                    <i class="fe-clipboard font-26 avatar-title text-info"></i>
                                                </div>
                                                
                                                <div class="ms-2">
                                                    <h5 class="mb-1 mt-0 fw-bold">Total Credit Sales</h5>
                                                    <p class="text-muted mb-0"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="align-items-center border-bottom border-light pb-2 mb-1">
                                            <h3 class="float-end my-2 py-1"><?= number_format($reports_collections->total_collected,2);?></h3>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-md rounded-circle bg-soft-info">
                                                    <i class="fe-check-circle font-26 avatar-title text-info"></i>
                                                </div>
                                                
                                                <div class="ms-2">
                                                    <h5 class="mb-1 mt-0 fw-bold">Total Collections</h5>
                                                    <p class="text-muted mb-0"></p>
                                                </div>
                                            </div>
                                        </div>

                                     


                                        <div class="align-items-center border-bottom border-light py-2 my-1">
                                        <h3 class="float-end my-2 py-1"><?= number_format($report_expenses->total_expenses,2);?></h3>
                                        <div class="d-flex align-items-center">
                                                <div class="avatar-md rounded-circle bg-soft-warning">
                                                    <i class="fe-book-open font-26 avatar-title text-warning"></i>
                                                </div>
                                                
                                                <div class="ms-2">
                                                    <h5 class="mb-1 mt-0 fw-bold">Total Expenses</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="align-items-center border-bottom border-light py-2 my-1">
                                        <h3 class="float-end my-2 py-1"><?= number_format($report_reimbursement->total_reimbursement,2);?></h3>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-md rounded-circle bg-soft-pink">
                                                    <i class="fe-book font-26 avatar-title text-pink"></i>
                                                </div>
                                                
                                                <div class="ms-2">
                                                <h5 class="mb-1 mt-0 fw-bold">Total Reimbursement</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="align-items-center pt-2 mt-1">
                                        <h3 class="float-end my-2 py-1"><?= number_format($report_payroll->total_netpay,2);?></h3>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-md rounded-circle bg-soft-dark">
                                                <i class="fe-database font-26 avatar-title text-info"></i>
                                                </div>
                                                
                                                <div class="ms-2">
                                                    <h5 class="mb-1 mt-0 fw-bold">Payroll</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
						<div class="row">
						
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                     
                                        <div dir="ltr">
											<div id="sales-chart" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col-->
							
							
							  <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                     
                                        <div dir="ltr">
											<div id="sales-chart-1" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col-->
							

                        </div>
						
						<?php } ?>

                     
                    </div> <!-- container -->

                </div> <!-- content -->
            </div>

        </div>
        </div>
        <?php
       
        foreach($get_monthly_sales as $val => $res){
            $month[]  =  $val;
            $value1[] =  $res;
        }


        foreach($get_monthly_expenses as $val => $res){
            $month[]  =  $val;
            $value2[] =  $res;
        }


    ?>

        <script type="text/javascript">
        // Prepare the data for Highcharts
        var salesData = <?php echo json_encode($sales); ?>;
        var categories = [];
        var sales = [];

        // Loop through the sales data and prepare categories and sales arrays
        for (var i = 0; i < salesData.length; i++) {
            categories.push(salesData[i].product_name);
            sales.push(parseFloat(salesData[i].total_sum));
        }

        // Highcharts configuration
        Highcharts.chart('sales-chart', {
            chart: {
                type: 'column'  // Column chart
            },
            title: {
                text: 'Product Sales'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Product'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Sales'
                }
            },
            series: [{
                name: 'Sales',
                data: sales
            }]
        });
    </script>

   
   <script>
	Highcharts.chart('sales-chart-1', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Sales Vs. Expenses (Monthly)'
		},
	
		xAxis: {
			categories: <?php echo json_encode($month);?>
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Data'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
			}
		},
		plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
		},
		series: [{
			name: 'Sales',
			 data: <?php echo json_encode($value1,JSON_NUMERIC_CHECK);?>
		},{
			name: 'Expenses',
			 data: <?php echo json_encode($value2,JSON_NUMERIC_CHECK);?>
		}]
	});

 </script>