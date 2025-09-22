<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Repair;
use App\Models\Invoice;
use App\Models\User;


class MecanicoController extends Controller
{
    /**
     * Mostrar el dashboard del mecánico.
     */
    public function dashboard()
    {
        $usuarios = User::where('id_rol', 3)->get();
        return view('mecanico.dashboard' , compact('usuarios'));
    }

    /**
     * Mostrar los vehículos del mecánico.
     */
    public function indexVehiculos()
    {
        $users = User::where('id_rol', 3)->get();

        $vehiculos = Vehicle::paginate(10); // Obtener vehículos asignados al mecánico autenticado
        return view('mecanico.vehicles.index', compact('vehiculos', 'users'));
    }

    /**
     * Crear un nuevo vehículo.
     */
    public function createVehiculo()
    {
        $users = User::where('id_rol', 3)->get();

        return view('mecanico.vehicles.create' , compact('users'));
    }

    /**
     * Almacenar un nuevo vehículo.
     */
    public function storeVehiculo(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'matricula' => 'required|string|max:20|unique:coches,matricula',
        ]);

        // Crear el vehículo
        Vehicle::create([
            'id_usuario' => $request->id_usuario,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anio' => $request->anio,
            'matricula' => $request->matricula,
        ]);

        return redirect()->route('mecanico.vehicles.index')->with('success', 'Vehículo creado correctamente');
    }

    public function destroyVehiculo($id)
{
    $vehiculo = Vehicle::findOrFail($id);
    $vehiculo->delete();

    return redirect()->route('mecanico.vehicles.index')->with('success', 'Vehículo eliminado correctamente.');
}

public function editVehiculo($id)
{
    $vehicle = Vehicle::findOrFail($id); // Busca el vehículo o lanza un error 404
    
    $users = User::all(); // Obtiene todos los usuarios para el select

    return view('mecanico.vehicles.edit', compact('vehicle', 'users'));
}

public function updateVehiculo(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);

    // Validar los datos del formulario
    $request->validate([
        'id_usuario' => 'required|exists:usuarios,id',
        'marca' => 'required|string|max:50',
        'modelo' => 'required|string|max:50',
        'anio' => 'required|integer|min:1900|max:' . date('Y'),
        'matricula' => 'required|string|max:20|unique:coches,matricula,' . $id,
    ]);

    // Actualizar los datos del vehículo
    $vehicle->update([
        'id_usuario' => $request->id_usuario,
        'marca' => $request->marca,
        'modelo' => $request->modelo,
        'anio' => $request->anio,
        'matricula' => $request->matricula,
    ]);

    return redirect()->route('mecanico.vehicles.index')->with('success', 'Vehículo actualizado correctamente');
}


    /**
     * Mostrar todas las reparaciones del mecánico.
     */
    public function indexReparaciones()
    {
        $repairs = Repair::with('vehicle')->paginate(10);
    
        return view('mecanico.reparaciones.index', compact('repairs'));
    }
    

    /**
     * Crear una nueva reparación.
     */
    public function createReparacion()
    {
        $usuarios = User::has('vehicles')->get(); // Solo usuarios que tengan coches
    
        // Obtener mecánicos (usuarios con id_rol = 2)
        $mecanicos = User::where('id_rol', 2)->get();
    
        return view('mecanico.reparaciones.create', compact('usuarios', 'mecanicos'));
    }

    /**
     * Almacenar una nueva reparación.
     */
    public function storeReparacion(Request $request)
    {
    
        // Guarda la reparación
        Repair::create([
            'id_coche' => $request->id_coche,
            'id_mecanico' => $request->id_mecanico,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'estado' => $request->estado,
        ]);
    
        return redirect()->route('mecanico.reparaciones.index')->with('success', 'Reparación creada correctamente');
    }

    public function editReparacion($id)
{
    $repair = Repair::with('vehicle.user')->findOrFail($id);

    if (!$repair->vehicle) {
        return redirect()->route('mecanico.reparaciones.index')->with('error', 'La reparación no tiene un coche asociado.');
    }

    if (!$repair->vehicle->user) {
        return redirect()->route('mecanico.reparaciones.index')->with('error', 'El vehículo no tiene un usuario asignado.');
    }

    // Obtener solo los vehículos del usuario de la reparación
    $mecanicos = User::where('id_rol', 2)->get();
    $vehiculos = Vehicle::where('id_usuario', $repair->vehicle->user->id)->get();

    return view('mecanico.reparaciones.edit', compact('repair', 'mecanicos', 'vehiculos'));
}

