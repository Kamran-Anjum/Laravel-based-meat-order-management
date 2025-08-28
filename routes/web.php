<?php

use Illuminate\Support\Facades\Route;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
   Route::match(['get','post'],'/admin',[App\Http\Controllers\AdminController::class,'adminlogin']);
});
// Admin login controller
Route::match(['get','post'],'/testfekin',[App\Http\Controllers\TransportController::class,'testFekin']);

Route::match(['get','post'],'/admin',[App\Http\Controllers\AdminController::class,'adminlogin']);
Route::match(['get','post'],'/production',[App\Http\Controllers\ProductionController::class,'productionlogin']);
Route::match(['get','post'],'/transport',[App\Http\Controllers\TransportController::class,'transportlogin']);
Route::match(['get','post'],'/finance',[App\Http\Controllers\FinanceController::class,'financelogin']);
Route::match(['get','post'],'/customer',[App\Http\Controllers\CustomerController::class,'customerlogin']);
Route::match(['get','post'],'/packing',[App\Http\Controllers\PackingController::class,'packinglogin']);
Route::match(['get','post'],'/add-admin',[App\Http\Controllers\AdminController::class,'addadmin']);
Route::match(['get','post'],'/',[App\Http\Controllers\FrontCustomerController::class,'frontcustomerlogin']);
Route::group(['middleware' => ['role: |super-admin']], function () {

// Admin Logout
Route::get('/logout',[App\Http\Controllers\AdminController::class,'logout']);
// Admin Change Password
Route::match(['get','post'],'/admin/change-pwd',[App\Http\Controllers\AdminController::class,'changepassword']);

// Admin Home/Dashboard
Route::get('/admin/dashboard',[App\Http\Controllers\AdminController::class,'dashboard']);
// Expences Routes
Route::get('/admin/view-expences',[App\Http\Controllers\AdminController::class,'viewExpences']);
Route::match(['get','post'],'/admin/add-expence',[App\Http\Controllers\AdminController::class,'addExpence']);
Route::match(['get','post'],'/admin/edit-expence/{id}',[App\Http\Controllers\AdminController::class,'editExpence']);

Route::get('/admin/delete-expence-image/{id}',[App\Http\Controllers\AdminController::class,'deleteexpenceimage']);
Route::get('/admin/delete-category/{id}',[App\Http\Controllers\CategoryController::class,'deleteCategory']);


//role routes
Route::get('admin/view-roles', [App\Http\Controllers\RoleController::class,'viewRole']);
Route::get('admin/view-delete/{id}',[App\Http\Controllers\RoleController::class,'viewRole']);
Route::match(['get','post'],'admin/edit-roles/{id}',[App\Http\Controllers\RoleController::class,'editRole']);
Route::match(['get','post'],'admin/add-roles',[App\Http\Controllers\RoleController::class,'addRole']);
Route::get('/admin/delete-role/{id}',[App\Http\Controllers\RoleController::class,'deleteRole']);
//permission routes

Route::get('admin/view-permissions', [App\Http\Controllers\PermissionController::class,'viewPermission']);
Route::get('admin/view-delete/{id}', [App\Http\Controllers\PermissionController::class,'deletePermission']);
Route::match(['get','post'],'admin/edit-permission/{id}',[App\Http\Controllers\PermissionController::class,'editPermission']);
Route::match(['get','post'],'admin/add-permissions',[App\Http\Controllers\PermissionController::class,'addPermission']);
Route::get('/admin/delete-permission/{id}',[App\Http\Controllers\PermissionController::class,'deletePermission']);

//Role Permissions Routes
Route::get('admin/view-role-permission',[App\Http\Controllers\Role_has_permissionController::class,'viewRolePermission']);
Route::get('admin/view-delete-permission/{id}', [App\Http\Controllers\Role_has_permissionController::class,'deletePermission']);
Route::match(['get','post'],'admin/add-role-permissions',[App\Http\Controllers\Role_has_permissionController::class,'addRolePermission']);
Route::get('/admin/delete-role-permissions/{id}',[App\Http\Controllers\Role_has_permissionController::class,'deletePermission']);

 
//Category Controller
Route::get('/admin/view-categories',[App\Http\Controllers\CategoryController::class,'viewCategories']);
Route::match(['get','post'],'/admin/create-category',[App\Http\Controllers\CategoryController::class,'createCategories']);
Route::match(['get','post'],'/admin/edit-category/{id}',[App\Http\Controllers\CategoryController::class,'editCategory']);
Route::get('/admin/delete-category/{id}',[App\Http\Controllers\CategoryController::class,'deleteCategory']);

//Sub Category Controller
Route::get('/admin/view-subcategories',[App\Http\Controllers\SubCategoryController::class,'viewSubCategories']);
Route::match(['get','post'],'/admin/create-subcategory',[App\Http\Controllers\SubCategoryController::class,'createSubCategories']);
Route::match(['get','post'],'/admin/edit-sub-category/{id}',[App\Http\Controllers\SubCategoryController::class,'editSubCategory']);
Route::get('/admin/delete-sub-category/{id}',[App\Http\Controllers\SubCategoryController::class,'deleteSubCategory']);

//Product Controller
Route::get('/admin/view-products',[App\Http\Controllers\ProductController::class,'viewProducts']);
Route::match(['get','post'],'/admin/create-product',[App\Http\Controllers\ProductController::class,'createProduct']);
Route::match(['get','post'],'admin/edit-product/{id}', [App\Http\Controllers\ProductController::class,'editProduct']);
Route::match(['get','post'],'admin/view-product-details/{id}', [App\Http\Controllers\ProductController::class,'viewProductDetails']);
Route::get('/admin/delete-product-image/{id}',[App\Http\Controllers\ProductController::class,'deleteproductimage']);

Route::get('/admin/delete-gallery-image/{id}',[App\Http\Controllers\ProductController::class,'deletegalleryimage']);

//Product Customer Controller
Route::get('/admin/view-customer-prices',[App\Http\Controllers\ProductController::class,'viewCustomerPrice']);
Route::match(['get','post'],'/admin/create-customer-price',[App\Http\Controllers\ProductController::class,'createCustomerPrice']);
Route::match(['get','post'],'admin/edit-customer-price/{id}', [App\Http\Controllers\ProductController::class,'editCustomerPrice']);

//Customers Controller
Route::get('/admin/view-customers',[App\Http\Controllers\CustomerController::class,'viewCustomers']);
Route::match(['get','post'],'/admin/create-customer',[App\Http\Controllers\CustomerController::class,'createCustomer']);
Route::match(['get','post'],'admin/edit-customer/{id}', [App\Http\Controllers\CustomerController::class,'editCustomer']);
Route::match(['get','post'],'admin/view-customer-details/{id}', [App\Http\Controllers\CustomerController::class,'viewCustomerDetails']);
Route::get('/admin/delete-user-image/{id}',[App\Http\Controllers\CustomerController::class,'deletecustomerimage']);
Route::get('/admin/comming-soon/',[App\Http\Controllers\CustomerController::class,'commingsoon']);


//Suppliers Controller
Route::get('/admin/view-suppliers',[App\Http\Controllers\SupplierController::class,'viewSuppliers']);
Route::match(['get','post'],'admin/view-supplier-products/{id}', [App\Http\Controllers\SupplierController::class,'viewSupplierProduct']);
Route::match(['get','post'],'admin/create-supplier-product/{id}', [App\Http\Controllers\SupplierController::class,'createSupplierProduct']);
Route::match(['get','post'],'/admin/create-supplier',[App\Http\Controllers\SupplierController::class,'createSupplier']);
Route::match(['get','post'],'/admin/edit-supplier/{id}',[App\Http\Controllers\SupplierController::class,'editSupplier']);
Route::get('/admin/delete-supplier-image/{id}',[App\Http\Controllers\SupplierController::class,'deletesupplierimage']);
Route::get('/admin/delete-supplier-product/{id}',[App\Http\Controllers\SupplierController::class,'deleteSupplierProduct']);
Route::get('/admin/delete-supplier/{id}',[App\Http\Controllers\SupplierController::class,'deleteSupplier']);

//Purchase Order
Route::get('/admin/view-pruchase-orders',[App\Http\Controllers\PurchaseorderController::class,'viewPurchaseOrders']);
Route::get('/admin/poinvoice/{id}',[App\Http\Controllers\PurchaseorderController::class,'createPDF']);
Route::match(['get','post'],'/admin/create-purchase-order',[App\Http\Controllers\PurchaseorderController::class,'createPurchaseOrder']);
Route::match(['get','post'],'/admin/recieve-pruchase-orders/', [App\Http\Controllers\PurchaseorderController::class,'recievePurchaseOrders']);
Route::match(['get','post'],'/admin/edit-purchase-order/{id}',[App\Http\Controllers\PurchaseorderController::class,'editPurchaseOrders']);

//Order Controllers Route
Route::get('/admin/view-orders',[App\Http\Controllers\OrderController::class,'viewOrders']);
Route::match(['get','post'],'/admin/create-order',[App\Http\Controllers\OrderController::class,'createOrder']);
Route::match(['get','post'],'admin/edit-order/{id}', [App\Http\Controllers\OrderController::class,'editOrder']);

//Country Controller
Route::get('/admin/view-countries', [App\Http\Controllers\CountryController::class,'viewCountry']);
Route::match(['get','post'],'/admin/create-countries', [App\Http\Controllers\CountryController::class,'addCountry']);
Route::match(['get','post'],'/admin/edit-countries/{id}', [App\Http\Controllers\CountryController::class,'editCountry']);
Route::get('/admin/delete-country/{id}',[App\Http\Controllers\CountryController::class,'deleteCountry']);
//Sales Order Summary Controllers

Route::get('/admin/view-orders-summary',[App\Http\Controllers\SalesOrderSummaryController::class,'viewOrdersSummary']);

// Vehicle controller
Route::get('/admin/view-vehicles', [App\Http\Controllers\VehicleController::class,'viewVehicles']);
Route::match(['get','post'],'/admin/create-vehicle', [App\Http\Controllers\VehicleController::class,'addVehicle']);
Route::match(['get','post'],'/admin/edit-vehicle/{id}', [App\Http\Controllers\VehicleController::class,'editVehicle']);
Route::get('/admin/delete-vehicle/{id}',[App\Http\Controllers\VehicleController::class,'deleteState']);

// Assets Category controller
Route::get('/admin/view-assets-categories', [App\Http\Controllers\AssetsController::class,'viewAssetsCategories']);
Route::match(['get','post'],'/admin/add-assets-category', [App\Http\Controllers\AssetsController::class,'addAssetCategory']);
Route::match(['get','post'],'/admin/edit-asset-categoty/{id}', [App\Http\Controllers\AssetsController::class,'editAssetCategory']);
Route::get('/admin/delete-assets-category/{id}',[App\Http\Controllers\AssetsController::class,'deleteAssetCategory']);

// Assets SubCategory controller
Route::get('/admin/view-assets-sub-categories', [App\Http\Controllers\AssetsController::class,'viewAssetsSubCategories']);
Route::match(['get','post'],'/admin/add-assets-sub-category', [App\Http\Controllers\AssetsController::class,'addAssetSubCategory']);
Route::match(['get','post'],'/admin/edit-asset-sub-category/{id}', [App\Http\Controllers\AssetsController::class,'editAssetSubCategory']);
Route::get('/admin/delete-assets-sub-category/{id}',[App\Http\Controllers\AssetsController::class,'deleteAssetSubCategory']);

// Assets controller
/*Route::get('/admin/view-assets', [App\Http\Controllers\AssetsController::class,'viewAssets']);
Route::match(['get','post'],'/admin/create-asset', [App\Http\Controllers\AssetsController::class,'createAsset']);
Route::match(['get','post'],'/admin/edit-asset/{id}', [App\Http\Controllers\AssetsController::class,'editAsset']);
Route::get('/admin/delete-asset/{id}',[App\Http\Controllers\AssetsController::class,'deleteAsset']);
Route::get('/admin/delete-vehicle-image/{id}',[App\Http\Controllers\AssetsController::class,'deletevehicleimage']);*/

// Assets controller
Route::get('/admin/view-vehicles', [App\Http\Controllers\AssetsController::class,'viewAssets']);
Route::match(['get','post'],'/admin/create-vehicle', [App\Http\Controllers\AssetsController::class,'createAsset']);
Route::match(['get','post'],'/admin/edit-vehicle/{id}', [App\Http\Controllers\AssetsController::class,'editAsset']);
Route::get('/admin/delete-asset/{id}',[App\Http\Controllers\AssetsController::class,'deleteAsset']);
Route::get('/admin/delete-vehicle-image/{id}',[App\Http\Controllers\AssetsController::class,'deletevehicleimage']);

// State conroller
Route::get('/admin/view-states', [App\Http\Controllers\StateController::class,'viewState']);
Route::match(['get','post'],'/admin/create-states', [App\Http\Controllers\StateController::class,'addState']);
Route::match(['get','post'],'/admin/edit-states/{id}', [App\Http\Controllers\StateController::class,'editState']);
Route::get('/admin/delete-states/{id}',[App\Http\Controllers\StateController::class,'deleteState']);

// City conroller
Route::get('/admin/view-cities', [App\Http\Controllers\CityController::class,'viewCity']);
Route::match(['get','post'],'/admin/create-cities', [App\Http\Controllers\CityController::class,'addCity']);
Route::match(['get','post'],'/admin/edit-cities/{id}', [App\Http\Controllers\CityController::class,'editCity']);
Route::get('/admin/delete-cities/{id}',[App\Http\Controllers\CityController::class,'deleteCity']);

// Riders Controller
Route::get('/admin/view-riders',[App\Http\Controllers\RidersController::class,'viewRiders']);
Route::match(['get','post'],'/admin/create-rider',[App\Http\Controllers\RidersController::class,'createRider']);
Route::match(['get','post'],'admin/edit-rider/{id}', [App\Http\Controllers\RidersController::class,'editRider']);
Route::match(['get','post'],'admin/view-rider-details/{id}', [App\Http\Controllers\RidersController::class,'viewRiderDetails']);
Route::get('/admin/delete-user-image/{id}',[App\Http\Controllers\CustomerController::class,'deletecustomerimage']);
Route::get('/admin/comming-soon/',[App\Http\Controllers\CustomerController::class,'commingsoon']);

//Woocommerce Controller
Route::get('/admin/view-wp-orders', [App\Http\Controllers\WoocommerceController::class,'ViewWoocommerce']);
Route::match(['get','post'],'admin/forward-wp-order/{id}', [App\Http\Controllers\WoocommerceController::class,'editOrderAdmin']);
Route::match(['get','post'],'admin/update-wp-order/{id}', [App\Http\Controllers\WoocommerceController::class,'updateOrderAdmin']);



});

