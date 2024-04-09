<?php

use App\Http\Controllers\AdminCassaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryBotController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentUserController;
use App\Http\Controllers\FinesController;
use App\Http\Controllers\FirmsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialStokController;
use App\Http\Controllers\MaterialStokValueController;
use App\Http\Controllers\ModelProductOrderController;
use App\Http\Controllers\ModelStructureController;
use App\Http\Controllers\NakladnoyController;
use App\Http\Controllers\OrderAppController;
use App\Http\Controllers\PrixodController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\ProductProductionController;
use App\Http\Controllers\ProductStokController;
use App\Http\Controllers\ProductStokValueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RashodController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\ShotFacturaController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\TelegramBotHandler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth'])->group(function () {

    // User routes
    Route::get('/', [UserController::class, 'index'])->name('user.list')->middleware('can:user.list');
    Route::post('/user-create', [UserController::class, 'store'])->name('user.create')->middleware('can:user.create');
    Route::put('/user-update/{user}', [UserController::class, 'update'])->name('user.update')->middleware('can:');
    Route::delete('/user-delete/{user}', [UserController::class, 'delete'])->name('user.delete')->middleware('can:user.delete');
    Route::get('/user-status/{user}', [UserController::class, 'status'])->name('user.status')->middleware('can:user.status');

    // yangi route
    Route::post('/add-user/{staf}', [StafController::class, 'add_user'])->name('add.user')->middleware('can:add.user');
    Route::post('update-role/{staf}', [StafController::class, 'update_role'])->name('update.role')->middleware('can:update.role');
    Route::get('/role', [RoleController::class, 'index'])->name('role')->middleware('can:role');
    Route::post('/role-create', [RoleController::class, 'store'])->name('role.create')->middleware('can:role.create');
    Route::put('/role-update/{role}', [RoleController::class, 'update'])->name('role.update')->middleware('can:role.update');
    Route::delete('/role-delete/{role}', [RoleController::class, 'delete'])->name('role.delete')->middleware('can:role.delete');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('can:admin');
    Route::get('/status_failed/{applications}', [AdminController::class, 'status_failed'])->name('status_failed')->middleware('can:status_failed');
    Route::get('/send-to-production/{applications}', [AdminController::class, 'send_to_production'])->name('send_to_production')->middleware('can:send_to_production');
    Route::get('/status-all/{key}', [AdminController::class, 'status_all'])->name('status_all')->middleware('can:status_all');
    Route::get('/status/{applications}', [ApplicationsController::class, 'status'])->name('status')->middleware('can:status');
    Route::get('/tabel', [TabelController::class, 'index'])->name('tabel')->middleware('can:tabel');
    Route::post('/tabels-store', [TabelController::class, 'store'])->name('tabels.store')->middleware('can:tabels.store');
    Route::put('/tabels-update/{tabel}', [TabelController::class, 'update'])->name('tabels.update')->middleware('can:tabels.store');
    Route::get('/tabels-date', [TabelController::class, 'date'])->name('tabels.date')->middleware('can:tabels.date');
    // Route::get('/applications-all/{key}', [ProductProductionController::class, 'applications_all'])->name('applications_all')->middleware('');

    // |ishlabchiq
    Route::get('/order-app', [OrderAppController::class, 'index'])->name('order_app.list')->middleware('can:order_app.list');
    Route::get('/order-app/{key}', [OrderAppController::class, 'status'])->name('order_app.status')->middleware('can:order_app.status');
    Route::post('/order-create/{applicationModelProduct}', [OrderAppController::class, 'store'])->name('order_app.create')->middleware('can:order_app.create');
    Route::get('/order-show/{application}', [OrderAppController::class, 'show'])->name('order_app.show')->middleware('can:order_app.show');
    
    Route::get('/shot-factura', [ShotFacturaController::class, 'index'])->name('shot.factura')->middleware('can:shot.factura');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit-password', [UserController::class, 'editPassword'])->name('edit.password');

    // + yangi - permission
    Route::get('/kassa', [AdminCassaController::class, 'index'])->name('kassa')->middleware('can:admin');
    Route::get('/kassa-status/{key}/{startDate}/{endDate}', [AdminCassaController::class, 'status'])->name('kassa.status')->middleware('can:admin');
    Route::get('/kassa-search/{key}', [AdminCassaController::class, 'search'])->name('kassa.search')->middleware('can:admin');
    // + yangi - permission   

    // Rashod
    Route::get('/rashod', [RashodController::class, 'index'])->name('rashod')->middleware('can:rashod');
    Route::post('/rashod', [RashodController::class, 'store'])->name('rashod.add')->middleware('can:rashod.add');
    Route::get('/status-rashor/{key}', [RashodController::class, 'status'])->name('statusRashor')->middleware('can:statusRashor');
    Route::post('/add-rasxod', [RashodController::class, 'addRasxod'])->name('addRasxod')->middleware('can:addRasxod');
    Route::get('/rashod-status/{key}', [AdminController::class, 'statusRashod'])->name('rashodStatus')->middleware('can:rashodStatus');


    // Customer routes
    Route::get('/customer-list', [CustomerController::class, 'index'])->name('customer.list')->middleware('can:customer.list');
    Route::get('/customer-show/{customer}', [CustomerController::class, 'show'])->name('customer.show')->middleware('can:customer.show');
    Route::post('/customer-createt', [CustomerController::class, 'store'])->name('customer.create')->middleware('can:customer.create');
    Route::put('/customer-update/{customer}', [CustomerController::class, 'update'])->name('customer.update')->middleware('can:customer.update');
    Route::delete('/customer-delete/{customer}', [CustomerController::class, 'delete'])->name('customer.delete')->middleware('can:customer.delete');
    Route::get('/customer-status/{customer}', [CustomerController::class, 'status'])->name('customer.status')->middleware('can:customer.create');

    // Firm routes
    Route::get('/firm-list', [FirmsController::class, 'index'])->name('firm.list')->middleware('can:firm.list');
    Route::post('/firm-createt/{id}', [FirmsController::class, 'store'])->name('firm.create')->middleware('can:firm.create');
    Route::put('/firm-update/{firm}', [FirmsController::class, 'update'])->name('firm.update')->middleware('can:firm.update');
    Route::delete('/firm-delete/{firm}', [FirmsController::class, 'delete'])->name('firm.delete')->middleware('can:firm.delete');
    Route::get('/firm-status/{firm}', [FirmsController::class, 'status'])->name('firm.status')->middleware('can:firm.create');

    // Salary Type, Department, Staf, Equipment

    // Department routes
    Route::get('/department-list', [DepartmentController::class, 'index'])->name('department.list')->middleware('can:department.list');
    Route::post('/department-createt', [DepartmentController::class, 'store'])->name('department.create')->middleware('can:department.create');
    Route::put('/department-update/{department}', [DepartmentController::class, 'update'])->name('department.update')->middleware('can:department.update');
    Route::delete('/department-delete/{department}', [DepartmentController::class, 'delete'])->name('department.delete')->middleware('can:department.delete');

    // Salary Type routes
    Route::get('/salarytype-list', [SalaryTypeController::class, 'index'])->name('salarytype.list')->middleware('can:salarytype.list');
    Route::post('/salarytype-createt', [SalaryTypeController::class, 'store'])->name('salarytype.create')->middleware('can:salarytype.create');
    Route::put('/salarytype-update/{salarytype}', [SalaryTypeController::class, 'update'])->name('salarytype.update')->middleware('can:salarytype.update');
    Route::delete('/salarytype-delete/{salarytype}', [SalaryTypeController::class, 'delete'])->name('salarytype.delete')->middleware('can:salarytype.delete');


    // Staff routes
    Route::get('/staf-list', [StafController::class, 'index'])->name('staf.list')->middleware('can:staf.list');
    Route::post('/staf-createt', [StafController::class, 'store'])->name('staf.create')->middleware('can:staf.create');
    Route::get('/staf-show/{staf}', [StafController::class, 'show'])->name('staf.show')->middleware('can:staf.show');
    Route::get('/staf-view/{staf}', [StafController::class, 'view'])->name('staf.view')->middleware('can:staf.view');
    Route::post('/staf-add-equipment/{staf}', [StafController::class, 'add_equipment'])->name('staf.add_equipment')->middleware('can:staf.add_equipment');
    Route::put('/staf-update/{staf}', [StafController::class, 'update'])->name('staf.update')->middleware('can:staf.update');
    Route::delete('/staf-delete/{staf}', [StafController::class, 'delete'])->name('staf.delete')->middleware('can:staf.delete');
    Route::delete('/staf-equipment-delete/{staf}/{id}', [StafController::class, 'equipment_delete'])->name('staf.equipment_delete')->middleware('can:staf.equipment_delete');

    // Kuryer CRUD
    Route::get('/courier-list', [CourierController::class, 'index'])->name('courier.list')->middleware('can:courier.list');
    Route::post('/courier-createt', [CourierController::class, 'store'])->name('courier.create')->middleware('can:courier.create');
    Route::get('/courier-show/{courier}', [CourierController::class, 'show'])->name('courier.show')->middleware('can:courier.show');
    Route::put('/courier-update/{courier}', [CourierController::class, 'update'])->name('courier.update')->middleware('can:courier.update');
    Route::delete('/courier-delete/{courier}', [CourierController::class, 'delete'])->name('courier.delete')->middleware('can:courier.delete');
    Route::get('/courier-status/{courier}', [CourierController::class, 'status'])->name('courier.status')->middleware('can:courier.list');

    // Equipment routes |ishlabchiq
    Route::get('/equipment-list', [EquipmentController::class, 'index'])->name('equipment.list')->middleware('can:equipment.list');
    Route::post('/equipment-createt', [EquipmentController::class, 'store'])->name('equipment.create')->middleware('can:equipment.create');
    Route::put('/equipment-update/{equipment}', [EquipmentController::class, 'update'])->name('equipment.update')->middleware('can:equipment.update');
    Route::delete('/equipment-delete/{equipment}', [EquipmentController::class, 'delete'])->name('equipment.delete')->middleware('can:equipment.delete');

    // Bugalter oylik berish va jarimaga tortish

    // Salary routes hodimga oylik berish qismi
    Route::get('/salary-list', [SalaryController::class, 'index'])->name('salary.list')->middleware('can:salary.list');
    Route::post('/salary-createt', [SalaryController::class, 'store'])->name('salary.create')->middleware('can:salary.create');
    Route::put('/salary-update/{salary}', [SalaryController::class, 'update'])->name('salary.update')->middleware('can:salary.update');
    Route::delete('/salary-delete/{salary}', [SalaryController::class, 'delete'])->name('salary.delete')->middleware('can:salary.delete');
    Route::get('/salary-search', [SalaryController::class, 'search'])->name('salary.search')->middleware('can:salary.search');

    // Jarimalar
    Route::post('/fines-createt', [FinesController::class, 'store'])->name('fines.create')->middleware('can:fines.create');

    // Nakladnoy routes  shartnomalari
    Route::get('/nakladnoy-list', [NakladnoyController::class, 'index'])->name('nakladnoy.list')->middleware('can:nakladnoy.list');
    Route::get('/nakladnoy-view/{nakladnoy}', [NakladnoyController::class, 'view'])->name('nakladnoy.view')->middleware('can:nakladnoy.view');
    Route::put('/nakladnoy-update/{nakladnoy}', [NakladnoyController::class, 'update'])->name('nakladnoy.update')->middleware('can:nakladnoy.update');
    Route::delete('/nakladnoy-delete/{nakladnoy}', [NakladnoyController::class, 'delete'])->name('nakladnoy.delete')->middleware('can:nakladnoy.delete');

    // Prihod routes  material
    Route::get('/prixod-list', [PrixodController::class, 'index'])->name('prixod.list')->middleware('can:prixod.list');
    Route::post('/prixod-createt', [PrixodController::class, 'store'])->name('prixod.create')->middleware('can:prixod.create');
    Route::put('/prixod-update/{prixod}', [PrixodController::class, 'update'])->name('prixod.update')->middleware('can:prixod.update');
    Route::delete('/prixod-delete/{prixod}', [PrixodController::class, 'delete'])->name('prixod.delete')->middleware('can:prixod.delete');

    // Material ulashish
    Route::post('/material-share', [ShareController::class, 'index'])->name('material.share')->middleware('can:material.share');
    // Route::post('/material-share/{material}/{materialStokValue}', [MaterialController::class, 'share'])->name('material.share')->middleware('can:');
    // Route::post('/material-share1/{material}', [MaterialController::class, 'share1'])->name('material.share1')->middleware('can:');


    // Prihod routes maxsulotlarni qabul qilish
    Route::get('/material-list', [MaterialController::class, 'index'])->name('material.list')->middleware('can:material.list');
    Route::post('/material-createt', [MaterialController::class, 'store'])->name('material.create')->middleware('can:material.create');
    Route::put('/material-update/{material}', [MaterialController::class, 'update'])->name('material.update')->middleware('can:material.update');
    Route::delete('/material-delete/{material}', [MaterialController::class, 'delete'])->name('material.delete')->middleware('can:material.delete');
    // Route::get('/material-acceptance', [MaterialStokValueController::class, 'acceptance'])->name('material.acceptance')->middleware('can:');
    // Route::get('/material-send', [MaterialStokValueController::class, 'send'])->name('material.send')->middleware('can:');

    // Search Material Stok
    Route::get('/material-stok', [MaterialStokController::class, 'search'])->name('material_stok.search')->middleware('can:material_stok.search');

    // Material_stoks routes ombor crud

    Route::get('/material-stoks-list', [MaterialStokController::class, 'index'])->name('material_stoks.list')->middleware('can:material_stoks.list');
    Route::post('/material-stoks-createt', [MaterialStokController::class, 'store'])->name('material_stoks.create')->middleware('can:material_stoks.create');
    Route::get('/material-stoks-show/{material}', [MaterialStokController::class, 'show'])->name('material_stoks.show')->middleware('can:material_stoks.show');
    Route::put('/material-stoks-update/{material}', [MaterialStokController::class, 'update'])->name('material_stoks.update')->middleware('can:material_stoks.update');
    Route::delete('/material-stoks-delete/{material}', [MaterialStokController::class, 'delete'])->name('material_stoks.delete')->middleware('can:material_stoks.delete');
    Route::get('/material-stoks-status/{material}', [MaterialStokController::class, 'status'])->name('material_stoks.status')->middleware('can:material_stoks.status');

    // Product_stoks routes ombor crud

    Route::get('/product-stoks-list', [ProductStokController::class, 'index'])->name('product_stoks.list')->middleware('can:product_stoks.list');
    Route::post('/product-stoks-createt', [ProductStokController::class, 'store'])->name('product_stoks.create')->middleware('can:product_stoks.create');
    Route::get('/product-stoks-show/{productStok}', [ProductStokController::class, 'show'])->name('product_stoks.show')->middleware('can:product_stoks.show');
    Route::put('/product-stoks-update/{productStok}', [ProductStokController::class, 'update'])->name('product_stoks.update')->middleware('can:product_stoks.update');
    Route::delete('/product-stoks-delete/{productStok}', [ProductStokController::class, 'delete'])->name('product_stoks.delete')->middleware('can:product_stoks.delete');
    Route::get('/product-stoks-status/{productStok}', [ProductStokController::class, 'status'])->name('product_stoks.status')->middleware('can:product_stoks.status');


    // Product model routes crud |ishlabchiq
    Route::get('/product-model-list', [ProductModelController::class, 'index'])->name('product_model.list')->middleware('can:product_model.list');
    Route::post('/product-model-createt', [ProductModelController::class, 'store'])->name('product_model.create')->middleware('can:product_model.create');
    Route::put('/product-model-update/{product_model}', [ProductModelController::class, 'update'])->name('product_model.update')->middleware('can:product_model.update');
    Route::delete('/product-model-delete/{product_model}', [ProductModelController::class, 'delete'])->name('product_model.delete')->middleware('can:product_model.delete');

    // Product ModelStructure  routes crud
    Route::get('/product-model-img-delete/{id}', [ProductModelController::class, 'img_delete'])->name('product_model_img.delete')->middleware('can:product_model_img.delete');
    Route::get('/product-model-input-delete/{id}', [ProductModelController::class, 'input_delete'])->name('product_model_input.delete')->middleware('can:product_model_input.delete');


    // Product ishlab chiqarishroutes crud |ishlabchiq
    Route::get('/product-production-list', [ProductProductionController::class, 'index'])->name('product_production.list')->middleware('can:product_production.list');
    Route::post('/product-production-createt', [ProductProductionController::class, 'store'])->name('product_production.create')->middleware('can:product_production.create');
    Route::put('/product-production-update/{product_model}', [ProductProductionController::class, 'update'])->name('product_production.update')->middleware('can:product_production.update');
    Route::delete('/product-production-delete/{product_model}', [ProductProductionController::class, 'delete'])->name('product_production.delete')->middleware('can:product_production.delete');

    // Product Stanok ishlab chiqarish |ishlabchiq zakaz
    Route::get('/product-production-order-list', [ModelProductOrderController::class, 'index'])->name('product_production_order.list')->middleware('can:product_production_order.list');
    // Stanok Order Status
    Route::get('/statusUpdate/{product}', [ModelProductOrderController::class, 'statusUpdate'])->name('statusUpdate')->middleware('can:statusUpdate');
    Route::post('/finished/{product}', [ModelProductOrderController::class, 'finished'])->name('finished')->middleware('can:finished');



    // Product ModelStructure  routes crud
    Route::get('/model-structure-list', [ModelStructureController::class, 'index'])->name('model_structure.list')->middleware('can:model_structure.list');
    Route::post('/model-structure-create/{product_model}', [ModelStructureController::class, 'store'])->name('model_structure.create')->middleware('can:model_structure.create');
    Route::put('/model-structure-update/{product_model}', [ModelStructureController::class, 'update'])->name('model_structure.update')->middleware('can:model_structure.update');
    Route::delete('/model-structure-delete/{product_model}', [ModelStructureController::class, 'delete'])->name('model_structure.delete')->middleware('can:model_structure.delete');

    // Product Sklad  routes crud
    Route::get('/product-stok-value-list', [ProductStokValueController::class, 'index'])->name('product_stok_value.list')->middleware('can:product_stok_value.list');
    Route::post('/product-stok-value-create/{product_model}', [ProductStokValueController::class, 'store'])->name('product_stok_value.create')->middleware('can:product_stok_value.create');
    Route::put('/product-stok-value-update/{product_model}', [ProductStokValueController::class, 'update'])->name('product_stok_value.update')->middleware('can:product_stok_value.update');
    Route::delete('/product-stok-value-delete/{product_model}', [ProductStokValueController::class, 'delete'])->name('product_stok_value.delete')->middleware('can:product_stok_value.delete');
    // Search Material Stok
    Route::get('/product-stok-value-search', [ProductStokValueController::class, 'search'])->name('product_stok_value.search')->middleware('can:product_stok_value.search');
    Route::post('/product-stok-value-share', [ProductStokValueController::class, 'share_product'])->name('product.share')->middleware('can:product.share');

    // Product Sklad  routes crud
    Route::get('/applications-list', [ApplicationsController::class, 'index'])->name('applications.list')->middleware('can:applications.list');
    Route::get('/applications/{application}', [ApplicationsController::class, 'show'])->name('application.show')->middleware('can:application.show');
    Route::get('/applicationOneModel/{application}', [ApplicationsController::class, 'OneModel'])->name('OneModel.show')->middleware('can:OneModel.show');
    Route::get('/applications-list/{application}', [ApplicationsController::class, 'view'])->name('applications.show')->middleware('can:applications.show');

    Route::get('/application-price/{application}', [ApplicationsController::class, 'price'])->name('price.show')->middleware('can:price.show');
    Route::get('/application-view/{application}', [ApplicationsController::class, 'view'])->name('application.view')->middleware('can:application.view');
    Route::post('/applications', [ApplicationsController::class, 'store'])->name('applications.create')->middleware('can:applications.create');
    Route::put('/applications-update/{applications}', [ApplicationsController::class, 'update'])->name('applications.update')->middleware('can:applications.update');
    Route::get('/delete-application-model-product/{id}', [ApplicationsController::class, 'delete_application_model_product'])->name('delete_application_model_product.delete')->middleware('can:delete_application_model_product.delete');
    Route::delete('/applications-delete/{applications}', [ApplicationsController::class, 'delete'])->name('applications.delete')->middleware('can:applications.delete');
    Route::post('/add-curier/{applications}', [ApplicationsController::class, 'add_curier'])->name('add.curier')->middleware('can:add.curier');


    Route::post('/nakladnoy-add', [NakladnoyController::class, 'store'])->name('nakladnoy.store')->middleware('can:nakladnoy.store');

    // TelegramBotHandler
    Route::post('/delivery-bot/{application}', [DeliveryBotController::class, 'store'])->name('delivery.bot')->middleware('can:delivery.bot');
});


// require __DIR__ . '/auth.php';