public function updateReparacion(Request $request, $id)
{
    $repair = Repair::findOrFail($id);

    // Verifica si el usuario autenticado tiene permiso
    if ($repair->vehicle->id_usuario !== Auth::id() && Auth::user()->id_rol !== 2) {
        return redirect()->route('mecanico.reparaciones.index')->with('error', 'No tienes permiso para modificar esta reparación.');
    }

    $request->validate([
        'id_coche' => 'required|exists:coches,id',
        'id_mecanico' => 'required|integer',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
        'estado' => 'required|in:pendiente,en_proceso,completado'
    ]);

    $repair->update($request->all());

    return redirect()->route('mecanico.reparaciones.index')->with('success', 'Reparación actualizada correctamente');
}


// Eliminar reparación
public function destroyReparacion($id)
{
    $repair = Repair::findOrFail($id);

    // Verifica si el usuario es un mecanico 
    if (Auth::user()->id_rol != 1 && $repair->vehicle->id_usuario !== Auth::id()) {
        return redirect()->route('mecanico.reparaciones.index')->with('error', 'No tienes permiso para eliminar esta reparación.');
    }

    $repair->delete();

    return redirect()->route('mecanico.reparaciones.index')->with('success', 'Reparación eliminada correctamente');
}

    /**
     * Mostrar las facturas del mecánico.
     */
    public function indexFacturas()
    {
        $invoices = Invoice::with(['vehicle', 'repair'])->paginate(10); // Asegúrate de obtener los datos
    
        return view('mecanico.facturas.index', compact('invoices'));
    }
    
    
        // Mostrar formulario de edición de factura
    
        public function editFactura($id)
    {
        $invoice = Invoice::findOrFail($id);
    
        // Obtener solo los coches del usuario seleccionado en la factura
        $coches = Vehicle::where('id_usuario', $invoice->id_usuario)->get();
    
        // Obtener solo las reparaciones del coche seleccionado
        $reparaciones = Repair::where('id_coche', $invoice->id_coche)->get();
    
        // Obtener todos los usuarios (para el select)
        $usuarios = User::all();
    
        return view('mecanico.facturas.edit', compact('invoice', 'usuarios', 'coches', 'reparaciones'));
    }
        
        public function updateFactura(Request $request, $id)
        {
            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id',
                'id_coche' => 'required|exists:coches,id',
                'id_reparacion' => 'required|exists:reparaciones,id',
                'monto' => 'required|numeric|min:0',
            ]);
        
            $invoice = Invoice::findOrFail($id);
            $invoice->update($request->all());
        
            return redirect()->route('mecanico.facturas.index')->with('success', 'Factura actualizada correctamente.');
        }
    
        // Mostrar formulario para crear factura
        public function createFactura()
        {
            $usuarios = User::all();
            $coches = Vehicle::all();
            $reparaciones = Repair::all();
            return view('mecanico.facturas.create', compact('coches', 'reparaciones', 'usuarios'));
        }
    
        // Guardar nueva factura
        public function storeFactura(Request $request)
    {
        // Validar los datos
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'id_coche' => 'required|exists:coches,id',
            'id_reparacion' => 'required|exists:reparaciones,id',
            'monto' => 'required|numeric|min:0',
        ]);
    
        // Crear la factura
        $factura = Invoice::create([
            'id_usuario' => $request->id_usuario,
            'id_coche' => $request->id_coche,
            'id_reparacion' => $request->id_reparacion,
            'monto' => $request->monto,
        ]);
    
        // Verifica si se creó
        if ($factura) {
            return redirect()->route('mecanico.facturas.index')->with('success', 'Factura creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al crear la factura.');
        }
    }
    
    
        // Eliminar factura
        public function destroyFactura($id)
        {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
    
            return redirect()->route('mecanico.facturas.index')->with('success', 'Factura eliminada correctamente.');
        }
    
        // Mostrar una factura con sus detalles
        public function show($id)
        {
            $invoice = Invoice::with(['vehicle', 'repair'])
                              ->where('id', $id)
                              ->first();
    
            if ($invoice) {
                return response()->json($invoice);
            }
    
            return response()->json(['error' => 'Factura no encontrada'], 404);
        }
        public function generarPDF($id)
    {
        $invoice = Invoice::with([
            'vehicle.user',
            'repair'
        ])->findOrFail($id);
    
        $pdf = PDF::loadView('mecanico.facturas.pdf', compact('invoice'));
        return $pdf->download('factura_'.$invoice->id.'.pdf');
    }
}
