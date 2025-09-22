<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cita;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\DashVehiculosController;
use App\Http\Controllers\RestauracionAjaxController;
use App\Http\Controllers\SolicitudVehiculoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RestauracionController;
use App\Http\Controllers\AdminRestauracionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MensajeAController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\CitaAController;






use App\Services\GoogleService;

use App\Models\Vehicle;
use App\Models\Repair;
// Página de inicio
Route::get('/', [UserController::class, 'indexNormal'])->name('index');

Route::middleware(['auth'])->get('/dashvehiculos', function () {
    return view('dashvehiculos');
});

Route::get('/login', function () {
    return view('login');
})->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard para usuarios normales
Route::get('/dashvehiculos', function () {
    return view('dashvehiculos');
})->name('dashvehiculos')->middleware('auth');

// Rutas para coches
Route::get('/dashvehiculos', [DashVehiculosController::class, 'index'])->name('dashvehiculos');
Route::get('/coches', [DashVehiculosController::class, 'getCoches']); // 🔹 Nueva ruta para JSON
Route::get('/coches/{id}', [DashVehiculosController::class, 'getCochePorId']); // Obtener un coche específico



// Header Status
Route::get('/header-status', function () {
    return view('partials.header-status');
})->name('header.status');

// Servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');

// Restauraciones

// Ruta para la página principal de restauraciones
Route::get('/restauraciones', [RestauracionAjaxController::class, 'index'])->name('restauraciones.index');

// Ruta para cargar vistas parciales con AJAX
Route::post('/restauraciones/load-partial', [RestauracionAjaxController::class, 'loadPartial'])->name('restauraciones.loadPartial');



// Enviar matrícula
Route::post('/matricula/enviar', [MatriculaController::class, 'enviarMatricula'])->name('matricula.enviar')->middleware('auth');

// Rutas para administradores protegidas con el middleware 'auth' y 'role:1'
Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminController::class);  // Esto debería funcionar para todas las rutas CRUD de usuarios
    Route::resource('roles', RoleController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('repairs', RepairController::class);
    Route::resource('solicitudes', SolicitudVehiculoController::class);
});


// Rutas para los usuarios
Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index'); // Listado de usuarios
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create'); // Crear usuario
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.storeUser'); // Almacenar usuario
Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.updateUser'); 
Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/dashboard', [AdminController::class, 'indexDash'])->name('admin.dashboard');

// Rutas para los vehículos
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');


// Rutas de facturas
Route::get('admin/invoices', [InvoiceController::class, 'index'])->name('admin.invoices.index');
Route::get('admin/invoices/create', [InvoiceController::class, 'create'])->name('admin.invoices.create');
Route::post('admin/invoices', [InvoiceController::class, 'store'])->name('admin.invoices.store');
Route::get('admin/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('admin.invoices.edit');
Route::put('/admin/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
Route::delete('/admin/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');


Route::resource('invoices', InvoiceController::class);
Route::get('/obtener-vehiculos/{id}', [VehicleController::class, 'obtenerVehiculos']);
Route::get('/obtener-reparaciones/{id}', [RepairController::class, 'getReparaciones']);
Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');

Route::get('/repairs', [RepairController::class, 'index'])->name('admin.repairs.index');
Route::get('/repairs/create', [RepairController::class, 'create'])->name('admin.repairs.create');
Route::post('/repairs', [RepairController::class, 'store'])->name('repairs.store');
Route::get('/repairs/{id}/edit', [RepairController::class, 'edit'])->name('admin.repairs.edit'); // Ruta de edición
Route::put('/repairs/{id}', [RepairController::class, 'update'])->name('repairs.update');
Route::delete('/repairs/{id}', [RepairController::class, 'destroy'])->name('repairs.destroy');

Route::get('/vehiculos/porUsuario/{id}', [VehicleController::class, 'getVehiclesByUser']);

Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/solicitudes', [SolicitudVehiculoController::class, 'index'])->name('solicitudes.index');
    Route::patch('/solicitudes/{solicitud}/aprobar', [SolicitudVehiculoController::class, 'aprobar'])->name('solicitudes.aprobar');
    Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudVehiculoController::class, 'rechazar'])->name('solicitudes.rechazar');
    
});


Route::post('/solicitud-vehiculo', [SolicitudVehiculoController::class, 'store'])
    ->middleware('auth')
    ->name('solicitud-vehiculo.store');

    Route::post('/matricula/enviar', [MatriculaController::class, 'store'])
    ->middleware('auth')
    ->name('matricula.enviar');

    Route::get('/admin/matriculas', [MatriculaController::class, 'index'])
    ->middleware('auth')
    ->name('admin.matricula.index');

    Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('matriculas', MatriculaController::class);
    });

    Route::delete('matriculas/{id}', [MatriculaController::class, 'destroy'])->name('admin.matriculas.destroy');


    // Mostrar formulario para crear un nuevo rol
    Route::get('roles/create', [RoleController::class, 'create'])->name('admin.roles.create');

    // Almacenar un nuevo rol
    Route::post('roles', [RoleController::class, 'store'])->name('admin.roles.store');

    
    Route::get('roles', [RoleController::class, 'index'])->name('admin.roles.index');

