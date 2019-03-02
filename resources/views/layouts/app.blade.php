<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="/img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Travel</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="/css/linearicons.css">
			<link rel="stylesheet" href="/css/font-awesome.min.css">
			<link rel="stylesheet" href="/css/bootstrap.css">
			<link rel="stylesheet" href="/css/magnific-popup.css">
			<link rel="stylesheet" href="/css/jquery-ui.css">				
			<link rel="stylesheet" href="/css/nice-select.css">							
			<link rel="stylesheet" href="/css/animate.min.css">
			<link rel="stylesheet" href="/css/owl.carousel.css">				
			<link rel="stylesheet" href="/css/main.css">
		</head>
		<body>	
			<header id="header">
				<div class="header-top">
					<div class="container">
			  		<div class="row align-items-center">
			  			<div class="col-lg-6 col-sm-6 col-6 header-top-left">
			  				<ul>
			  					<li><a href="#">Visit Us</a></li>
			  					<li><a href="#">Buy Tickets</a></li>
			  				</ul>			
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-6 header-top-right">
							<div class="header-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-dribbble"></i></a>
								<a href="#"><i class="fa fa-behance"></i></a>
							</div>
			  			</div>
			  		</div>			  					
					</div>
				</div>
				<div class="container main-menu">
					<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="/"><img src="/img/logo.png" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				        	@auth
				        	@if(auth()->user()->rol_id == 2)
				        	<li class="menu-has-children"><a href="">Administrador</a>
				        		<ul>
				        			<li><a href="/Vuelo/agregarVuelo">Agregar Vuelo</a></li>
				              		<li><a href="/Alojamiento/agregarAlojamiento">Agregar Alojamiento</a></li>
				              		<li><a href="/Habitacion/agregarHabitacion">Agregar Habitación</a></li>
				              		<li><a href="/Auto/agregarAuto">Agregar Vehículo</a></li>
				              		<li><a href="">Agregar Actividad</a></li>
				              		<li><a href="">Agregar Paquete</a></li>
				              		<li><a href="/Pais/agregarPais">Agregar País</a></li>
				              		<li><a href="">Agregar Empresa</a></li>
				            	</ul>
				         	</li>	
				        	@endif
				        	@endauth
				          	<li><a href="/">Home</a></li>
				          	<li><a href="/Vuelo/all">Vuelos</a></li>
				          	<li><a href="/Alojamiento/all">Alojamientos</a></li>
				          	<li><a href="/Auto/all">Vehículos</a></li>
				          	<li><a href="/Actividad/all">Actividades</a></li>
				          	<li class="menu-has-children"><a href="">Paquetes</a>
				        <ul>
				              <li><a href="/paquete-vuelo+alojamiento">Vuelo + Alojamiento</a></li>
				              <li><a href="/paquete-vuelo+auto">Vuelo + Automovil</a></li>
				              <li><a href="blog-single.html">Hotel + Car</a></li>
				            </ul>
				          </li>					          					          		          
									@auth
						<li><a href="movimientos/{{auth()->user()->id}}">Movimientos</a></li>
										<li class ="menu-has-children">
											<a href="#">{{ auth()->user()->name }}</a>
											<ul>
												<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Cerrar sesión</a></li>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
												</form>
											</ul>
										</li>
									@else
										<li><a href="/login">Login</a></li>
										<li><a href="/register">Registrarse</a></li>
									@endauth
				        </ul>
                      </nav><!-- #nav-menu-container -->				      		  
					</div>
				</div>
			</header><!-- #header -->
        </body>
        <main>
                @yield('content')
            </main>	
	</html>