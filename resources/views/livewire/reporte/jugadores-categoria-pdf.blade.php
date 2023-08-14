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
    </style>
</head>
<body>
    <h3>Jugadores por categoria</h3>
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
                    <td>{{$jugador['nombre']}}</td>
                    <td>{{$jugador['apellido']}}</td>
                    <td>{{$jugador['categoria']}}</td>
                    <td>{{$jugador['cedula']}}</td>
                    <td>{{$jugador['email']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>                
         
    </div>
</body>
</html>