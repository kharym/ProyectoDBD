@extends('layouts.app')
@section('content')
    
          
        <!-- start banner Area -->
        <section class="about-banner relative">
            <div class="overlay overlay-bg"></div>
            <div class="container">				
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="about-content col-lg-12">
                        <h1 class="text-white">
                            Movimientos				
                        </h1>	
                        <p class="text-white link-nav"><a href="/#">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Compras</a></p>
                    </div>	
                </div>
            </div>
        </section>
        <!-- End banner Area -->	

        <section class="destinations-area section-gap">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content pb-40 col-lg-8">
                            <div class="title text-center">
                                <h1 class="mb-10">Compras</h1>
                                <p>Tus últimas acciones</p>
                            </div>
                        </div>
                    </div>						
            <div class="row">
        @if(!empty($compras))
        @foreach ($compras as $compra)
            @if($compra->seguro_id != null)
                <?php $seguro = \App\Seguro::find($compra->seguro_id);
                        ?>
                <div class="col-lg-4">
                        <div class="single-destinations" >
                            <div class="details">
                                <ul class="package-list">
                                    <li class="d-flex justify-content-between align-items-center">
                                    <span> Fecha de compra</span>
                                    <span>{{$compra->fecha_compra}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span> Hora de compra </span>
                                        <span>{{$compra->hora_compra}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                            <span> DNI asegurado </span>
                                            <span>{{$seguro->dni}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                            <span> Edad asegurado </span>
                                            <span>{{$seguro->edad_pasajero}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        @if($seguro->seguro_dental)    
                                            <span> Seguro dental </span>
                                            <span>Si</span>
                                        @else
                                            <span> Seguro dental </span>
                                            <span>No</span>
                                        @endif
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                            @if($seguro->seguro_accidentes)    
                                                <span> Seguro contra accidentes </span>
                                                <span>Si</span>
                                            @else
                                                <span> Seguro contra accidentes </span>
                                                <span>No</span>
                                            @endif
                                        </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        @if($seguro->perdida_equipaje)    
                                            <span> Seguro ante pérdida de equipaje </span>
                                            <span>Si</span>
                                        @else
                                            <span> Seguro ante pérdida de equipaje </span>
                                            <span>No</span>
                                        @endif
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        @if($seguro->asesoria_legal)    
                                            <span> Asesoría legal </span>
                                            <span>Si</span>
                                        @else
                                            <span> Asesoría legal </span>
                                            <span>No</span>
                                        @endif
                                    </li>	
                                    <li class="d-flex justify-content-between align-items-center">
                                        @if($seguro->seguro_siniestros)    
                                            <span> Seguro ante siniestro </span>
                                            <span>Si</span>
                                        @else
                                            <span> Seguro ante siniestro </span>
                                            <span>No</span>
                                        @endif
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        @if($seguro->problemas_viaje)    
                                            <span> Seguro ante retraso/pérdida vuelo </span>
                                            <span>Si</span>
                                        @else
                                            <span> Seguro ante retraso/pérdida vuelo </span>
                                            <span>No</span>
                                        @endif
                                    </li>									
                                </ul>
                            </div>
                            </a>
                        </div>
                </div>
            @elseif($compra->paquete_id != null)
                    @if($paquete->habitacion_id == null)
                        <?php $paquete = \App\Paquete::find($compra->paquete_id);
                        $vuelo = \App\Vuelo::find($paquete->vuelo_id);
                        $auto = \App\Auto::find($paquete->auto_id); ?>
                        <div class="col-lg-4">
                                <div class="single-destinations" >
                                    <div class="details">
                                        <ul class="package-list">
                                            <li class="d-flex justify-content-between align-items-center">
                                            <span> Fecha de compra</span>
                                            <span>{{$compra->fecha_compra}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <span> Hora de compra </span>
                                                <span>{{$compra->hora_compra}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Origen vuelo</span>  
                                                    <span>{{$vuelo->origen}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Destino vuelo</span>  
                                                    <span>{{$vuelo->destino}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Fecaha de salida</span>  
                                                    <span>{{$vuelo->fecha_ida}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Fecha de llegada</span>  
                                                    <span>{{$vuelo->fecha_llegada}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Marca automóvil</span>  
                                                    <span>{{$auto->marca}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Modelo automóvil</span>  
                                                    <span>{{$auto->modelo}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Precio</span>  
                                                    <span>{{$paquete->precio}}</span>  
                                            </li>						
                                        </ul>
                                    </div>
                                    </a>
                                </div>
                        </div>
                    @else
                        <?php $paquete = \App\Paquete::find($compra->paquete_id);
                        $vuelo = \App\Vuelo::find($paquete->vuelo_id);
                        $habitacion = \App\Habitacion::find($paquete->habitacion_id); ?>
                        <div class="col-lg-4">
                                <div class="single-destinations" >
                                    <div class="details">
                                        <ul class="package-list">
                                            <li class="d-flex justify-content-between align-items-center">
                                            <span> Fecha de compra</span>
                                            <span>{{$compra->fecha_compra}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <span> Hora de compra </span>
                                                <span>{{$compra->hora_compra}}</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Origen vuelo</span>  
                                                    <span>{{$vuelo->origen}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Destino vuelo</span>  
                                                    <span>{{$vuelo->destino}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Fecaha de salida</span>  
                                                    <span>{{$vuelo->fecha_ida}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Fecha de llegada</span>  
                                                    <span>{{$vuelo->fecha_llegada}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Tipo de habitacion</span>  
                                                    <span></span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Cantidad de camas</span>  
                                                    <span>{{$habitacion->numero_camas}}</span>  
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span>Cantidad de baños</span>  
                                                    <span>{{$habitacion->numero_banos}}</span>  
                                            </li>						
                                        </ul>
                                    </div>
                                    </a>
                                </div>
                        </div>
                    @endif
            @elseif($compra->reserva_auto_id != null)
                <?php $reserva = \App\ReservaAuto::find($compra->reserva_auto_id);
                        $auto = \App\Auto::find($reserva->auto_id);?>
                <div class="col-lg-4">
                        <div class="single-destinations" >
                            <div class="details">
                                <ul class="package-list">
                                    <li class="d-flex justify-content-between align-items-center">
                                    <span> Fecha de compra</span>
                                    <span>{{$compra->fecha_compra}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span> Hora de compra </span>
                                        <span>{{$compra->hora_compra}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                            <span> Marca </span>
                                            <span> {{$auto->marca}} </span>
                                    </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Modelo </span>
                                            <span> {{$auto->modelo}} </span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Número de puertas </span>
                                            <span> {{$auto->numero_puertas}} </span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                                <span> Tipo de transmision </span>
                                                @if ($auto->tipo_transmision == 0)
                                                    <span> Automático </span>
                                                @else 
                                                    <span> Mecánico </span>
                                                @endif           
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Fecha de inicio arriendo</span>
                                            <span> {{$reserva->fecha_recogido}} </span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Fecha de término arriendo</span>
                                            <span> {{$reserva->fecha_devolucion}} </span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Precio </span>
                                            <span> {{$auto->precio}} </span>      
                                        </li>  
                                </ul>
                            </div>
                            </a>
                        </div>
                </div>
            @elseif($compra->reserva_habitacion_id != null)
                <?php $reserva = \App\ReservaHabitacion::find($compra->reserva_habitacion_id);
                      $habitacion = \App\Habitacion::find($reserva->habitacion_id);?>
                <div class="col-lg-4">
                        <div class="single-destinations" >
                            <div class="details">
                                <ul class="package-list">
                                    <li class="d-flex justify-content-between align-items-center">
                                    <span> Fecha de compra</span>
                                    <span>{{$compra->fecha_compra}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span> Hora de compra </span>
                                        <span>{{$compra->hora_compra}}</span>
                                    </li>	
                                    <li class="d-flex justify-content-between align-items-center">
                                            <span> Número de Habitación </span>
                                            <span>{{$habitacion->numero_habitacion}}</span>
                                    </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Tipo de Habitación </span>
                                            @if($habitacion->tipo_habitación)
                                                    <span>Moderna</span>
                                                @else
                                                    <span>Vintage</span>
                                                @endif
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Número de Camas </span>
                                            <span> {{$habitacion->numero_camas}}</span>        
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                                <span> Número de Baños </span>
                                                <span> {{$habitacion->numero_banos}}</span>        
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Fecha de llegada </span>
                                            <span> {{$reserva->fecha_llegada}}</span>        
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span> Fecha de término </span>
                                            <span> {{$reserva->fecha_ida}}</span>        
                                        </li>
                                </ul>
                            </div>
                            </a>
                        </div>
                </div>
            @else
                <?php $rv = \App\Compra_ReservaVuelo::where('compra_id',$compra->id)->get();?>
                    @foreach($rv as $rvuelo)
                        <?php $reservaVuelo = \App\ReservaVuelo::find($rvuelo->reserva_vuelo_id);
                        $vuelo = \App\Vuelo::find($reservaVuelo->vuelo_id);?>            
                            <div class="col-lg-4">
                                    <div class="single-destinations" >
                                        <div class="details">
                                            <ul class="package-list">
                                                <li class="d-flex justify-content-between align-items-center">
                                                <span> Fecha de compra</span>
                                                <span>{{$compra->fecha_compra}}</span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span> Hora de compra </span>
                                                    <span>{{$compra->hora_compra}}</span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                <span> Destino</span>
                                                <span>{{$vuelo->destino}}</span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span> Fecha de salida </span>
                                                    <span>{{$vuelo->fecha_ida}}</span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                <span> Fecha de llegada</span>
                                                <span>{{$vuelo->fecha_llegada}}</span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span> Precio </span>
                                                    <span>{{$reservaVuelo->precio_reserva_vuelo}}</span>
                                                </li>

                                            </ul>
                                        </div>
                                        </a>
                                    </div>
                            </div>
                    @endforeach
            @endif
        @endforeach
        @endif
            </div>
                </div>
        </section>

        <!-- End destinations Area -->
    


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
<!--
                    <div class="col-lg-4 col-sm-12 footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </footer>-->
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
    </body>
</html>
@endsection