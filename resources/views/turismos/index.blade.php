@extends('layout.app')

@section('contenido')
<br><br><br><br>
<h1 class="text-center">Listado de Lugares Turísticos</h1>
<hr>
<br><br>
<a href="{{ route('turismos.create') }}" class="btn btn-primary mb-3">
    <i class="bi bi-plus-circle"></i> Agregar Lugar Turístico
</a>

<a href="{{ url('turismos/mapa') }}" class="btn btn-success mb-3">
    <i class="bi bi-map"></i> Ver Mapa Global
</a>
<br><br>
<table id="tbl_turismo" class="table table-bordered table-striped">
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
                <td>
                    @if ($turismo->imagenes)
                        <img src="{{ Storage::url($turismo->imagenes) }}" alt="Imagen del lugar" width="150">
                    @else
                        No disponible
                    @endif
                </td>
                <td>{{ $turismo->latitud }}</td>
                <td>{{ $turismo->longitud }}</td>
                <td>
                    <a href="{{ route('turismos.edit', $turismo->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>

                    <br><br>

                    <form action="{{ route('turismos.destroy', $turismo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este sitio?')">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
  $('#tbl_turismo').DataTable({
      dom: 'Bfrtip', // Esto activa los botones arriba de la tabla
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],

      language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
      }
  });

</script>

<br><br>
@endsection
