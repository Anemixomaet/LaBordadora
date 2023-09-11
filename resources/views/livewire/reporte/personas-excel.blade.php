<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Jugadores</title>
    <style>
        /* Estilos CSS específicos para tu vista de Excel si es necesario */
    </style>
</head>
<body>
    <h1>Reporte de Personas</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Fecha de Nacimiento</th>
                <th>Género</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos as $dato)
                <tr>
                    <td>{{ $dato->nombre }}</td>
                    <td>{{ $dato->apellido }}</td>
                    <td>{{ $dato->cedula }}</td>
                    <td>{{ $dato->telefono }}</td>
                    <td>{{ $dato->email }}</td>
                    <td>{{ $dato->fechaNacimiento }}</td>
                    <td>{{ $dato->genero }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