//Ajax Routes
Route::group(['middleware' => ['role: |super-admin|production-admin|packing-admin|transport-admin|finance-admin']], function () {

	//Product Ajax Routes
	Route::get('production/getsoreport/{from}/{to}/{role}/{customer}',[App\Http\Controllers\ProductionOrderSummaryController::class,'SortReport']);
Route::get('production/getsorpdf/{from}/{to}/{role}/{customer}',[App\Http\Controllers\ProductionOrderSummaryController::class,'pdfreport']);
Route::get('production/export-excel/{from}/{to}/{role}/{customer}',[App\Http\Controllers\ProductionOrderSummaryController::class,'export']);
Route::get('production/export-excel-view/{from}/{to}/{role}/{customer}',[App\Http\Controllers\ProductionOrderSummaryController::class,'excelview']);

Route::get('admin/getsoreport/{from}/{to}/{role}/{customer}',[App\Http\Controllers\SalesOrderSummaryController::class,'SortReport']);
Route::get('admin/getsorpdf/{from}/{to}/{role}/{customer}',[App\Http\Controllers\SalesOrderSummaryController::class,'pdfreport']);
Route::get('admin/export-excel/{from}/{to}/{role}/{customer}',[App\Http\Controllers\SalesOrderSummaryController::class,'export']);
Route::get('admin/export-excel-view/{from}/{to}/{role}/{customer}',[App\Http\Controllers\SalesOrderSummaryController::class,'excelview']);


Route::get('/admin/getproductsubcategories/{id}',[App\Http\Controllers\AjaxRequestController::class,'getsubcategoriesdropdown']);
Route::get('/admin/getassetsubcategories/{id}',[App\Http\Controllers\AjaxRequestController::class,'getassetsubcategoriesdropdown']);

Route::get('/admin/getsubcategoryproducts/{id}',[App\Http\Controllers\AjaxRequestController::class,'getproductsdropdown']);
Route::get('/admin/getproduct-stock-price/{id}/{cusid}',[App\Http\Controllers\AjaxRequestController::class,'getproductstockprice']);
Route::get('/statename/{id}',[App\Http\Controllers\AjaxRequestController::class,'getStateName']);
Route::get('/cityname/{cid}/{sid}',[App\Http\Controllers\AjaxRequestController::class,'getCityName']);
Route::get('/getsupplierdetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getSupplierDetail']);
Route::get('/getassetdetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getAssetDetail']);

