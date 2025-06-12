@extends('layout.app')

@section('contenido')
<br><br><br><br>
    <h1>Listado de Lugares Turísticos</h1>
    <a href="{{ route('turismos.create') }}">Agregar Lugar Turístico</a>
    <a href="{{ url('turismos/mapa') }}" class="btn btn-success">Ver Mapa Global</a>

    <table id="tbl_turismo" border="1" cellpadding="8" cellspacing="0">
        <thead>
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
                    @endif
                    No disponible
                    @endif
                    </td>
                    <td>{{ $turismo->latitud }}</td>
                    <td>{{ $turismo->longitud }}</td>
                    <td>
                        <a href="{{ route('turismos.edit', $turismo->id) }}">Editar</a>

                        <form action="{{ route('turismos.destroy', $turismo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
          $(document).ready(function() {
              $('#tbl_turismo').DataTable({
                  language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                  },
                  dom: 'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ]
              });
          });
        </script>
    <br><br>
@endsection
