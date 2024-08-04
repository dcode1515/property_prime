<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\MemorialController;
use App\Http\Controllers\RealEstateController;
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

Route::get('/', function () {
    return view('welcome');
});

/*Login Authenticate*/

Route::get('/', [UserController::class, 'index'])->name('login');
Route::post('/api/post/login', [UserController::class, 'postLogin']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
/*End Login Authenticate*/


/*Admin Routes*/
Route::middleware(['auth'])->group(function () {


Route::middleware(['check_permissions'])->group(function () {
    Route::get('/dashboard', [PropertyController::class, 'index']);
});



/*Property Routes*/
/*View Property Routes*/

Route::middleware(['check_permission:can_view'])->group(function () {
    Route::get('/property', [PropertyController::class, 'properties'])->name('property');
    // Add other routes that require the 'can_view' permission
}); 
    /*End View Property Routes*/

    /*Store Property Routes*/
    Route::post('/api/store/property', [PropertyController::class, 'store_property']);
    /*End Store Property Routes*/

    /*get Data Property Routes*/
    Route::get('/api/get/data/property', [PropertyController::class, 'getdata_properties']);
    /*get End Data Property Routes*/

    /*Update Data Property Routes*/
    Route::post('/api/update/property/{id}', [PropertyController::class, 'update_property']);
    /*Update End Data Property Routes*/


    /*Create Form Routes Property Routes*/
    Route::get('/create/property', [PropertyController::class, 'create_property']);
    /*End Create Form Routes Property Routes*/

    /*Delete Routes Property Routes*/
    Route::get('/api/count/property', [PropertyController::class, 'count_property']);
    Route::post('/api/delete/property/{id}', [PropertyController::class, 'delete_property']);
    /*End Delete Routes Property Routes*/
    /*End Property Routes*/



    /*Property Routes*/
    /*View Property Routes*/
        Route::get('/property', [PropertyController::class, 'properties'])->name('property');
        /*End View Property Routes*/
    
    
        /*get Data Property Routes*/
        Route::get('/api/get/data/property', [PropertyController::class, 'getdata_properties']);
        /*get End Data Property Routes*/
    
        /*Update Data Property Routes*/
        Route::post('/api/update/property/{id}', [PropertyController::class, 'update_property']);
        /*Update End Data Property Routes*/

        Route::get('/memorial',  [PropertyController::class, 'memorial'])->name('memorial');

  
      
        /*End Property Routes*/
   

 

            Route::get('/tenant', [TenantController::class, 'tenant'])->name('tenant');
            Route::get('/api/get/property', [TenantController::class, 'getPropertyAvailable']);
            Route::post('/api/store/tenant', [TenantController::class, 'store_tenant']);
            Route::get('/api/get/data/tenant', [TenantController::class, 'get_tenant']);
            Route::post('/api/update/tenant/{id}', [TenantController::class, 'update_tenant']);
            Route::get('/download/attachment/{id}', [TenantController::class, 'download_attachment']);
            Route::post('/api/delete/tenant/{id}', [TenantController::class, 'delete_tenant']);
            Route::get('/api/count/tenant', [TenantController::class, 'tenant_count']);
            Route::get('/tenant/payment', [TenantController::class, 'payment'])->name('tenant.payment');
            Route::get('/view/tenant/payment/{id}', [TenantController::class, 'view_tenant_payment']);
            Route::post('/api/store/tenant/payment', [TenantController::class, 'store_tenant_payment']);
            Route::get('/isOccupied/{propertyId}',  [TenantController::class, 'isOccupied']);
            Route::post('/api/update/tenant/payment/{id}',  [TenantController::class, 'update_payment_tenant']);
            Route::get('/api/total/amount',  [TenantController::class, 'totalAmountPayment']);
            Route::get('/api/count/due/date',  [TenantController::class, 'getOverdueTenantCount']);
            Route::get('/print/payment/{id}',  [TenantController::class, 'print_payment']);
            Route::get('/user/role',  [UserController::class, 'user_role'])->name('user.role');
            Route::post('/api/store/user/role',  [UserController::class, 'store_role']);
            Route::post('/api/update/user/role/{id}',  [UserController::class, 'update_role']);
            Route::get('/api/get/user',  [UserController::class, 'get_User']);
            Route::get('/api/permissions',  [UserController::class, 'get_permission']);
            Route::get('/api/get/role/display',  [UserController::class, 'getRoleDisplay']);
            Route::post('/api/store/memorial',  [MemorialController::class, 'store_memorial']);
            Route::get('/api/get/data/memorial',  [MemorialController::class, 'get_data_memorial']);
            Route::post('/api/update/memorial/{id}',  [MemorialController::class, 'update_memorial']);
            Route::post('/api/delete/memorial/{id}',  [MemorialController::class, 'delete_memorial']);
            Route::get('/api/count/memorial',  [MemorialController::class, 'counts_memorial']);
            Route::get('/update/memorial/{id}',  [MemorialController::class, 'update_memorial_client']);
            Route::get('/client',  [MemorialController::class, 'client'])->name('client');
            Route::get('/api/get/memorial',  [MemorialController::class, 'getMemorial']);
            Route::post('/api/store/client',  [MemorialController::class, 'store_client']);
            Route::get('/api/get/client',  [MemorialController::class, 'get_data_client']);
            Route::post('/api/update/client/{id}',  [MemorialController::class, 'update_client']);
            Route::get('/api/count/client',  [MemorialController::class, 'counts_client']);
            Route::post('/api/delete/client/{id}',  [MemorialController::class, 'delete_client']);
            Route::get('/reports',  [TenantController::class, 'reports'])->name('reports.property');
            Route::post('/api/get/data/payment',  [TenantController::class, 'filterData']);
            Route::get('/api/get/data/payment/pdf', [TenantController::class, 'filterData'])->name('payment.report.pdf');
});




/*End Admin Routes*/


Route::get('/realestate', [RealEstateController::class, 'index']);

Route::get('/property/view', [RealEstateController::class, 'property_view'])->name('property.view');
