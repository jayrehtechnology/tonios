
    <!-- body start -->
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
    <div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

       
    
         
    
            <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?= base_url();?>assets/images/default.png" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                        <?=  $this->session->userdata['logged_in']['name'];?> (<b><?=  $this->session->userdata['logged_in']['department'];?></b> - <?=  $this->session->userdata['logged_in']['position'];?>) <i class="mdi mdi-chevron-down"></i> 
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    
                        <!-- item-->
                        <a href="<?= base_url('logout');?>" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>
    
        
        </ul>
    
        <!-- LOGO -->
        <div class="logo-box">
                <a href="#" class="logo logo-dark text-center">
                    <span class="logo-sm">
                    <img src="<?= base_url();?>assets/images/hero.png" alt="profile Pic" height="50">
                        <!-- <span class="logo-lg-text-light">Codefox</span> -->
                    </span>
                    <span class="logo-lg">
                    <img src="<?= base_url();?>assets/images/tonios.png" alt="profile Pic" height="65">
                        <!-- <span class="logo-lg-text-light">U</span> -->
                    </span>
                </a>

                <a href="#" class="logo logo-light text-center">
                    <span class="logo-sm">
                    <img src="<?= base_url();?>assets/images/hero.png" alt="profile Pic" height="50">
                    </span>
                    <span class="logo-lg">
                    <img src="<?= base_url();?>assets/images/tonios.png" alt="profile Pic" height="65">
                    </span>
                </a>
            </div>
    
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>   
            
       
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>

                           <?php if($this->session->userdata['logged_in']['department'] == 'Administrator'){?> 

                            <li>
                                <a class="nav-link" href="<?= base_url('dashboard');?>">
                                    <i class="mdi mdi-home me-1"></i> Dashboard
                                </a>
                            </li>

                            <li>
                                <a href="#sidebarEmail" data-bs-toggle="collapse">
                                    <i class="mdi mdi-clipboard-outline"></i>
                                    <span> Orders </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmail">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="<?= base_url('orders/pending');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Pending</a>
                                        </li>
                                        <li>
                                          <a href="<?= base_url('orders/approved');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Approved</a>
                                        </li>
                                        <li>
                                           <a href="<?= base_url('orders/fordelivery');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> For Delivery</a>
                                        </li>
                                        <li>
                                           <a href="<?= base_url('orders/logistics');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Logistics</a>
                                        </li>
                                        <li>
                                          <a href="<?= base_url('orders/delivered');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Delivered</a>
                                        </li>
                                        <li>
                                           <a href="<?= base_url('orders/returned');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Returned</a>
                                        </li>
                                        <li>
                                           <a href="<?= base_url('orders/pull-out');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Pull Out</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a class="nav-link" href="<?= base_url('customers');?>">
                                    <i class="mdi mdi-account-group me-1"></i> Customers
                                </a>
                            </li>

                            <li>
                            <a class="nav-link" href="<?= base_url('sales/charity');?>">
                                <i class="mdi mdi-charity me-1"></i> Charity / Donations
                                </a>
                            </li>

                            <li>
                                <a class="nav-link" href="<?= base_url('products');?>">
                                    <i class="mdi mdi-clipboard-check-outline me-1"></i> Products
                                </a>
                            </li>

                            <li>
                                        <a href="#sidebarProductSales" data-bs-toggle="collapse">
                                            <i class="mdi mdi-chart-box-outline"></i>
                                            <span> Products Sales </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarProductSales">
                                            <ul class="nav-second-level">
                                                <li>
                                                <a href="<?= base_url('sales/monthly');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Monthly Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/mtd-ytd');?>?year=<?=date('Y');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> MTD  / YTD Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/daily-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Daily Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/quarterly-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Quaterly Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/customer-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Sales by Customer</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/top-customer-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Top Customer Sales</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                            <li>
                                <a class="nav-link" href="<?= base_url('warehouse/pulled-out');?>">
                                  <i class="mdi mdi-arrow-left-bold-circle-outline me-1"></i> Pulled Out
                                </a>
                            </li>

                            <li>
                                    <a class="nav-link" href="<?= base_url('sales/collection');?>">
                                        <i class="mdi mdi-account-reactivate-outline me-1"></i> Credits Collection
                                        </a>
                             </li>
                                

                            <li>
                                <a href="#sidbarAccounting" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-box-outline"></i>
                                    <span> Accounting </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidbarAccounting">
                                    <ul class="nav-second-level">
                                        <li>
                                        <a href="<?= base_url('accounting/sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Sales</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('accounting/expenses');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Expenses</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('accounting/reimbursement');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Reimbursement</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('accounting/payroll');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Payroll</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('accounting/collection');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Collection</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="#sidebarMultilevel" data-bs-toggle="collapse" class="" aria-expanded="true">
                                    <i class="mdi mdi-account-supervisor-outline"></i>
                                    <span> Production </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse " id="sidebarMultilevel" style="">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="#sidebarMultilevel3" data-bs-toggle="collapse" class="" aria-expanded="true">
                                                 Planning Control <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse show" id="sidebarMultilevel3" style="">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="<?= base_url('production/inventory');?>">Inventory</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url('production/inventory/in');?>">Restocks Reports</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url('production/inventory/out');?>">Out Stocks Reports</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url('production/expenses');?>">Expenses</a>
                                                    </li>
                                                   
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="#sidebarMultilevel4" data-bs-toggle="collapse" class="" aria-expanded="true">
                                                 Production Area <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse show" id="sidebarMultilevel4" style="">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="<?= base_url('production/inventory/endorsed');?>">Inventory</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url('production/inventory/finish-products');?>">Finish Products</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url('production/expenses');?>">Expenses</a>
                                                    </li>
                                                   
                                                   
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="#sidbarWarehouse" data-bs-toggle="collapse">
                                    <i class="mdi mdi-warehouse"></i>
                                    <span> Warehouse </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidbarWarehouse">
                                    <ul class="nav-second-level">
                                        <li>
                                        <a href="<?= base_url('warehouse/inventory');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> In Stock</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('warehouse/stock-out');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Out Stock</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('warehouse/stock-in');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Received Stock</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('warehouse/receivable');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Receivable</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('warehouse/expenses');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Expenses</a>
                                        </li>
                                      
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidbarLogistics" data-bs-toggle="collapse">
                                    <i class="mdi mdi-truck"></i>
                                    <span> Logistics </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidbarLogistics">
                                    <ul class="nav-second-level">
                                        <li>
                                        <a href="<?= base_url('logistics/delivery');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> For Delivery</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('logistics/delivered');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Delivered</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>



                            <li>
                                <a class="nav-link" href="<?= base_url('employees');?>">
                                    <i class="mdi mdi-account-multiple-check-outline me-1"></i> Employees
                                </a>
                            </li>

                            <?php } ?>

                            <?php if($this->session->userdata['logged_in']['department'] == 'Production Planning'){?> 


                                <li>
                                    <a class="nav-link" href="<?= base_url('dashboard');?>">
                                    <i class="mdi mdi-home me-1"></i> Dashboard
                                    </a>
                                </li>


                                <li>
                                <a class="nav-link" href="<?= base_url('production/inventory');?>">
                                 <i class="mdi mdi-clipboard-list-outline"></i> Inventory
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('production/inventory/in');?>">
                                        <i class="mdi mdi-database-arrow-left-outline me-1"></i> Re-stock Reports
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('production/inventory/out');?>">
                                        <i class="mdi mdi-database-arrow-right-outline me-1"></i> Out Stock Reports
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('production/expenses');?>">
                                <i class="mdi mdi-clipboard-text-outline me-1"></i>  Expenses
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('production/category');?>">
                                        <i class="mdi mdi-book-cog-outline me-1"></i> Category
                                    </a>
                                </li>


                            <?php } ?>


                            <?php if($this->session->userdata['logged_in']['department'] == 'Operation Management'){?> 


                                    <li>
                                        <a class="nav-link" href="<?= base_url('dashboard');?>">
                                        <i class="mdi mdi-home me-1"></i> Dashboard
                                        </a>
                                    </li>

                                    <li>
                                    <a href="#sidebarMultilevel" data-bs-toggle="collapse" class="" aria-expanded="true">
                                        <i class="mdi mdi-account-supervisor-outline"></i>
                                        <span> Production </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse " id="sidebarMultilevel" style="">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="#sidebarMultilevel3" data-bs-toggle="collapse" class="" aria-expanded="true">
                                                    Planning Control <span class="menu-arrow"></span>
                                                </a>
                                                <div class="collapse show" id="sidebarMultilevel3" style="">
                                                    <ul class="nav-second-level">
                                                        <li>
                                                            <a href="<?= base_url('production/inventory');?>">Inventory</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('production/inventory/in');?>">Restocks Reports</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('production/inventory/out');?>">Out Stocks Reports</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('production/expenses');?>">Expenses</a>
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                            </li>

                                            <li>
                                                <a href="#sidebarMultilevel4" data-bs-toggle="collapse" class="" aria-expanded="true">
                                                    Production Area <span class="menu-arrow"></span>
                                                </a>
                                                <div class="collapse show" id="sidebarMultilevel4" style="">
                                                    <ul class="nav-second-level">
                                                        <li>
                                                            <a href="<?= base_url('production/inventory/endorsed');?>">Inventory</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('production/inventory/finish-products');?>">Finish Products</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url('production/expenses');?>">Expenses</a>
                                                        </li>
                                                    
                                                    
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>


                                <li>
                                    <a href="#sidbarWarehouse" data-bs-toggle="collapse">
                                        <i class="mdi mdi-warehouse"></i>
                                        <span> Warehouse </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidbarWarehouse">
                                        <ul class="nav-second-level">
                                            <li>
                                            <a href="<?= base_url('warehouse/inventory');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> In Stock</a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('warehouse/stock-out');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Out Stock</a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('warehouse/stock-in');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Received Stock</a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('warehouse/receivable');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Receivable</a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('warehouse/expenses');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Expenses</a>
                                            </li>
                                        
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <a href="#sidbarLogistics" data-bs-toggle="collapse">
                                        <i class="mdi mdi-truck"></i>
                                        <span> Logistics </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidbarLogistics">
                                        <ul class="nav-second-level">
                                            <li>
                                            <a href="<?= base_url('logistics/delivery');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> For Delivery</a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('logistics/delivered');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Delivered</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>



                                <?php } ?>


                            <?php if($this->session->userdata['logged_in']['department'] == 'Logistics'){?> 
                                <li>
                                <a class="nav-link" href="#">
                                 <i class="mdi mdi-home me-1"></i> Dashboard
                                </a>
                                </li>


                                <li>
                                <a class="nav-link" href="<?= base_url('logistics/delivery');?>">
                                        <i class="mdi mdi-truck-fast me-1"></i> For Delivery
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('logistics/delivered');?>">
                                        <i class="mdi mdi-truck-check-outline me-1"></i> Delivered
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('logistics/collection');?>">
                                        <i class="mdi mdi-account-reactivate-outline me-1"></i>  Credit Collection
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('logistics/pullout');?>">
                                        <i class="mdi mdi-arrow-left-bold-circle-outline me-1"></i> Pullout
                                    </a>
                                </li>

                            <?php } ?>

                            <?php if($this->session->userdata['logged_in']['department'] == 'Accounting'){?> 
                                <li>
                                    <a class="nav-link" href="<?= base_url('dashboard');?>">
                                        <i class="mdi mdi-home me-1"></i> Dashboard
                                    </a>
                                </li>


                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/orders');?>">
                                <i class="mdi mdi-clipboard-check-outline me-1"></i>  Orders
                                    </a>
                                </li>

                                
                                <li>
                                  <a href="<?= base_url('accounting/pull-out');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Pull Out</a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/sales');?>">
                                        <i class="mdi mdi-chart-line me-1"></i> Sales
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/collection');?>">
                                        <i class="mdi mdi-alpha-c-circle-outline me-1"></i> Collection
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/expenses');?>">
                                        <i class="mdi mdi-clipboard-search-outline me-1"></i> Expenses
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/reimbursement');?>">
                                        <i class="mdi mdi-clipboard-edit-outline me-1"></i> Reimbursement
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/payroll');?>">
                                        <i class="mdi mdi-account-box-outline me-1"></i> Payroll
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/reports');?>">
                                        <i class="mdi mdi-file-check-outline me-1"></i> Sales Reports
                                    </a>
                                </li>

                                


                            <?php } ?>

                            <?php if($this->session->userdata['logged_in']['department'] == 'HR'){?> 
                                <li>
                                    <a class="nav-link" href="<?= base_url('dashboard');?>">
                                        <i class="mdi mdi-home me-1"></i> Dashboard
                                    </a>
                                </li>


                                <li>
                                <a class="nav-link" href="<?= base_url('employees');?>">
                                    <i class="mdi mdi-account-multiple-check-outline me-1"></i> Employee
                                </a>
                               </li>   

                               

                                <li>
                                <a class="nav-link" href="<?= base_url('accounting/payroll');?>">
                                        <i class="mdi mdi-account-box-outline me-1"></i> Payroll
                                    </a>
                                </li>

                            <?php } ?>

                            <?php if($this->session->userdata['logged_in']['department'] == 'Production'){?> 


                                <li>
                                <a class="nav-link" href="<?= base_url('dashboard');?>">
                                    <i class="mdi mdi-home me-1"></i> Dashboard
                                </a>
                               </li>


                                <li>
                                <a class="nav-link" href="<?= base_url('production/inventory/endorsed');?>">
                                <i class="mdi mdi-clipboard-list-outline"></i> Inventory
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('production/inventory/finish-products');?>">
                                        <i class="mdi mdi-clipboard-check-outline me-1"></i> Finish Products
                                    </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('production/expenses');?>">
                                  <i class="mdi mdi-clipboard-text-outline me-1"></i>  Expenses
                                    </a>
                                </li>



                            <?php } ?>

                            <?php if($this->session->userdata['logged_in']['department'] == 'Warehouse'){?> 

                                <li>
                                    <a class="nav-link" href="<?= base_url('dashboard');?>">
                                    <i class="mdi mdi-home me-1"></i> Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                                    <i class="mdi mdi-clipboard-outline"></i>
                                        <span> Orders </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse show" id="sidebarEmail">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="<?= base_url('orders/pending');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Pending  <span class="badge bg-info float-end"><?= $pending;?></span></a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('orders/approved');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Approved  <span class="badge bg-info float-end"><?= $approved;?></span></a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('orders/fordelivery');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> For Delivery  <span class="badge bg-info float-end"><?= $fordelivery;?></span></a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('orders/logistics');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Logistics  <span class="badge bg-info float-end"><?= $logistics;?></span></a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('orders/delivered');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Delivered  <span class="badge bg-info float-end"><?= $delivered;?></span></a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('orders/returned');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Returned  <span class="badge bg-info float-end"><?= $returned;?></span></a>
                                            <li>
                                            <a href="<?= base_url('orders/pull-out');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Pull Out <span class="badge bg-info float-end"><?= $pullout;?></span></a>
                                            </li>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('warehouse/charity');?>">
                                <i class="mdi mdi-charity me-1"></i> Charity / Donations
                              
                                 </a>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('products');?>">
                                  <i class="mdi mdi-clipboard-check-outline me-1"></i> Products
                                </a>
                                </li>
                                
                                <li>
                                    <a href="#sidebarInventory" data-bs-toggle="collapse">
                                        <i class="mdi mdi-clipboard-list-outline"></i>
                                        <span> Inventory </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarInventory">
                                        <ul class="nav-second-level">
                                            <li>
                                            <a class="dropdown-item" href="<?= base_url('warehouse/inventory');?>"> <i class="fe-chevron-right me-1"></i>  In Stock</a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('warehouse/stock-out');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Out Stock</a>
                                            </li>
                                            <li>
                                            <a href="<?= base_url('warehouse/stock-in');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Received Stock</a>
                                            </li>
                                            <li>
                                            <a class="dropdown-item" href="<?= base_url('warehouse/receivable');?>"> <i class="fe-chevron-right me-1"></i> Receivable </a>
                                            </li>
                                          
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                <a class="nav-link" href="<?= base_url('warehouse/pulled-out');?>">
                                <i class="mdi mdi-arrow-left-bold-circle-outline me-1"></i> Pulled Out
                                </a>
                                </li>
                                


                                <li>
                                <a class="nav-link" href="<?= base_url('warehouse/expenses');?>">
                                        <i class="mdi mdi-clipboard-text-outline me-1"></i> Expenses
                                    </a>
                                </li>

                            <?php } ?>
                            <?php if($this->session->userdata['logged_in']['department'] == 'Sales'){?> 


                                <?php if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){?> 

                                    <li>
                                    <a class="nav-link" href="<?= base_url('customers');?>">
                                        <i class="mdi mdi-account-group me-1"></i> Customers
                                        </a>
                                    </li>

                                

                                    <li>
                                    <a class="nav-link " href="<?= base_url('customers/order');?>">
                                            <i class="mdi mdi-clipboard-outline me-1"></i>  Order List
                                        </a>
                                    </li>

                                   
                                    <?php } else if($this->session->userdata['logged_in']['position'] == 'Telemarketing'){?> 
                                        <li>
                                        <a class="nav-link" href="<?= base_url('customers');?>">
                                            <i class="mdi mdi-account-group me-1"></i> Customers
                                            </a>
                                        </li>


                                        <li>
                                        <a class="nav-link " href="<?= base_url('customers/order');?>">
                                                <i class="mdi mdi-clipboard-outline me-1"></i>  Order List
                                            </a>
                                        </li>

                                      
                                     <?php } else {?>

                                    <li>
                                    <a class="nav-link" href="<?= base_url('dashboard');?>">
                                    <i class="fe-airplay me-1"></i> Dashboard
                                        </a>
                                    </li>


                                    <li>
                                    <a class="nav-link" href="<?= base_url('customers');?>">
                                       <i class="mdi mdi-account-group me-1"></i>Customers
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="#sidebarProductSales" data-bs-toggle="collapse">
                                            <i class="mdi mdi-chart-box-outline"></i>
                                            <span> Products Sales </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarProductSales">
                                        <ul class="nav-second-level">
                                                <li>
                                                <a href="<?= base_url('sales/monthly');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Monthly Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/mtd-ytd');?>?year=<?=date('Y');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> MTD  / YTD Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/daily-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Daily Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/quarterly-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i> Quaterly Sales</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/customer-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Sales by Customer</a>
                                                </li>
                                                <li>
                                                <a href="<?= base_url('sales/top-customer-sales');?>" class="dropdown-item"><i class="fe-chevron-right me-1"></i>  Top Customer Sales</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    
                                    <li>
                                    <a class="nav-link" href="<?= base_url('sales/collection');?>">
                                        <i class="mdi mdi-account-reactivate-outline me-1"></i> Credits Collection
                                        </a>
                                    </li>


                                    <li>
                                    <a class="nav-link" href="<?= base_url('sales/charity');?>">
                                      <i class="mdi mdi-charity me-1"></i> Charity / Donations
                                    </a>
                                    </li>

                                    <li>
                                    <a class="nav-link " href="<?= base_url('customers/order');?>">
                                    <i class="mdi mdi-clipboard-outline me-1"></i>  Order List
                                    </a>
                                    </li>


                                    <li>
                                    <a class="nav-link " href="<?= base_url('sales/agent');?>">
                                            <i class="mdi mdi-account-multiple-outline me-1"></i> Sales Agent
                                        </a>
                                    </li>

                                  

                                    <li>
                                    <a class="nav-link " href="<?= base_url('sales/agent');?>">
                                    <i class="mdi mdi-clipboard-text-outline me-1"></i> Expenses
                                        </a>
                                    </li>

                                   


                                <?php } ?>

                            <?php } ?>

                            
                            <li>
                               <a class="nav-link " href="<?= base_url('pettycash');?>">
                                    <i class="mdi mdi-cash me-1"></i> Petty Cash
                                </a>
                            </li>


                            <li>
                               <a class="nav-link " href="<?= base_url('profile');?>">
                                    <i class="mdi mdi-account-circle-outline me-1"></i> Profile
                                </a>
                            </li>

                            <li>
                                <a class="nav-link" href="<?= base_url('logout');?>">
                                        <i class="mdi mdi-arrow-collapse-right me-1"></i> Sign-out
                                    </a>
                                </li>


                            </ul> <!-- end navbar-->

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->