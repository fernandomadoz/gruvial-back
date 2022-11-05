<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Trabajo_encabezadoController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\Trabajo_lineaController;
use App\Http\Controllers\Unidad_de_trabajoController;
use App\Http\Controllers\Tipo_de_trabajoController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\Tipo_de_facturaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Plan_de_cuentaController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\CobroController;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\Causa_de_baja_de_chequeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Tipo_de_cobroController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\Razon_socialController;
use App\Http\Controllers\NotaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [UserController::class, 'login']);

Route::group( ['middleware' => ["auth:sanctum"]], function(){
    //rutas
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::post('trabajo-encabezado-listar', [Trabajo_encabezadoController::class, 'listarTrabajosPorFirma']);
    Route::post('trabajo-linea-listar', [Trabajo_lineaController::class, 'listarTrabajosLineasPorTrabajo']);
    Route::post('trabajo-compra-listar', [CompraController::class, 'listarComprasPorTrabajo']);
    Route::post('trabajo-cobro-listar', [CobroController::class, 'listarCobrosPorTrabajo']);
    Route::post('trabajo-factura-listar', [FacturaController::class, 'listarFacturasPorTrabajo']);
    Route::post('trabajo-nota-listar', [NotaController::class, 'listarNotasPorTrabajo']);
    Route::post('remitos-de-trabajo', [Trabajo_encabezadoController::class, 'remitosPorTrabajo']);
    Route::post('facturas-de-trabajo', [Trabajo_encabezadoController::class, 'facturasPorTrabajo']);

    Route::get('user', [UserController::class, 'index']);
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    //Route::post('/trabajo-encabezado-listar', 'Trabajo_encabezadoController@listarTrabajosPorFirma');


 
Route::resources([
    'trabajo-encabezado' => Trabajo_encabezadoController::class,
    'trabajo-linea' => Trabajo_lineaController::class,
    'firma' => FirmaController::class,
    'cliente' => ClienteController::class,
    'barrio' => BarrioController::class,
    'maquina' => MaquinaController::class,
    'tipo_de_trabajo' => Tipo_de_trabajoController::class,
    'unidad_de_trabajo' => Unidad_de_trabajoController::class,
    'tipo-de-factura' => Tipo_de_facturaController::class,
    'razon-social' => Razon_socialController::class,
    'factura' => FacturaController::class,
    'nota' => NotaController::class,
    'plan-de-cuenta' => Plan_de_cuentaController::class,
    'cuenta' => CuentaController::class,
    'compra' => CompraController::class,
    'cobro' => CobroController::class,
    'banco' => BancoController::class,
    'causa-de-baja-de-cheque' => Causa_de_baja_de_chequeController::class,
    'persona' => PersonaController::class,
    'tipo-de-cobro' => Tipo_de_cobroController::class,
]);

