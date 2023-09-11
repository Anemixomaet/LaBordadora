@extends('layouts.app') // Ajusta la plantilla base si es necesario

@section('content')
    <h1>Lista de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Fecha Nacimiento</th>
                <th>Genero</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos as $dato)
                <tr>
                    <td>{{ $dato->name }}</td>
                    <td>{{ $dato->email }}</td>
                    <td>{{ $dato->cedula }}</td>
                    <td>{{ $dato->telefono }}</td>
                    <td>{{ $dato->fechaNacimiento }}</td>
                    <td>{{ $dato->genero }}</td>
                    <td>
                        @foreach($dato->roles as $rol)
                            {{ $rol->name }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
