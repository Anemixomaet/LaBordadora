<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporadas PDF</title>
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
    <h4>Temporadas</h4>
    <table id="emp">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Fecha creacion</th>            
            </tr>
        </thead>
        <tbody>
            @foreach($datos as $dato)        
                <tr>                                
                    <td>{{$dato['nombre']}}</td>
                    <td>{{$dato['detalle']}}</td>
                    <td>{{$dato['created_at']}}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>                
         
    </div>
</body>
</html>