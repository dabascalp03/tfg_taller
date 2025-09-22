<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $invoice->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { width: 100%; margin: 0 auto; max-width: 800px; border: 1px solid #ddd; padding: 20px; border-radius: 10px; }
        .header { text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px; }
        .logo { text-align: center; margin-bottom: 20px; }
        .logo img { width: 150px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .total { text-align: right; font-size: 18px; font-weight: bold; margin-top: 10px; }
        .signature { margin-top: 40px; text-align: right; }
        .signature p { margin-bottom: 50px; border-bottom: 1px solid black; width: 250px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/TodoMotor.png'))) }}" alt="Logo de la empresa">
        </div>

        <!-- Encabezado -->
        <div class="header">Factura #{{ $invoice->id }}</div>

        <!-- Información del cliente -->
        <div class="info">
            <p><strong>Cliente:</strong> {{ $invoice->vehicle->user->nombre }}</p>
            <p><strong>Email:</strong> {{ $invoice->vehicle->user->email }}</p>
            <p><strong>Vehículo:</strong> {{ $invoice->vehicle->marca }} - {{ $invoice->vehicle->modelo }} ({{ $invoice->vehicle->matricula }})</p>
            <p><strong>Fecha:</strong> {{ $invoice->fecha }}</p>
        </div>

        <!-- Detalles de la factura -->
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->repair->descripcion }}</td>
                    <td>${{ number_format($invoice->monto, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total a pagar -->
        <p class="total">Total a pagar: ${{ number_format($invoice->monto, 2) }}</p>

        <!-- Espacio para la firma -->
        <div class="signature">
            <p>Firma del Cliente</p>
        </div>
    </div>
</body>
</html>