Route::get('/getcustomerdetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getCustomerDetail']);
Route::get('/getriderdetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getRiderDetail']);
Route::get('admin/getpodetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getPODetail']);
Route::get('admin/getsodetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getSODetail']);
Route::get('admin/getsupplierproductpo/{id}',[App\Http\Controllers\AjaxRequestController::class,'getSupplierproductPO']);
Route::get('admin/recievepodetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getRecievePO']);
Route::get('admin/getpoproductdata/{id}/{poid}',[App\Http\Controllers\AjaxRequestController::class,'getPOproducts']);
Route::get('admin/getsummary/{from}/{to}',[App\Http\Controllers\AjaxRequestController::class,'getSummary']);
Route::get('admin/getsummary/{from}/{to}',[App\Http\Controllers\AjaxRequestController::class,'getSummary']);

Route::get('/admin/getcustomerdetailsnyId/{id}',[App\Http\Controllers\AjaxRequestController::class,'getcustomerdetailsnyIdform']);

Route::get('/admin/getforwardStockSO/{id}',[App\Http\Controllers\AjaxRequestController::class,'ForwardStockSO']);
Route::get('/admin/getcustomerbyrolename/{rolename}',[App\Http\Controllers\AjaxRequestController::class,'CustomerByRolename']);
});
//Production Routes
Route::group(['middleware' => ['role: |production-admin']], function () {
	Route::get('/production-logout',[App\Http\Controllers\ProductionController::class,'logout']);

Route::get('/production/dashboard',[App\Http\Controllers\ProductionController::class,'dashboard']);

//Sales Order Summary Controllers
Route::get('/production/view-orders-summary',[App\Http\Controllers\ProductionOrderSummaryController::class,'viewOrdersSummary']);


//Order Controllers Route
Route::get('/production/view-orders',[App\Http\Controllers\ProductionOrderController::class,'viewOrders']);
Route::get('/production/view-orders-history',[App\Http\Controllers\ProductionOrderController::class,'viewOrdersHistory']);
Route::get('/production/view-wp-orders',[App\Http\Controllers\WoocommerceController::class,'ViewWoocommerceProduction']);
Route::match(['get','post'],'production/forward-order/{id}', [App\Http\Controllers\WoocommerceController::class,'editOrderProduction']);

Route::match(['get','post'],'/production/create-order',[App\Http\Controllers\ProductionOrderController::class,'createOrder']);
Route::match(['get','post'],'production/edit-order/{id}', [App\Http\Controllers\ProductionOrderController::class,'editOrder']);
});

