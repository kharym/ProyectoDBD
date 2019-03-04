<!DOCTYPE html>
<?php $vuelo = \App\Vuelo::find($data[0]->vuelo_id);
      $pasajero = \App\Pasajero::find($data[0]->pasajero_id);
      $asiento = \App\Asiento::find($data[0]->asiento_id);?>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2> Reserva de vuelo realizada! </h2>
    <div>
        <ul>
            <li>
                <span> ID de la reserva (Este ID se debe utilizar para realizar CHECK-IN):     </span>
                <span> {{$data[0]->id}}    </span>
            </li>
            <li>
                <span> DNI pasajero:   </span>
                <span> {{$pasajero->dni}}    </span>
            </li>
            <li>
                <span> Asiento:   </span>
                <span> {{$asiento->numero_asiento}}    </span>
            </li>
            <li>
                <span> Precio Reserva:   </span>
                <span> {{$data[0]->precio_reserva_vuelo}}    </span>
            </li>
            <li>
                <span> Fecha partida:    </span>
                <span> {{$data[0]->fecha_ida}}    </span>
            </li>
            <li>
                <span> Hora partida:   </span>
                <span> {{$data[0]->hora_ida}}    </span>
            </li>
            <li>
                <span> Fecha llegada: </span>
                <span> {{$data[0]->fecha_llegada}} </span>
            </li>
            <li>
                <span> Hora llegada: </span>
                <span> {{$data[0]->hora_llegada}}</span>
            </li>
        </ul>
    </div>
</body>
</html>