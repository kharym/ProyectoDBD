
<!DOCTYPE html>
<?php $auto = \App\Auto::find($data[0]->auto_id);
$ubicacion = \App\Ubicacion::find($data[0]->ubicacion_id);?>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2> Reserva de vehículo realizada! </h2>
    <div>
        <ul>
            <li>
                <span> ID de la reserva:     </span>
                <span> {{$data[0]->id}}    </span>
            </li>
            <li>
                <span> Precio Reserva:   </span>
                <span> {{$data[0]->precio_auto}}    </span>
            </li>
            <li>
                <span> Fecha recogida:    </span>
                <span> {{$data[0]->fecha_recogido}}    </span>
            </li>
            <li>
                <span> Fecha devolución:   </span>
                <span> {{$data[0]->fecha_devolucion}}    </span>
            </li>
            <li>
                <span> Ubicacion recogida: </span>
                <span> {{$ubicacion->calle}}, #{{$ubicacion->numero}}    </span>
            </li>
            <li>
                <span> Marca auto: </span>
                <span> {{$auto->marca}}</span>
            </li>
            <li>
                <span> Modelo auto: </span>
                <span> {{$auto->modelo}} </span>
            </li>
        </ul>
    </div>
</body>
</html>