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
<body>
    <div class="title-container">
        <div class="left-title ">LA BORDADORA</div>
        <div class="right-title">REPORTE</div>
    </div>
    <h4>Jugadores por categoria</h4>
    <table id="emp">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Categoria</th>
                <th>Cedula</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jugadores as $jugador)        
                <tr>                                
                    <td>{{$jugador['temporada']}}</td>
                    <td>{{$jugador['categoria']}}</td>
                    <td>
                        @if($jugador['asistencia'] == 'Asistio')
                            {{$jugador['asistencia']}}
                        @else
                            No asistio
                        @endif                                
                    </td>
                    <td>{{$jugador['nombre']}} {{$jugador['apellido']}}</td>
                    <td>{{$jugador['fecha']}}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>                
         
    </div>
</body>
</html>