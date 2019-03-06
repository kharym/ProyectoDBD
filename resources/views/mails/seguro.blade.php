<!DOCTYPE html>
<?php $seguro = $data[0];?>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2> Reserva de vuelo realizada! </h2>
    <div><ul>
        <h4>
            <span> Seguro </span>

            <span>  </span>
        </h4>
        <li>
            <span> Seguro dental </span>
            @if($seguro->dental)
                <span> Si </span>
            @else
                <span> No </span>
            @endif
        </li>
        <li>
            <span> Seguro contra accidentes </span>
            @if($seguro->accidente)
                <span> Si </span>
            @else
                <span> No </span>
            @endif
        </li>
        <li>
                <span> Seguro contra pérdida de equipaje </span>
                @if($seguro->equipaje)
                <span> Si </span>
            @else
                <span> No </span>
            @endif
        </li>
        <li>
            <span> Asesoría legal </span>
            @if($seguro->legal)
                <span> Si </span>
            @else
                <span> No </span>
            @endif 
        </li>
        <li>
            <span> Seguro contra siniestros</span>
            @if($seguro->siniestro)
                <span> Si </span>
            @else
                <span> No </span>
            @endif
        </li>
        <li>
            <span> Seguro ante problemas con viaje</span>
            @if($seguro->vuelo)
                <span> Si </span>
            @else
                <span> No </span>
            @endif
        </li>                                  
    </ul>
    </div>
</body>
</html>