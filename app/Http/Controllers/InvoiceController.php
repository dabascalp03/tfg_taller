<?php

namespace App\Http\Controllers;

use PDF;

use App\Models\Invoice;  // Importa el modelo Invoice
use App\Models\Vehicle;
use App\Models\Repair;
use App\Models\User;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function indexUsuario()
    {
        $facturas = Invoice::where('id_usuario', auth()->id())->get(); // Obteniendo facturas del usuario autenticado
        return view('facturas.index', compact('facturas')); // Retornar vista con datos
    }

    // Mostrar todas las facturas
    public function index()
{
    $invoices = Invoice::with(['vehicle', 'repair'])->get();

    return view('admin.invoices.index', compact('invoices'));
}


    // Mostrar formulario de edición de factura

    public function edit($id)
{
    $invoice = Invoice::findOrFail($id);

    // Obtener solo los coches del usuario seleccionado en la factura
    $coches = Vehicle::where('id_usuario', $invoice->id_usuario)->get();

    // Obtener solo las reparaciones del coche seleccionado
    $reparaciones = Repair::where('id_coche', $invoice->id_coche)->get();

    // Obtener todos los usuarios (para el select)
    $usuarios = User::all();

    return view('admin.invoices.edit', compact('invoice', 'usuarios', 'coches', 'reparaciones'));
}
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'id_coche' => 'required|exists:coches,id',
            'id_reparacion' => 'required|exists:reparaciones,id',
            'monto' => 'required|numeric|min:0',
        ]);
    
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());
    
        return redirect()->route('invoices.index')->with('success', 'Factura actualizada correctamente.');
    }

    // Mostrar formulario para crear factura
    public function create()
    {
        $usuarios = User::all();
        $coches = Vehicle::all();
        $reparaciones = Repair::all();
        return view('admin.invoices.create', compact('coches', 'reparaciones', 'usuarios'));
    }

    // Guardar nueva factura
    public function store(Request $request)
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
        return redirect()->route('admin.invoices.index')->with('success', 'Factura creada correctamente.');
    } else {
        return redirect()->back()->with('error', 'Hubo un problema al crear la factura.');
    }
}


    // Eliminar factura
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Factura eliminada correctamente.');
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

    $pdf = PDF::loadView('admin.invoices.pdf', compact('invoice'));
    return $pdf->download('factura_'.$invoice->id.'.pdf');
}
    

}


