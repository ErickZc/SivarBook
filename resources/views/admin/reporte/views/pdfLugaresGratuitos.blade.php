<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/report.css">

    <style>
        @page {
            size: A4 landscape;
        }
        body {
            font-family: 'Courier', monospace;
        }
    </style>

</head>
<body>
    <h1>Reporte por lugares gratuitos</h1>
    <img src="img/icon.png" alt="" width="350">
    <div class='fw-bold'>
        <p><strong> Fecha: </strong> {{$fecha}} </p>
        <p><strong> Sede: </strong> ITCA-FEPADE Santa Tecla</p>
    </div>
    <br/>
    <table id='tabla' class='table table-hover'>
        <thead>
            <tr>
                <th>Lugar ID</th>
                <th>Usuario</th>
                <th>Categoria</th>
                <th>Lugar</th>
                <th>Municipio</th>
                <th>Departamento</th>
                <th>Publicacion</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categoria as $categ)
            <tr>
                <th>{{$categ->idLugar}} </th>
                <th>{{$categ->user}} </th>
                <th>{{$categ->categoria}} </th>
                <th>{{$categ->nombre}} </th>
                <th>{{$categ->municipio}} </th>
                <th>{{$categ->departamento}} </th>
                <th>{{$categ->fecha}} </th>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>