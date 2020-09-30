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
// Admin login controller
Route::match(['get','post'],'/admin',[App\Http\Controllers\AdminController::class,'adminlogin']);
Route::match(['get','post'],'/production',[App\Http\Controllers\ProductionController::class,'productionlogin']);
Route::match(['get','post'],'/transport',[App\Http\Controllers\TransportController::class,'transportlogin']);
Route::match(['get','post'],'/finance',[App\Http\Controllers\FinanceController::class,'financelogin']);
Route::match(['get','post'],'/customer',[App\Http\Controllers\CustomerController::class,'customerlogin']);
Route::match(['get','post'],'/packing',[App\Http\Controllers\PackingController::class,'packinglogin']);
Route::match(['get','post'],'/add-admin',[App\Http\Controllers\AdminController::class,'addadmin']);

Route::group(['middleware' => ['role: |super-admin']], function () {

// Admin Logout
Route::get('/logout',[App\Http\Controllers\AdminController::class,'logout']);
// Admin Change Password
Route::match(['get','post'],'admin-change-pwd',[App\Http\Controllers\AdminController::class,'changepassword']);

// Admin Home/Dashboard
Route::get('/admin/dashboard',[App\Http\Controllers\AdminController::class,'dashboard']);

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
Route::match(['get','post'],'admin/view-product-details/{id}', [App\Http\Controllers\ProductController::class,'viewProductDetails']);



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
Route::match(['get','post'],'/admin/create-purchase-order',[App\Http\Controllers\PurchaseorderController::class,'createPurchaseOrder']);
Route::match(['get','post'],'/admin/recieve-pruchase-orders/', [App\Http\Controllers\PurchaseorderController::class,'recievePurchaseOrders']);


//Country Controller
Route::get('/admin/view-countries', [App\Http\Controllers\CountryController::class,'viewCountry']);
Route::match(['get','post'],'/admin/create-countries', [App\Http\Controllers\CountryController::class,'addCountry']);
Route::match(['get','post'],'/admin/edit-countries/{id}', [App\Http\Controllers\CountryController::class,'editCountry']);
Route::get('/admin/delete-country/{id}',[App\Http\Controllers\CountryController::class,'deleteCountry']);

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

//Product Ajax Routes
Route::get('/admin/getproductsubcategories/{id}',[App\Http\Controllers\AjaxRequestController::class,'getsubcategoriesdropdown']);
Route::get('/statename/{id}',[App\Http\Controllers\AjaxRequestController::class,'getStateName']);
Route::get('/cityname/{cid}/{sid}',[App\Http\Controllers\AjaxRequestController::class,'getCityName']);
Route::get('/getsupplierdetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getSupplierDetail']);
Route::get('admin/getpodetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getPODetail']);
Route::get('admin/getsupplierproductpo/{id}',[App\Http\Controllers\AjaxRequestController::class,'getSupplierproductPO']);
Route::get('admin/recievepodetail/{id}',[App\Http\Controllers\AjaxRequestController::class,'getRecievePO']);

});






Route::get('/', function () {
    return view('welcome');
});


// Routes For Admin/Backend



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
