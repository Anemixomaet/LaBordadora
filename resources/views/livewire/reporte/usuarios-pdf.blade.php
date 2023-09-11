<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores categoria PDF</title>
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
<body class="landscape">
    <div class="title-container">
        <div class="left-title ">LA BORDADORA</div>
        <div class="right-title">REPORTE</div>
    </div>
    <h4>Entrenadores</h4>
    <table id="emp">
        <thead>
            <tr>
                <th>Nombre/Apellido</th>
                <th>Correo Electrónico</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Fecha Nacimiento</th>
                <th>Género</th>
                <th>Rol</th>            
            </tr>
        </thead>
        <tbody>
            @foreach($datos as $dato)        
                <tr>                                
                    <td>{{$dato['name']}}</td>
                    <td>{{$dato['email']}}</td>
                    <td>{{$dato['fechaNacimiento']}}</td>
                    <td>{{$dato['cedula']}}</td>
                    <td>{{$dato['telefono']}}</td>
                    <td>{{$dato['genero']}}</td>
                    <td>
                        @foreach($dato->roles as $rol)
                            {{$rol->name}}
                        @endforeach
                    </td>                      
                </tr>
            @endforeach
        </tbody>
    </table>                
         
    </div>
</body>
</html>