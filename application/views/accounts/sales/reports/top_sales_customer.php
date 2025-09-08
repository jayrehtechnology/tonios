
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
                                    <h5 class="page-title">TONIO'S SISIG DASHBOARD</h5>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
			
                        <!-- end row-->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="get" class="mb-4">
                                            <div class="row align-items-end">
                                                <div class="col-md-2">
                                                    <label for="year">Select Year:</label>
                                                    <select name="year" id="year" class="form-control">
                                                        <?php for ($y = 2022; $y <= date('Y'); $y++): ?>
                                                            <option value="<?= $y ?>" <?= (!isset($_GET['year']) && $y == date('Y')) || (isset($_GET['year']) && $_GET['year'] == $y) ? 'selected' : '' ?>>  <?= $y ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>


                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary w-100 mt-2">Filter Report</button>
                                                </div>
                                            </div>
                                        </form>
    
                                        <h4 class="header-title mb-3"> Top 100 Customer Sales </h4>

                                        <div class="table-responsive">
                                    


                                        <table class="table table-hover table-centered mb-0"  id="table_id">
                                                <thead>
                                                    <tr style="background-color: #004080; color: white;">
                                                        <th class="text-center">Rank</th>
                                                        <th class="text-center">Customer Name</th>
                                                        <th class="text-center">Total Quantity</th>
                                                        <th class="text-center">Total Sales (₱)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($results)): $rank = 1; ?>
                                                        <?php foreach ($results as $row): ?>
                                                            <tr>
                                                                <td class="text-center"><?= $rank++ ?></td>
                                                                <td class="text-center"><?= htmlspecialchars($row->customer_name ?? 'Unknown') ?></td>
                                                                <td class="text-center"><?= number_format($row->total_qty) ?></td>
                                                                <td class="text-center">₱<?= number_format($row->total_sales, 2) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr><td colspan="4" class="text-center">No customer sales data available.</td></tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                           
                    
                        </div>
						

                     
                    </div> <!-- container -->

                </div> <!-- content -->
            </div>

        </div>
        </div>
      
      
        <script>

        $(document).ready(function() {
        $('#table_id').DataTable({

            dom: 'Bfrtip',
            paging: false, // disables pagination
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