// Eliminar un rol
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/admin/dashboard/combined-search', [DashboardController::class, 'combinedSearch'])->name('admin.dashboard.combined-search');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'editUser'])->name('admin.users.editUser');



Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
})->name('quienes-somos');


Route::get('/facturas/{id}/pdf', [InvoiceController::class, 'generarPDF']);


Route::post('/contacto/enviar', [ContactoController::class, 'enviarMensaje'])->name('contacto.enviar');

Route::get('/auth/google', [ContactoController::class, 'autenticarUsuario']);
Route::get('/oauth2callback', [ContactoController::class, 'callback'])->name('oauth.callback');


Route::get('/mecanico/dashboard', [MecanicoController::class, 'dashboard'])->name('mecanico.dashboard');

Route::prefix('mecanico')->middleware('auth')->group(function () {
    Route::get('/dashboard', [MecanicoController::class, 'dashboard'])->name('mecanico.dashboard');
    Route::get('/vehiculos', [MecanicoController::class, 'indexVehiculos'])->name('mecanico.vehicles.index');
    Route::get('/vehiculos/create', [MecanicoController::class, 'createVehiculo'])->name('mecanico.vehicles.create');
    Route::get('/vehiculos/{id}/edit', [MecanicoController::class, 'editVehiculo'])->name('mecanico.vehicles.edit');
    Route::delete('/vehiculos/{id}', [MecanicoController::class, 'destroyVehiculo'])->name('mecanico.vehicles.destroy');
    Route::post('/vehiculos', [MecanicoController::class, 'storeVehiculo'])->name('mecanico.vehicles.store');
    Route::put('/vehicles/{id}', [MecanicoController::class, 'updateVehiculo'])->name('mecanico.vehicles.update');

    Route::get('/reparaciones', [MecanicoController::class, 'indexReparaciones'])->name('mecanico.reparaciones.index');
    Route::get('/reparaciones/create', [MecanicoController::class, 'createReparacion'])->name('mecanico.reparaciones.create');
    Route::post('/reparaciones', [MecanicoController::class, 'storeReparacion'])->name('mecanico.reparaciones.store');
    Route::get('/reparaciones/{id}/edit', [MecanicoController::class, 'editReparacion'])->name('mecanico.reparaciones.edit'); // Ruta de edición
    Route::put('/reparaciones/{id}', [MecanicoController::class, 'updateReparacion'])->name('mecanico.reparaciones.update');
    Route::delete('/reparaciones/{id}', [MecanicoController::class, 'destroyReparacion'])->name('mecanico.reparaciones.destroy');

    Route::get('/facturas', [MecanicoController::class, 'indexFacturas'])->name('mecanico.facturas.index');
    Route::get('/facturas/create', [MecanicoController::class, 'createFactura'])->name('mecanico.facturas.create');
    Route::post('/facturas', [MecanicoController::class, 'storeFactura'])->name('mecanico.facturas.store');
    Route::get('/facturas/{id}/edit', [MecanicoController::class, 'editFactura'])->name('mecanico.facturas.edit'); // Ruta de edición
    Route::put('/facturas/{id}', [MecanicoController::class, 'updateFactura'])->name('mecanico.facturas.update');
    Route::delete('/facturas/{id}', [MecanicoController::class, 'destroyFactura'])->name('mecanico.facturas.destroy');
    // Agrega más rutas según sea necesario
    Route::resource('solicitudes', SolicitudVehiculoController::class);
    Route::get('/solicitudes', [SolicitudVehiculoController::class, 'indexSolicitudes'])->name('mecanico.solicitudes.index');
    Route::patch('/solicitudes/{solicitud}/aprobar', [SolicitudVehiculoController::class, 'aprobarSolicitudes'])->name('mecanico.solicitudes.aprobar');
    Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudVehiculoController::class, 'rechazarSolicitudes'])->name('mecanico.solicitudes.rechazar');

    Route::post('/matricula/enviar', [MatriculaController::class, 'storeMatriculas'])->name('matriculas.enviar');
    Route::get('/matriculas', [MatriculaController::class, 'indexMatriculas'])->name('mecanico.matriculas.index');
    Route::delete('/matriculas/{id}', [MatriculaController::class, 'destroyMatriculas'])->name('mecanico.matriculas.destroy');

    Route::get('/blog', [BlogController::class, 'indexBlog'])->name('mecanico.blog.index');
    Route::get('/blog/create', [BlogController::class, 'createBlog'])->name('mecanico.blog.create');
    Route::post('/blog', [BlogController::class, 'storeBlog'])->name('mecanico.blog.store');
    Route::get('/blog/{id}/edit', [BlogController::class, 'editBlog'])->name('mecanico.blog.edit');
    Route::put('/blog/{id}', [BlogController::class, 'updateBlog'])->name('mecanico.blog.update');
    Route::delete('/blog/{id}', [BlogController::class, 'destroyBlog'])->name('mecanico.blog.destroy');
    Route::post('/blog/upload', [BlogController::class, 'storeImageBlog'])->name('mecanico.blog.storeImage');

    Route::get('/restauraciones', [AdminRestauracionController::class, 'indexRestauraciones'])->name('mecanico.restauraciones.index');
    Route::get('/restauraciones/{id}/edit', [AdminRestauracionController::class, 'editRestauraciones'])->name('mecanico.restauraciones.edit');
    Route::put('/restauraciones/{id}', [AdminRestauracionController::class, 'updateRestauraciones'])->name('mecanico.restauraciones.update');
    Route::delete('/restauraciones/{id}', [AdminRestauracionController::class, 'destroyRestauraciones'])->name('mecanico.restauraciones.destroy');

    Route::get('/ofertas', [OfertaController::class, 'indexOfertas'])->name('mecanico.ofertas.index');
    Route::get('/ofertas/crear', [OfertaController::class, 'createOfertas'])->name('mecanico.ofertas.create');
    Route::post('/ofertas', [OfertaController::class, 'storeOfertas'])->name('mecanico.ofertas.store');
    Route::get('/ofertas/{oferta}/editar', [OfertaController::class, 'editOfertas'])->name('mecanico.ofertas.edit');
    Route::put('/ofertas/{oferta}', [OfertaController::class, 'updateOfertas'])->name('mecanico.ofertas.update');
    Route::delete('/ofertas/{id}', [OfertaController::class, 'destroyOfertas'])->name('mecanico.ofertas.destroy');

    Route::get('/citas', [CitaAController::class, 'indexCitas'])->name('mecanico.citas.index');
    Route::post('/citas/reservar', [CitaAController::class, 'storeCitas'])->name('mecanico.citas.reservar');
    Route::delete('/citas/{id}', [CitaAController::class, 'destroyCitas'])->name('mecanico.citas.eliminar');
    Route::get('/citas/ocupadas', [CitaAController::class, 'ocupadasCitas'])->name('mecanico.citas.ocupadas');
});


