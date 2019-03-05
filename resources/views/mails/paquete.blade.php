<!DOCTYPE html>
<?php $vuelo = \App\Vuelo::find($data[0]->vuelo_id);
      $pasajero = \App\Pasajero::find($data[0]->pasajero_id);
      $asiento = \App\Asiento::find($data[0]->asiento_id);?>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2> Reserva de paquete realizada realizada! </h2>
    <h3> La información de cada producto viene dada en correos aparte </h3>
</body>
</html>