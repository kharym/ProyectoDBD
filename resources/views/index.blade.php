@extends('layouts.app')	
@section('content')
			<!-- start banner Area -->
			<!-- comprobacion para session-->
<?php 
		if(request()->session()->has('rV')){
			request()->session()->forget('rV');
		}
		if(request()->session()->has('rA')){
			request()->session()->forget('rA');
		}
		if(request()->session()->has('rH')){
			request()->session()->forget('rH');
		}
		if(request()->session()->has('psj')){
			request()->session()->forget('psj');
		}			
			
		request()->session()->push('reservaVuelo',NULL);
        request()->session()->push('pasajero',NULL);
        request()->session()->push('reservaHabitacion',NULL);
        request()->session()->push('reservaAuto',NULL);
        request()->session()->push('reservaActividad',NULL);
		
		request()->session()->forget('reservaVuelo');
		request()->session()->forget('pasajero');
		request()->session()->forget('reservaHabitacion');
		request()->session()->forget('reservaAuto');
		request()->session()->forget('reservaActividad');
			
			
			request()->session()->push('reservaVuelo',NULL);
            request()->session()->push('pasajero',NULL);
            request()->session()->push('reservaHabitacion',NULL);
            request()->session()->push('reservaAuto',NULL);
            request()->session()->push('reservaActividad',NULL);?>
			<section class="banner-area relative">
				<div class="overlay overlay-bg"></div>				
				<div class="container">
					<div class="row fullscreen align-items-center justify-content-between">
						<div class="col-lg-6 col-md-6 banner-left">
							<h6 class="text-white">Redescubriendo el mundo</h6>
							<h1 class="text-white">Magic Travel</h1>
							<p class="text-white">
								Viajar sin miedo y con confianza. Redescubriendo nuestro mundo. Encontrándonos a nosotros mismos							
							</p>
							
						</div>
						<div class="col-lg-5 col-md-6 banner-right">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="flight-tab" data-toggle="tab" href="#flight" role="tab" aria-controls="flight" aria-selected="true">Vuelos</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">Alojamientos</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="holiday-tab" data-toggle="tab" href="#holiday" role="tab" aria-controls="holiday" aria-selected="false">Vehículos</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="holiday-tab" data-toggle="tab" href="#actividad" role="tab" aria-controls="actividad" aria-selected="false">Actividades</a>
							  </li>
							</ul>
							<div class="tab-content" id="myTabContent">
							  <div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
								  <!-- FORM PARA BUSCAR VUELOS -->
								  <?php $vuelos = \App\Vuelo::all();
								  $ciudadesO = [];
								  $ciudadesD = [];
								  foreach($vuelos as $vuelo){
									$ciudadO = \App\Ciudad::find($vuelo->ciudad_va_id);
									$ciudadD = \App\Ciudad::find($vuelo->ciudad_viene_id);
									array_push($ciudadesO,$ciudadO);
									array_push($ciudadesD,$ciudadD);
									}
									$ciudadesO = array_unique($ciudadesO);
									$ciudadesD = array_unique($ciudadesD);
								  ?>
								<form class="form-wrap" method="get" action="Vuelo">
									<div class="form-group">
										<select class="form-control" id="ciudadO" name="ciudadO">
											<option selected="selected" value={{null}}> Origen </option>
											@foreach($ciudadesO as $origenes)
												<?php $pais = \App\Pais::find($origenes->pais_id);?>
										<option value="{{$origenes->id}}">  {{$origenes->nombre_ciudad}}, {{$pais->nombre_pais}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<select class="form-control" id="ciudadD" name="ciudadD">
											<option selected="selected" value={{null}}> Destino </option>
											@foreach($ciudadesD as $destinos)
												<?php $pais = \App\Pais::find($destinos->pais_id);?>
										<option value="{{$destinos->id}}">  {{$destinos->nombre_ciudad}}, {{$pais->nombre_pais}}</option>
											@endforeach
										</select>
									</div>
									
									<input type="text" class="form-control date-picker" name="start" placeholder="Fecha Ida " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Ida '" required>
									<input type="text" class="form-control date-picker" name="return" placeholder="Fecha Vuelta " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Vuelta '">							
									<div class="form-group">
										<select class="form-control" id="pasajeros" name="pasajeros" required>
											<option selected="selected" value="{{1}}"> Cantidad pasajeros</option>
											@for($i = 1; $i<6; $i++)
												<option value="{{$i}}">{{$i}}</option>
											@endfor
										</select>
									</div>
									<input type="submit" class="primary-btn text-uppercase" value="Buscar" >									
								</form>
							  </div>
							  <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
								  <!-- FORM PARA BUSCAR HOTEL -->
								<form class="form-wrap" method="get" action="Alojamiento">
										<?php $ciudades = \App\Alojamiento::select('ciudad_id')->distinct()->get();?>
										<div class="form-group">
												<label for="sel1">Ciudad donde desea alojar:</label>
												<select class="form-control" id="ciudad" name="ciudad">
													@foreach($ciudades as $ciudad)
														<?php $c = \App\Ciudad::find($ciudad->ciudad_id);
																	$pais = \App\Pais::find($c->pais_id)?>
														<option value="{{$ciudad->ciudad_id}}"> {{$c->nombre_ciudad}}, {{$pais->nombre_pais}}</option>
													@endforeach
												</select>
											</div>														
									<input type="text" class="form-control date-picker" name="start" placeholder="Fecha Ida " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Ida '" required>
									<input type="text" class="form-control date-picker" name="return" placeholder="Fecha Vuelta " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Vuelta '"required>
									<input type="submit" class="primary-btn text-uppercase" value="Buscar" >									
								</form>							  	
							  </div>
							  <!-- FORM PARA BUSCAR AUTO -->
							  <div class="tab-pane fade" id="holiday" role="tabpanel" aria-labelledby="autos-tab">
								<form class="form-wrap" method="get" action="/autos">
										<div class="form-group">
												<?php $empresas = \App\Auto::select('empresa_id')->distinct()->get();
												$ubicaciones = [];
												foreach($empresas as $empresa){
													 $e = \App\Empresa::find($empresa->empresa_id);
														array_push($ubicaciones,$e->ubicacion_id);	
												}
												$ubicaciones = array_unique($ubicaciones);
												$ciudades = [];
												foreach($ubicaciones as $ubicacion){
													$ub = \App\Ubicacion::find($ubicacion);
													$c = $ub->ciudad_id;
													array_push($ciudades,$c);
												}
												$ciudades = array_unique($ciudades);?>
													<label for="sel1">Ciudad donde desea alojar:</label>
										<select class="form-control" id="ciudad" name="ciudad">
											@foreach($ciudades as $ciudad)
												<?php $c = \App\Ciudad::find($ciudad);
															$pais = \App\Pais::find($c->pais_id)?>
												<option value="{{$ciudad}}"> {{$c->nombre_ciudad}}, {{$pais->nombre_pais}}</option>
											@endforeach
										</select>
									</div>
										<input type="text" class="form-control date-picker" name="start" placeholder="Fecha Retiro " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Ida '" required>
										<input type="text" class="form-control date-picker" name="return" placeholder="Fecha Entrega " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Vuelta '" required>												
									<input type="submit" class="primary-btn text-uppercase" value="Buscar">									
								</form>							  	
							  </div>
							  <!-- FORM PARA BUSCAR ACTIVIDAD -->
							  <div class="tab-pane fade" id="actividad" role="tabpanel" aria-labelledby="actividad-tab">
								<form class="form-wrap" method="get" action="Actividad">
										<input type="text" class="form-control" name="destino" placeholder="País de destino " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Destino '">		
									<input type="text" class="form-control date-picker" name="start" placeholder="Fecha Ida " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Ida '">
									<input type="text" class="form-control date-picker" name="return" placeholder="Fecha Vuelta " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fecha Vuelta '">							
									<input type="submit" class="primary-btn text-uppercase" value="Buscar" >								
								</form>							  	
							  </div>
							</div>
						</div>
					</div>
				</div>					
			</section>
			<!-- End banner Area -->
			
			
			
	
			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">

					<div class="row">
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>About Agency</h6>
								<p>
									The world has become so fast paced that people don’t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point 
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Navigation Links</h6>
								<div class="row">
									<div class="col">
										<ul>
											<li><a href="#">Home</a></li>
											<li><a href="#">Feature</a></li>
											<li><a href="#">Services</a></li>
											<li><a href="#">Portfolio</a></li>
										</ul>
									</div>
									<div class="col">
										<ul>
											<li><a href="#">Team</a></li>
											<li><a href="#">Pricing</a></li>
											<li><a href="#">Blog</a></li>
											<li><a href="#">Contact</a></li>
										</ul>
									</div>										
								</div>							
							</div>
						</div>							
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Newsletter</h6>
								<p>
									For business professionals caught between high OEM price and mediocre print and graphic output.									
								</p>								
								<div id="mc_embed_signup">
									<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscription relative">
										<div class="input-group d-flex flex-row">
											<input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
											<button class="btn bb-btn"><span class="lnr lnr-location"></span></button>		
										</div>									
										<div class="mt-10 info"></div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget mail-chimp">
								<h6 class="mb-20">InstaFeed</h6>
								<ul class="instafeed d-flex flex-wrap">
									<li><img src="img/i1.jpg" alt=""></li>
									<li><img src="img/i2.jpg" alt=""></li>
									<li><img src="img/i3.jpg" alt=""></li>
									<li><img src="img/i4.jpg" alt=""></li>
									<li><img src="img/i5.jpg" alt=""></li>
									<li><img src="img/i6.jpg" alt=""></li>
									<li><img src="img/i7.jpg" alt=""></li>
									<li><img src="img/i8.jpg" alt=""></li>
								</ul>
							</div>
						</div>						
					</div>

					<div class="row footer-bottom d-flex justify-content-between align-items-center">
						<p class="col-lg-8 col-sm-12 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						<div class="col-lg-4 col-sm-12 footer-social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</footer>
			<!-- End footer Area -->	

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="js/popper.min.js"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>		
 			<script src="js/jquery-ui.js"></script>					
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>						
			<script src="js/jquery.nice-select.min.js"></script>					
			<script src="js/owl.carousel.min.js"></script>							
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
@endsection		