Route::post('/mecanico/gestion', [MecanicoController::class, 'gestionDatos'])->name('mecanico.gestion');


Route::get('/clientes/{usuario}/vehiculos', [ApiController::class, 'getVehiculosPorUsuario']);
Route::get('/vehiculos/{vehiculo}/reparaciones', [ApiController::class, 'getReparaciones']);
Route::get('/reparaciones/{reparacion}/facturas', [ApiController::class, 'getFacturas']);

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');


Route::prefix('admin/blog')->name('admin.blog.')->group(function () {
    Route::get('/', [BlogController::class, 'indexAdmin'])->name('index');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::post('/', [BlogController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BlogController::class, 'update'])->name('update');
    Route::delete('/{id}', [BlogController::class, 'destroy'])->name('destroy');
});

Route::post('/admin/blog/upload', [BlogController::class, 'storeImage'])->name('admin.blog.storeImage');




// Rutas exclusivas para administradores
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/restauracion/crear', [RestauracionController::class, 'create'])->name('restauraciones.create');
    Route::post('/restauracion', [RestauracionController::class, 'store'])->name('restauraciones.store');
});


Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/restauraciones', [AdminRestauracionController::class, 'index'])->name('admin.restauraciones.index');
    Route::get('/admin/restauraciones/{id}/edit', [AdminRestauracionController::class, 'edit'])->name('admin.restauraciones.edit');
    Route::put('/admin/restauraciones/{id}', [AdminRestauracionController::class, 'update'])->name('admin.restauraciones.update');
});


Route::get('/restauraciones', [RestauracionController::class, 'index'])->name('restauraciones.index');

Route::delete('/admin/restauraciones/{id}', [AdminRestauracionController::class, 'destroy'])->name('admin.restauraciones.destroy');


Route::post('/restauraciones/{id}/like', [LikeController::class, 'store'])->name('likes.store')->middleware('auth');
Route::delete('/restauraciones/{id}/like', [LikeController::class, 'destroy'])->name('likes.destroy')->middleware('auth');

// Ruta para eliminar el like por ID
Route::delete('/likes/by-id/{like}', [LikeController::class, 'destroyById'])->name('likes.destroyById')->middleware('auth');

Route::get('/reparaciones', [RepairController::class, 'indexUsuario'])->name('reparaciones.index');

