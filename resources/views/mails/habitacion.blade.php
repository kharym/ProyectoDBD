<!DOCTYPE html>
<?php $habitacion = \App\Habitacion::find($data[0]->habitacion_id);
      $alojamiento = \App\Alojamiento::find($habitacion->alojamiento_id);?>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2> Reserva de habitación realizada! </h2>
    <div>
        <ul>
            <li>
                <span> ID de la reserva:     </span>
                <span> {{$data[0]->id}}    </span>
            </li>
            <li>
                <span> Precio Reserva:   </span>
                <span> {{$data[0]->precio_res_hab}}    </span>
            </li>
            <li>
                <span> Fecha llegada:    </span>
                <span> {{$data[0]->fecha_llegada}}    </span>
            </li>
            <li>
                <span> Fecha ida:   </span>
                <span> {{$data[0]->fecha_ida}}    </span>
            </li>
            <li>
                <span> Nombre alojamiento: </span>
                <span> {{$alojamiento->nombre_alojamiento}} </span>
            </li>
            <li>
                <span> Numero de habitación: </span>
                <span> {{$habitacion->numero_habitacion}}</span>
            </li>
        </ul>
    </div>
</body>
</html>