@extends('layout.app')

@section('contenido')
    <h1>Listado de Lugares Turísticos</h1>
    <a href="{{ route('nuevo.create') }}">Agregar Lugar Turístico</a>
    <a href="{{ url('turismos/mapa') }}" class="btn btn-success">Ver Mapa Global</a>

    <table border="1" cellpadding="8" cellspacing="0">
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
                            <img src="{{ asset('storage/' . $turismo->imagenes) }}" alt="Imagen" width="100">
                        @else
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
@endsection
