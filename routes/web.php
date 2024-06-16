<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LugaresController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\TuristaController;
use App\Http\Controllers\EmprendedorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\CheckTuristaRole;
use App\Http\Middleware\CheckEmprendedorRole;
use App\Http\Middleware\Authenticated;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/', function () {
    return view('login');
});

// Rutas de autenticación
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showChangePasswordForm'])->name('forgot-password');
Route::post('/change-password', [ForgotPasswordController::class, 'changePassword'])->name('changePassword');



// Rutas protegidas Admin
Route::middleware([Authenticated::class, CheckAdminRole::class])->group(function () {
    // Ejemplo:
    Route::get('/admin', function () {
        return view('/admin/dashboard');
    });

    //CRUD Lugares
    Route::get('/admin/lugares', [LugaresController::class, 'index'])->name('lugares.index');
    Route::post('/admin/lugares/getTablaLugares', [LugaresController::class, 'getTablaLugares'])->name('lugares.getTablaLugares');
    Route::post('/admin/lugares/getTablaMunicipioByIdDepto', [LugaresController::class, 'getTablaMunicipioByIdDepto'])->name('lugares.getTablaMunicipioByIdDepto');
    Route::post('/admin/lugares/save', [LugaresController::class, 'save'])->name('lugares.save');
    Route::post('/admin/lugares/destroy', [LugaresController::class, 'destroy'])->name('lugares.destroy');
    Route::post('/admin/lugares/updateImage', [LugaresController::class, 'updateImage'])->name('lugares.updateImage');
    Route::post('/admin/lugares/update', [LugaresController::class, 'update'])->name('lugares.update');

    //CRUD Usuarios
    Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::post('/admin/usuarios/getTablaUsuarios', [UsuarioController::class, 'getTablaUsuarios'])->name('usuarios.getTablaUsuarios');
    Route::post('/admin/usuarios/getTablaUsuarioById', [UsuarioController::class, 'getTablaUsuarioById'])->name('usuarios.getTablaUsuarioById');
    Route::post('/admin/usuarios/save', [UsuarioController::class, 'save'])->name('usuarios.save');
    Route::post('/admin/usuarios/destroy', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    Route::post('/admin/usuarios/updateImage', [UsuarioController::class, 'updateImage'])->name('usuarios.updateImage');
    Route::post('/admin/usuarios/update', [UsuarioController::class, 'update'])->name('usuarios.update');

    //Actualizar password
    Route::get('/admin/usuarios/vResetPassword', [UsuarioController::class, 'indexResetPassword'])->name('usuarios.indexResetPassword');
    Route::post('/admin/usuarios/getCorreo', [UsuarioController::class, 'getCorreo'])->name('usuarios.getCorreo');
    Route::post('/admin/usuarios/changePassword', [UsuarioController::class, 'changePassword'])->name('usuarios.changePassword');

    //CRUD Categorias
    Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/admin/categorias/getTablaCategorias', [CategoriaController::class, 'getTablaCategorias'])->name('categorias.getTablaCategorias');
    Route::post('/admin/categorias/save', [CategoriaController::class, 'save'])->name('categorias.save');
    Route::post('/admin/categorias/destroy', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::post('/admin/categorias/update', [CategoriaController::class, 'update'])->name('categorias.update');

    //CRUD Municipios
    Route::get('/admin/municipios', [MunicipioController::class, 'index'])->name('municipio.index');
    Route::post('/admin/municipios/getTablaMunicipios', [MunicipioController::class, 'getTablaMunicipios'])->name('municipio.getTablaMunicipios');
    Route::post('/admin/municipios/save', [MunicipioController::class, 'save'])->name('municipio.save');
    Route::post('/admin/municipios/destroy', [MunicipioController::class, 'destroy'])->name('municipio.destroy');
    Route::post('/admin/municipios/update', [MunicipioController::class, 'update'])->name('municipio.update');

    //CRUD Departamento
    Route::get('/admin/departamentos', [DepartamentoController::class, 'index'])->name('departamentos.index');
    Route::post('/admin/departamentos/getTablaDepartamentos', [DepartamentoController::class, 'getTablaDepartamentos'])->name('departamentos.getTablaDepartamentos');
    Route::post('/admin/departamentos/save', [DepartamentoController::class, 'save'])->name('departamentos.save');
    Route::post('/admin/departamentos/destroy', [DepartamentoController::class, 'destroy'])->name('departamentos.destroy');
    Route::post('/admin/departamentos/update', [DepartamentoController::class, 'update'])->name('departamentos.update');
});

// Rutas protegidas para los emprendedores
Route::middleware([Authenticated::class, CheckEmprendedorRole::class])->group(function () {
//Emprendedor
    //Dashboard
    Route::get('/emprendedor/dashboard', [EmprendedorController::class, 'index'])->name('emprendedor.index');
    Route::post('/emprendedor/getTablaLugaresByUserId', [EmprendedorController::class, 'getTablaLugaresByUserId'])->name('emprendedor.getTablaLugaresByUserId');
    Route::post('/emprendedor/getTablaUsuariosByUserId', [EmprendedorController::class, 'getTablaUsuariosByUserId'])->name('emprendedor.getTablaUsuariosByUserId');
    Route::post('/emprendedor/getTablaMunicipioByIdDepto', [EmprendedorController::class, 'getTablaMunicipioByIdDepto'])->name('emprendedor.getTablaMunicipioByIdDepto');
    Route::post('/emprendedor/save', [EmprendedorController::class, 'save'])->name('emprendedor.save');
    Route::post('/emprendedor/destroy', [EmprendedorController::class, 'destroy'])->name('emprendedor.destroy');
    Route::post('/emprendedor/updateImage', [EmprendedorController::class, 'updateImage'])->name('emprendedor.updateImage');
    Route::post('/emprendedor/update', [EmprendedorController::class, 'update'])->name('emprendedor.update');

    //Perfil
    Route::get('/emprendedor/profile', [EmprendedorController::class, 'profile'])->name('emprendedor.profile');
    Route::post('/emprendedor/setProfileUserId', [EmprendedorController::class, 'setProfileUserId'])->name('emprendedor.setProfileUserId');
    Route::post('/emprendedor/profile/updateImageProfile', [EmprendedorController::class, 'updateImageProfile'])->name('emprendedor.updateImageProfile');
    Route::post('/emprendedor/profile/getImage', [EmprendedorController::class, 'getImage'])->name('emprendedor.getImage');
    Route::post('/emprendedor/updateProfile', [EmprendedorController::class, 'updateProfile'])->name('emprendedor.updateProfile');

    //PostDetails
    Route::get('/emprendedor/postDetails/{id}', [EmprendedorController::class, 'postDetails'])
        ->where('id', '[0-9]+')->name('emprendedor.postDetails'); // Permite solo numeros enteros, caso contrario aparece pagina 404
    Route::post('/emprendedor/allCommentsByLugar', [EmprendedorController::class, 'allCommentsByLugar'])->name('emprendedor.allCommentsByLugar');
    Route::post('/emprendedor/ShowValoracionesLugar', [EmprendedorController::class, 'ShowValoracionesLugar'])->name('emprendedor.ShowValoracionesLugar');
    Route::post('/emprendedor/getAllValoracionByLugar', [EmprendedorController::class, 'getAllValoracionByLugar'])->name('emprendedor.getAllValoracionByLugar');

    //Ver otras publicaciones
    Route::get('/emprendedor/getAll', [EmprendedorController::class, 'getAll'])->name('emprendedor.getAll');
    Route::post('/emprendedor/getTablaLugares', [EmprendedorController::class, 'getTablaLugares'])->name('emprendedor.getTablaLugares');
});

// Rutas protegidas para los turistas
Route::middleware([Authenticated::class, CheckTuristaRole::class])->group(function () {
    // Turista
    Route::get('/turista/dashboard', [TuristaController::class, 'index'])->name('turista.index');
    // Route::get('/turista/profile/{id}', [TuristaController::class, 'profile'])->name('turista.profile');
    Route::get('/turista/profile', [TuristaController::class, 'profile'])->name('turista.profile');
    Route::post('/turista/dashboard/getCategorias', [TuristaController::class, 'getCategorias'])->name('turista.getCategorias');
    Route::post('/turista/dashboard/findByMunicipio', [TuristaController::class, 'findByMunicipio'])->name('turista.findByMunicipio');
    Route::post('/turista/dashboard/findByCategorias', [TuristaController::class, 'findByCategorias'])->name('turista.findByCategorias');
    Route::post('/turista/dashboard/findByDescripcion', [TuristaController::class, 'findByDescripcion'])->name('turista.findByDescripcion');
    Route::post('/turista/dashboard/findByNombre', [TuristaController::class, 'findByNombre'])->name('turista.findByNombre');
    Route::post('/turista/profile/update', [TuristaController::class, 'update'])->name('turista.update');
    Route::post('/turista/profile/updateImage', [TuristaController::class, 'updateImage'])->name('turista.updateImage');
    Route::post('/turista/profile/getImage', [TuristaController::class, 'getImage'])->name('turista.getImage');

    Route::get('/turista/postDetails/{id}', [TuristaController::class, 'postDetails'])
        ->where('id', '[0-9]+')->name('turista.postDetails'); // Permite solo numeros enteros, caso contrario aparece pagina 404

    Route::post('/turista/Comments/', [TuristaController::class, 'allComments'])->name('turista.allComments');
    Route::post('/turista/createComment/', [TuristaController::class, 'createComment'])->name('turista.createComment');

    Route::post('/turista/setProfileUserId', [TuristaController::class, 'setProfileUserId'])->name('turista.setProfileUserId');

    Route::post('/turista/saveValoracion/', [TuristaController::class, 'saveValoracion'])->name('turista.saveValoracion');
    Route::post('/turista/ShowValoracionesLugar/', [TuristaController::class, 'ShowValoracionesLugar'])->name('turista.ShowValoracionesLugar');
    Route::post('/turista/GetValoraciones/', [TuristaController::class, 'GetValoraciones'])->name('turista.GetValoraciones');
    Route::post('/turista/ValoracionUsusarioLugar/', [TuristaController::class, 'valoracionUsuarioLugar'])->name('turista.ValoracionUsusarioLugar');
    Route::post('/turista/updateComment/', [TuristaController::class, 'actualizarComentario'])->name('turista.updateComment');
    Route::post('/turista/deleteComment/', [TuristaController::class, 'eliminarComentario'])->name('turista.deleteComment');
});
