@extends('layouts.admin')

@section('content')
@php
    // Redirección si el usuario no es admin (id_rol == 1)
    if (!auth()->check() || auth()->user()->id_rol != 1) {
        header('Location: ' . url('/'));
        exit;
    }
@endphp
<div class="container">
    <h1 class="mb-4">Bienvenido al Dashboard</h1>
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="combinedSearch" placeholder="Buscar por nombre, correo, marca, modelo o matrícula...">
    </div>

    <h5>Resultados:</h5>
    <div id="searchResults" class="list-group"></div>
</div>

<script>
    document.getElementById('combinedSearch').addEventListener('keyup', function () {
        const query = this.value;

        if (query.length > 0) {
            fetch(`{{ route('admin.dashboard.combined-search') }}?query=${query}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    const resultsContainer = document.getElementById('searchResults');
                    resultsContainer.innerHTML = ''; // Limpiar resultados anteriores

                    if (data.length > 0) {
                        data.forEach(item => {
                            const itemElement = document.createElement('div');
                            itemElement.classList.add('list-group-item', 'mb-3');

                            // Verificar el tipo de entidad
                            if (item.nombre && item.email) {
                                // Es un usuario
                                itemElement.innerHTML = `
                                    <h6>Usuario: ${item.nombre}</h6>
                                    <p><strong>Email:</strong> ${item.email}</p>
                                `;
                                if (item.vehicles && item.vehicles.length > 0) {
                                    itemElement.innerHTML += `<h6>Coches:</h6>`;
                                    item.vehicles.forEach(vehicle => {
                                        itemElement.innerHTML += `
                                            <p><strong>Marca:</strong> ${vehicle.marca}</p>
                                            <p><strong>Modelo:</strong> ${vehicle.modelo}</p>
                                            <p><strong>Matrícula:</strong> ${vehicle.matricula}</p>
                                        `;
                                        if (vehicle.reparaciones && vehicle.reparaciones.length > 0) {
                                            itemElement.innerHTML += `<h6>Reparaciones:</h6>`;
                                            vehicle.reparaciones.forEach(repair => {
                                                itemElement.innerHTML += `
                                                    <p>- Descripción: ${repair.descripcion}, Fecha: ${repair.fecha}</p>
                                                `;
                                            });
                                        }
                                        if (vehicle.facturas && vehicle.facturas.length > 0) {
                                            itemElement.innerHTML += `<h6>Facturas:</h6>`;
                                            vehicle.facturas.forEach(invoice => {
                                                itemElement.innerHTML += `
                                                    <p>- Factura ID: ${invoice.id}, Monto: ${invoice.monto}, Fecha: ${invoice.fecha}</p>
                                                `;
                                            });
                                        }
                                    });
                                }
                            } else if (item.marca && item.modelo) {
                                // Es un coche
                                itemElement.innerHTML = `
                                    <h4>Coche: ${item.marca} ${item.modelo}</h4>
                                    <p><strong>Matrícula:</strong> ${item.matricula}</p>
                                    <p><strong>Dueño:</strong> ${item.user?.nombre ?? 'No disponible'}</p>
                                `;
                                if (item.reparaciones && item.reparaciones.length > 0) {
                                    itemElement.innerHTML += `<h5>Reparaciones:</h5>`;
                                    item.reparaciones.forEach(repair => {
                                        itemElement.innerHTML += `
                                            <p>- Descripción: ${repair.descripcion}, Fecha: ${repair.fecha}</p>
                                        `;
                                    });
                                }
                                if (item.facturas && item.facturas.length > 0) {
                                    itemElement.innerHTML += `<h5>Facturas:</h5>`;
                                    item.facturas.forEach(invoice => {
                                        itemElement.innerHTML += `
                                            <p>- Factura ID: ${invoice.id}, Monto: ${invoice.monto}, Fecha: ${invoice.fecha}</p>
                                        `;
                                    });
                                }
                            }

                            resultsContainer.appendChild(itemElement);
                        });
                    } else {
                        resultsContainer.innerHTML = '<p class="text-muted">No se encontraron resultados.</p>';
                    }
                })
                .catch(error => {
                    console.error('Ocurrió un error:', error);
                });
        } else {
            document.getElementById('searchResults').innerHTML = ''; // Limpiar resultados si no hay texto
        }
    });
</script>

@endsection
