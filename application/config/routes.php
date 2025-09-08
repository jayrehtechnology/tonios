<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method

*/



// ** CUSROMER ROUTES **//

// ** Dashboard Module **//
$route['dashboard']                                             = "accounts/dashboard";
$route['logout']                                                = "accounts/logout";

$route['profile']                                               = "accounts/profile";
$route['pettycash']                                             = "accounts/pettycash";

$route['check-password']                                        = "accounts/profile/check_password";
$route['profile/update-profile']                                = "accounts/profile/update_profile";
$route['profile/update-password']                               = "accounts/profile/update_password";

// ** Customer Module **//
$route['customers']                                             = "accounts/customers";
$route['customers/process-customers']                           = "accounts/customers/process_customers";
$route['customers/update-customers']                            = "accounts/customers/update_customers";
$route['customers/delete-customers']                            = "accounts/customers/delete_customers";
$route['customers/order']                                       = "accounts/customers/order";
$route['customers/order-details']                               = "accounts/customers/order_details";
$route['customers/process-customer-order']                      = "accounts/customers/process_customer_order";
$route['customers/update-customer-order']                       = "accounts/customers/update_customer_order";

$route['customers/remove-order']                                = "accounts/customers/remove_order";
$route['customers/process-pullout-order']                       = "accounts/customers/process_pullout_order";

// ** Employee Module **//
$route['employees']                                             = "accounts/employee";
$route['employees/process-employee']                            = "accounts/employee/process_employee";
$route['employees/process-update-employee']                     = "accounts/employee/update_employee";
$route['employees/delete-employees']                            = "accounts/employee/delete_employee";



// ** Sales Module **//
$route['sales/agent']                                           = "accounts/sales/agent";
$route['sales/charity']                                         = "accounts/sales/charity";
$route['sales/order-details']                                   = "accounts/sales/order_details";
$route['sales/process-sales-agent']                             = "accounts/sales/process_sales_agent";
$route['sales/update-sales-agent']                              = "accounts/sales/update_sales_agent";
$route['sales/deactivate-sales-agent']                          = "accounts/sales/deactivate_sales_agent";
$route['sales/activate-sales-agent']                            = "accounts/sales/activate_sales_agent";
$route['sales/process-charity-order']                           = "accounts/sales/process_charity_order";
$route['sales/process-approve-charity']                         = "accounts/sales/process_approve_charity";
$route['sales/process-declined-charity']                        = "accounts/sales/process_declined_charity";
$route['sales/process-remove-charity']                          = "accounts/sales/process_removed_charity";
$route['sales/process-warehouse-charity']                       = "accounts/sales/process_warehouse_charity";
$route['sales/update-charity-order']                            = "accounts/sales/update_customer_order";
$route['sales/collection']                                      = "accounts/sales/collection";
$route['sales/process-assigned-collection']                     = "accounts/sales/process_assigned_collection";

$route['sales/monthly']                                         = "accounts/sales/monthly_reports";
$route['sales/mtd-ytd']                                         = "accounts/sales/mtd_ytd_reports";
$route['sales/daily-sales']                                     = "accounts/sales/daily_sales_report";
$route['sales/quarterly-sales']                                 = "accounts/sales/quarterly_sales_reports";
$route['sales/customer-sales']                                  = "accounts/sales/customer_sales_reports";
$route['sales/top-customer-sales']                              = "accounts/sales/top_customer_sales_reports";


// ** Logistics Module **//
$route['logistics/delivery']                                    = "accounts/logistics";
$route['logistics/delivered']                                   = "accounts/logistics/delivered";
$route['logistics/delivery-list']                               = "accounts/logistics/order_details";
$route['logistics/process-delivery-completed']                  = "accounts/logistics/process_delivery_completed";
$route['logistics/process-delivery-return']                     = "accounts/logistics/process_delivery_return";
$route['logistics/process-delivered']                           = "accounts/logistics/process_delivered";
$route['logistics/collection']                                  = "accounts/logistics/collection";
$route['logistics/process-collection']                          = "accounts/logistics/process_collection";
$route['logistics/pullout']                                     = "accounts/logistics/pullout";

// ** Production Module **//
$route['products']                                              = "accounts/products";
$route['products/process-products']                             = "accounts/products/process_products";
$route['products/update-products']                              = "accounts/products/update_products";
$route['products/delete-products']                              = "accounts/products/delete_products";

// ** Accounting Module **//
$route['accounting/orders']                                     = "accounts/accounting";
$route['accounting/expenses']                                   = "accounts/accounting/expenses";
$route['accounting/sales']                                      = "accounts/accounting/sales";
$route['accounting/payroll']                                    = "accounts/accounting/payroll";
$route['accounting/reports']                                    = "accounts/accounting/reports";
$route['accounting/payroll-list']                               = "accounts/accounting/payroll_list";
$route['accounting/reimbursement']                              = "accounts/accounting/reimbursement";
$route['accounting/delivered-list']                             = "accounts/accounting/order_details";
$route['accounting/reports-data']                               = "accounts/accounting/reports_data";
$route['accounting/collection']                                 = "accounts/accounting/collection";
$route['accounting/view-credits-records']                       = "accounts/accounting/collection_records";
$route['accounting/pull-out']                                   = "accounts/accounting/pullout";

