@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/buscar.css') }}" />
<!--Formulario busqueda vuelo -->
<form  class="form-horizontal" method="get" action="Vuelo">
<label>VUELOS</label>
<div class="form-group">

    <label for="Origen" class="col-lg-2 control-label">
        Origen
    </label>
    <div  class="col-lg-10">
        <input type="text" class="form-control" id="paisOrigen" name="paisOrigen" value="a">
    </div>
</div>
<div class="form-group">
    <label for="Destino" class="col-lg-2 control-label">
        Destino
    </label>
    <div  class="col-lg-10" >
        <input type="text" class="form-control" id="paisDestino" name="paisDestino" value="a">
    </div>
</div>
<input type="submit" id="botonVuelo" value="Buscar">
</form>


<!--Formulario busqueda alojamiento -->

<form  id="formularioAloj" class="form-horizontal" method="get" action="Alojamiento">
<label>ALOJAMIENTOS</label>
<div class="form-group">
    <label for="Pais" class="col-lg-2 control-label">
        Pais
    </label>
    <div  class="col-lg-10">
        <input type="text" class="form-control" id="pais" name="pais" value="Pais de destino">
    </div>
</div>
<input type="submit" id="botonAloj" value="Buscar">
</form>

@endsection