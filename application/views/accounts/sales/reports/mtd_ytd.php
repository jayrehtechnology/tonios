
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
                                       
    
                                        <h4 class="header-title mb-3"> Products MTD / YTD Report</h4>
                                        
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

                                        <div class="table-responsive">
                                        <style>
    table.summary-table {
        border-collapse: collapse;
        width: 60%;
        margin: 30px auto;
        font-family: Arial, sans-serif;
        font-size: 18px;
    }
    .summary-table th, .summary-table td {
        border: 2px solid #ffffff;
        padding: 10px 20px;
        text-align: center;
    }
    .summary-table thead th {
        background-color: #002b5c;
        color: white;
    }
    .summary-table tbody tr:nth-child(1),
    .summary-table tbody tr:nth-child(2) {
        background-color: #2e6658;
        color: white;
    }
    .summary-table tbody tr:last-child {
        background-color: white;
        font-weight: bold;
        color: green;
    }
</style>

                                        <table class="summary-table"  id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>YEAR</th>
                                                    <th>MTD SALES</th>
                                                    <th>YTD SALES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $_GET['year'] - 1;?></td>
                                                    <td><?= number_format($mtd_2024) ?></td>
                                                    <td><?= number_format($ytd_2024) ?></td>
                                                </tr>
                                                <tr>
                                                <td><?= $_GET['year'];?></td>
                                                <td><?= number_format($mtd_2025) ?></td>
                                                    <td><?= number_format($ytd_2025) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>GROWTH</td>
                                                    <td><?= number_format($mtd_growth) ?> packs</td>
                                                    <td><?= number_format($ytd_growth) ?> packs</td>
                                                </tr>
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