$route['accounting/process-returned']                           = "accounts/accounting/process_returned";
$route['accounting/process-returned']                           = "accounts/accounting/process_returned";
$route['accounting/process-sales']                              = "accounts/accounting/process_sales";
$route['accounting/process-expenses']                           = "accounts/accounting/process_expenses";
$route['accounting/process-reimbursement']                      = "accounts/accounting/process_reimbursement";
$route['accounting/process-payroll']                            = "accounts/accounting/process_payroll";
$route['accounting/process-payroll-list']                       = "accounts/accounting/process_payroll_list";
$route['accounting/process-daily-sales']                        = "accounts/accounting/process_daily_sales";
$route['accounting/delete-sales-reports']                       = "accounts/accounting/delete_sales_reports";
$route['accounting/process-collection-to-sales']                = "accounts/accounting/process_collection_to_sales";
$route['accounting/process-endorse-warehouse']                  = "accounts/accounting/process_endorse_warehouse";



// ** Warehouse Module **//
$route['warehouse/inventory']                                   = "accounts/warehouse/inventory";
$route['warehouse/receivable']                                  = "accounts/warehouse/receivable";
$route['warehouse/receivable-details']                          = "accounts/warehouse/receivable_details";
$route['warehouse/stock-in']                                    = "accounts/warehouse/stock_in";
$route['warehouse/stock-out']                                   = "accounts/warehouse/stock_out";
$route['warehouse/expenses']                                    = "accounts/warehouse/expenses";

$route['warehouse/process-stock-in']                            = "accounts/warehouse/process_stock_in";
$route['warehouse/order-details']                               = "accounts/warehouse/order_details";
$route['warehouse/pulled-out']                                  = "accounts/warehouse/pulled_out";

$route['warehouse/charity']                                     = "accounts/warehouse/charity";
$route['warehouse/process-charity']                             = "accounts/warehouse/process_charity";
$route['warehouse/process-charity-order']                       = "accounts/warehouse/process_charity_order";
$route['warehouse/process-receive-product']                     = "accounts/warehouse/process_receive_product";
$route['warehouse/process-expenses-reports']                    = "accounts/warehouse/process_expenses_reports";
$route['warehouse/process-pullout']                             = "accounts/warehouse/process_pullout";


$route['orders/pending']                                        = "accounts/orders";
$route['orders/approved']                                       = "accounts/orders/approved";
$route['orders/fordelivery']                                    = "accounts/orders/for_delivery";
$route['orders/logistics']                                      = "accounts/orders/logistics";
$route['orders/delivered']                                      = "accounts/orders/delivered";
$route['orders/returned']                                       = "accounts/orders/returned";
$route['orders/pull-out']                                       = "accounts/orders/pullout";


$route['orders/process-approved']                               = "accounts/orders/process_approved";
$route['orders/process-for-delivery']                           = "accounts/orders/process_for_delivery";
$route['orders/process-for-delivery-logistic']                  = "accounts/orders/process_for_delivery_logistic";
$route['orders/process-for-delivery-order']                     = "accounts/orders/process_for_delivery_order";
$route['orders/process-return-inventory']                       = "accounts/orders/process_return_inventory";

$route['orders/order-list']                                     = "accounts/orders/order_list";


// ** Production Module **//
$route['production/inventory']                                  = "accounts/production/inventory";
$route['production/expenses']                                   = "accounts/production/expenses";
$route['production/inventory/in']                               = "accounts/production/restock";
$route['production/inventory/out']                              = "accounts/production/reduction";
$route['production/inventory/endorsed']                         = "accounts/production/endorsed";
$route['production/inventory/finish-products']                  = "accounts/production/finish_products";

$route['production/process-production-inventory']               = "accounts/production/process_production_inventory";
$route['production/update-production-inventory']                = "accounts/production/update_production_inventory";
$route['production/process-production-inventory-restock']       = "accounts/production/process_production_inventory_restock";
$route['production/process-production-inventory-reduction']     = "accounts/production/process_production_inventory_reduction";
$route['production/received-endorse-inventory']                 = "accounts/production/received_endorse_inventory";
$route['production/process-finish-products']                    = "accounts/production/process_finish_products";
$route['production/remove-batch-products']                      = "accounts/production/remove_batch_products";
$route['production/endorse-batch-products']                     = "accounts/production/endorse_batch_products";

$route['production/category']                                   = "accounts/production/category";
$route['production/process-production-inventory-category']      = "accounts/production/process_production_inventory_category";
$route['production/update-production-inventory-category']       = "accounts/production/update_production_inventory_category";
$route['production/delete-production-inventory-category']       = "accounts/production/delete_production_inventory_category";

$route['production/process-expenses-reports']                   = "accounts/production/process_expenses_reports";
$route['production/delete-expenses-reports']                    = "accounts/production/delete_expenses_reports";

$route['production/check-production-inventory']                 = "accounts/production/check_production_inventory";

$route['pettycash/process-petty-cash']                          = "accounts/pettycash/process_petty_cash";
$route['pettycash/process-approved-request']                    = "accounts/pettycash/process_approved_petty_cash";




$route['logout']                                                = "accounts/logout";




$route['default_controller'] = 'front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE ;