Route::get('/facturas', [InvoiceController::class, 'indexUsuario'])->name('facturas.index');

Route::get('/coches/{id}', [DashVehiculosController::class, 'getDatosCoche']);

Route::get('/coches/{id}/reparaciones', [RepairController::class, 'getReparacionesPorCoche']);
Route::get('/coches/{id}/facturas', [InvoiceController::class, 'getFacturasPorCoche']);

Route::get('/registroVehiculo', function () {
    return view('registroVeh');
})->name('registroVehiculo');

Route::post('/likes/{restauracion}', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/likes/{restauracion}', [LikeController::class, 'destroy'])->name('likes.destroy');


Route::get('coche/{id}', [DashVehiculosController::class, 'getDatosCoche']);


Route::middleware('auth')->group(function () {
    Route::get('/chat', [MensajeController::class, 'index'])->name('chat.index');
    Route::post('/chat', [MensajeController::class, 'store'])->name('chat.store');
});


Route::middleware('auth')->group(function () {
    // Ruta para reservar citas
    Route::post('/citas/reservar', [CitaController::class, 'store'])->name('citas.store');

    // Otras rutas relacionadas con las citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
});

Route::get('/citas/ocupadas', function () {
    return response()->json(
        \App\Models\Cita::all()->map(function ($cita) {
            return [
                'title' => 'Ocupado',
                'start' => $cita->fecha . 'T' . $cita->hora, // Formato compatible con FullCalendar
                'color' => 'red'
            ];
        })
    );
});


Route::middleware('auth')->group(function () {
    Route::get('/mecanico/chat', [MensajeAController::class, 'index'])->name('mecanico.chat.index');
    Route::post('/mecanico/chat', [MensajeAController::class, 'store'])->name('mecanico.chat.store');
});





Route::get('/', [OfertaController::class, 'index'])->name('index');


Route::prefix('admin')->group(function () {
    Route::get('/ofertas', [OfertaController::class, 'indexAdmin'])->name('admin.ofertas.index');
    Route::get('/ofertas/crear', [OfertaController::class, 'create'])->name('admin.ofertas.create');
    Route::post('/ofertas', [OfertaController::class, 'store'])->name('admin.ofertas.store');
    Route::get('/ofertas/{oferta}/editar', [OfertaController::class, 'edit'])->name('admin.ofertas.edit');
    Route::put('/ofertas/{oferta}', [OfertaController::class, 'update'])->name('admin.ofertas.update');

    Route::delete('/ofertas/{id}', [OfertaController::class, 'destroy'])->name('admin.ofertas.destroy');
});


Route::prefix('admin')->group(function () {

Route::get('/citas', [CitaAController::class, 'index'])->name('admin.citas.index');
Route::post('/citas/reservar', [CitaAController::class, 'store'])->name('citas.reservar');
Route::delete('/citas/{id}', [CitaAController::class, 'destroy'])->name('citas.eliminar');
Route::get('/citas/ocupadas', [CitaAController::class, 'ocupadas'])->name('citas.ocupadas');

});


Route::get('/restauraciones/search', [RestauracionController::class, 'search'])->name('restauraciones.search');


Route::get('/mecanico/chat/no-leidos', [MensajeAController::class, 'mensajesNoLeidos'])->name('mecanico.chat.noLeidos');


Route::get('/mecanico/chat/no-leidos-por-usuario', function () {
    $user = auth()->user();
    $usuarios = User::where('id_rol', 3)->get();

    $data = $usuarios->map(function ($usuario) use ($user) {
        return [
            'id' => $usuario->id,
            'nombre' => $usuario->nombre,
            'noLeidos' => Mensaje::where('receptor_id', $user->id)
                ->where('emisor_id', $usuario->id)
                ->where('leido', false)
                ->count()
        ];
    });

    return response()->json($data);
})->name('mecanico.chat.noLeidosPorUsuario');


Route::get('/usuario/chat/no-leidos', [MensajeController::class, 'mensajesNoLeidosUsuario'])->name('usuario.chat.noLeidos');


Route::get('/chat/no-leidos-por-mecanico', function () {
    $user = auth()->user();
    $mecanicos = User::where('id_rol', 2)->get();

    $data = $mecanicos->map(function ($mecanico) use ($user) {
        return [
            'id' => $mecanico->id,
            'nombre' => $mecanico->nombre,
            'noLeidos' => Mensaje::where('receptor_id', $user->id)
                ->where('emisor_id', $mecanico->id)
                ->where('leido', false)
                ->count()
        ];
    });

    return response()->json($data);
})->name('chat.noLeidosPorMecanico');

// Página de política de cookies ("Saber más")
Route::get('/politica-cookies', function () {
    return view('politica-cookies');
})->name('politica-cookies');


