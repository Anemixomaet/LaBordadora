<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago alumno</title>
</head>
<body>
    <h3>PAGO ALUMNO</h3>
    <p>Por favor padre de familia, acercarse a pagar la mensualidad del alumno:</p>
    <p>Nombres: {{ $persona-> nombre}} {{ $persona-> apellido}}</p> 
    <p>Cedula:{{ $persona-> cedula}}</p> 
    <p>Telefono:{{ $persona-> telefono}}</p> 
    <p>Att: La Bordadora</p> 
</body>
</html>