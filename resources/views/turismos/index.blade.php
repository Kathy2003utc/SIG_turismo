@extends('layout.app')

@section('contenido')
<br><br>

<h1 class="text-center mb-3">Listado de Lugares Turísticos</h1>
<hr> 
<br>

<div class="d-flex justify-content-center gap-3 mb-4">
    <a href="{{ route('turismos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Agregar Lugar Turístico
    </a>

    <a href="{{ url('turismos/mapa') }}" class="btn btn-success">
        <i class="bi bi-map"></i> Ver Mapa Global
    </a>
</div>
<br><br>
<div class="container mb-4" style="max-width: 1200px;">
    <div class="row">
        <div class="col-md-4">
            <form method="GET" action="{{ route('turismos.index') }}" class="row g-3">
                <div class="col-12">
                    <label for="categoria" class="form-label">Filtrar por Categoría:</label>
                    <select name="categoria" id="categoria" class="form-select">
                        <option value="">-- Todas --</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="bi bi-filter-circle"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<div class="d-flex justify-content-center">
    <div class="table-responsive" style="max-width: 1200px;">
        <table id="tbl_turismo" class="table table-bordered table-striped" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Imágenes</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($turismos as $turismo)
                    <tr>
                        <td>{{ $turismo->nombre }}</td>
                        <td>{{ $turismo->descripcion }}</td>
                        <td>{{ $turismo->categoria }}</td>
                        <<td>
                            @if ($turismo->imagenes)
                                <img src="{{ asset('storage/' . $turismo->imagenes) }}" alt="Imagen del lugar" height="80">
                            @else
                                No disponible
                            @endif
                        </td>

                        <td>{{ $turismo->latitud }}</td>
                        <td>{{ $turismo->longitud }}</td>
                        <td>
                            <a href="{{ route('turismos.edit', $turismo->id) }}" class="btn btn-warning btn-sm mb-2">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form id="form-delete-{{ $turismo->id }}" action="{{ route('turismos.destroy', $turismo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion({{ $turismo->id }})">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
  $('#tbl_turismo').DataTable({
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
      }
  });
</script>

<script>
    function confirmarEliminacion(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + id).submit();
            }
        });
    }
</script>

<br><br>
@endsection