//Packing Department Routes
Route::group(['middleware' => ['role: |packing-admin']], function () {
	Route::get('/packing-logout',[App\Http\Controllers\PackingController::class,'logout']);

Route::get('/packing/dashboard',[App\Http\Controllers\PackingController::class,'dashboard']);

//Order Controllers Route
Route::get('/packing/view-orders',[App\Http\Controllers\PackingController::class,'viewOrders']);

Route::get('/packing/view-wp-orders',[App\Http\Controllers\WoocommerceController::class,'ViewWoocommercePacking']);
Route::match(['get','post'],'packing/forward-order/{id}', [App\Http\Controllers\WoocommerceController::class,'editOrderPacking']);

Route::match(['get','post'],'packing/edit-order/{id}', [App\Http\Controllers\PackingController::class,'editOrder']);

//Purchase Order Packing
Route::get('/packing/view-pruchase-orders',[App\Http\Controllers\PackingController::class,'viewPurchaseOrders']);
Route::match(['get','post'],'/packing/recieve-pruchase-orders/', [App\Http\Controllers\PackingController::class,'recievePurchaseOrders']);
Route::get('/packing/poinvoice/{id}',[App\Http\Controllers\PackingController::class,'createPDF']);
});
//Transport Department Routes
Route::group(['middleware' => ['role: |transport-admin']], function () {
	Route::get('/transport-logout',[App\Http\Controllers\TransportController::class,'logout']);

Route::get('/transport/dashboard',[App\Http\Controllers\TransportController::class,'dashboard']);

//Order Controllers Route
Route::get('/transport/view-orders',[App\Http\Controllers\TransportController::class,'viewOrders']);
Route::get('/transport/view-wp-orders',[App\Http\Controllers\WoocommerceController::class,'ViewWoocommerceTransport']);
Route::match(['get','post'],'transport/assign-order/{id}', [App\Http\Controllers\WoocommerceController::class,'editOrderTransport']);

Route::match(['get','post'],'transport/complete-wp-order/{id}', [App\Http\Controllers\WoocommerceController::class,'completeOrderTransport']);

Route::match(['get','post'],'transport/deliver-order/{id}', [App\Http\Controllers\TransportController::class,'editOrder']);
Route::match(['get','post'],'transport/complete-order/{id}', [App\Http\Controllers\TransportController::class,'completeOrder']);
Route::match(['get','post'],'transport/delivered-partial-order/{id}', [App\Http\Controllers\TransportController::class,'partialOrder']);
//Vehicle
Route::get('/transport/vehicles',[App\Http\Controllers\TransportController::class,'viewVehicles']);
Route::get('/transport/riders',[App\Http\Controllers\TransportController::class,'viewRider']);
});

