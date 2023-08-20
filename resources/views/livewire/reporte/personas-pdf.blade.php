<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores PDF</title>
    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;  
        }
        #emp td, #emp th{
            border: 1px solid #ddd;
            padding: 8px;
        }
        #emp th{
            padding-top: 12px;
            padding-botton: 12px;
            text-align: left;
            background-color: #3380FF;
            color: #fff;
        }
        .title-container {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            font-weight: bold;
        }
        .left-title {
            float: left;
        }

        .right-title {
            float: right;
        }
    </style>
</head>
<body>
    <div class="title-container">
        <div class="left-title ">LA BORDADORA</div>
        <div class="right-title">REPORTE</div>
    </div>
    <h4>Jugadores</h4>
    <table id="emp">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>F. Nacimiento</th>
                <th>Genero</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos as $dato)        
                <tr>                                
                    <td>{{$dato['nombre']}}</td>
                    <td>{{$dato['apellido']}}</td>
                    <td>{{$dato['cedula']}}</td>
                    <td>{{$dato['telefono']}}</td>
                    <td>{{$dato['email']}}</td>
                    <td>{{$dato['fechaNacimiento']}}</td>
                    <td>
                        @if($dato['genero'] == 'M')
                            Hombre
                        @else
                            Mujer
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>                
         
    </div>
</body>
</html>