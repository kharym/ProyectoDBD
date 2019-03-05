
<!DOCTYPE html>
<?php 
$actividad = \App\Actividad::find($data[0]->actividad_id);
$ciudad = \App\Ciudad::find($actividad->ciudad_id);
$pais = \App\Pais::find($ciudad->pais_id);
?>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2> Reserva actividad realizada! </h2>
    <div>
        <ul>
            <li>
                <span> ID de la reserva:     </span>
                <span> {{$data[0]->id}}    </span>
            </li>
            <li>
                <span> Precio Reserva:   </span>
                <span> {{$data[0]->precio}}    </span>
            </li>
            <li>
                <span> Ciudad de la actividad: </span>
                <span> {{$ciudad->nombre_ciudad}}, {{$pais->nombre_pais}}    </span>
            </li>
            <li>
                <span> Personas: </span>
                <span> {{$data[0]->cantidad_personas}}</span>
            </li>
            
        </ul>
    </div>
</body>
</html>