//Finance Department Routes
Route::group(['middleware' => ['role: |finance-admin']], function () {
	Route::get('/finance-logout',[App\Http\Controllers\FinanceController::class,'logout']);

Route::get('/finance/dashboard',[App\Http\Controllers\FinanceController::class,'dashboard']);

Route::get('/finance/view-expence',[App\Http\Controllers\FinanceController::class,'viewExpences']);
Route::get('/finance/order-invoice/{id}',[App\Http\Controllers\FinanceController::class,'createInvoice']);
Route::get('/finance/get-order-invoice/{id}',[App\Http\Controllers\FinanceController::class,'viewInvoice']);
Route::match(['get','post'],'/finance/add-expence',[App\Http\Controllers\FinanceController::class,'addExpence']);
Route::get('/finance/view-pruchase-orders',[App\Http\Controllers\FinanceController::class,'viewPurchaseOrders']);
Route::get('/finance/view-orders',[App\Http\Controllers\FinanceController::class,'viewOrders']);
Route::get('/finance/view-wp-orders',[App\Http\Controllers\WoocommerceController::class,'ViewWoocommerceFinance']);
Route::get('/finance/view-orders-summary',[App\Http\Controllers\FinanceController::class,'viewOrdersSummary']);
Route::get('/finance/order-invoice-pay/{id}',[App\Http\Controllers\FinanceController::class,'orderinvoicepay']);


});
// Front Customer Setup
Route::group(['middleware' => ['role: |external-customer|internal-customer|private-customer|coop|workforce']], function () {
Route::get('/user-logout',[App\Http\Controllers\FrontCustomerController::class,'logout']);
Route::get('/user/dashboard',[App\Http\Controllers\FrontCustomerController::class,'dashboard']);

Route::get('/user/view-orders',[App\Http\Controllers\FrontCustomerController::class,'viewOrders']);
Route::match(['get','post'], '/user/add-order', [App\Http\Controllers\FrontCustomerController::class,'addOrder']);
Route::match(['get','post'], '/user/profile', [App\Http\Controllers\FrontCustomerController::class,'userProfile']);
Route::match(['get','post'], '/user/edit-profile/{id}', [App\Http\Controllers\FrontCustomerController::class,'editProfile']);

Route::get('/user/delete-customer-image/{id}',[App\Http\Controllers\FrontCustomerController::class,'deletecustomerimage']);

Route::get('/user/getsodetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getSODetail']);
Route::get('/user/getsubcategoryproducts/{id}',[App\Http\Controllers\FrontCustomerController::class,'getproductsdropdown']);
Route::get('/user/getproductsubcategories/{id}',[App\Http\Controllers\FrontCustomerController::class,'getsubcategoriesdropdown']);
Route::get('/user/getproduct-stock-price/{id}/{cusid}',[App\Http\Controllers\FrontCustomerController::class,'getproductstockprice']);
});
/*Route::get('/', function () {
    return view('welcome');
});*/


// Routes For Admin/Backend



//Route::get('/', [App\Http\Controllers\AdminController::class,'adminlogin']);
