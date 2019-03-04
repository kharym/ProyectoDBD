@extends('layouts.app')
@section('content')
              <?php $paquete = App\Paquete::find($id);
                    $auto = App\Auto::find($paquete->auto_id);
                    $vuelo = App\Vuelo::find($paquete->vuelo_id);?>
			<!-- start banner Area -->
			<section class="about-banner relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Compra				
							</h1>	
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
 <section class="destinations-area section-gap")>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content pb-40 col-lg-8">
                            <div class="title text-center">
                                <h1 class="mb-10">Compra</h1>
                                <p>Detalle | Pago</p>
                            </div>
                        </div>
                    </div>                      
            <div class="row">
                        <div class="col-lg-4">
                                <div class="single-destinations">            
                                    <div class="details" style="background-color: #f6fd8c ; color: black;">
                                        <ul class="package-list">
                                            <h4 class="d-flex justify-content-between align-items-center">
                                                <span> Origen Vuelo </span>
                                                <span>  {{$vuelo->origen}}</span>
                                            </h4>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <span> Destino Vuelo </span>
                                                <span> {{$vuelo->destino}} </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <span> Fecha ida </span>
                                                <span> {{$vuelo->fecha_ida}} </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                    <span> Fecha llegada </span>
                                                    <span> {{$vuelo->fecha_llegada}} </span>         
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <span> Marca Auto </span>
                                                <span> {{$auto->marca}} </span>      
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <span> Modelo auto</span>
                                                <span> {{$auto->modelo}} </span>
                                            </li>                                     
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            



                            <div class="col-lg-8">
                                <div class="row justify-content-center">
                                    <div class="card">
                                        <div class="card-header">
                                            Compra
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Total</h5>     
										<form method="get" action="/compra-auto+vuelo/{{$id}}/{{auth()->user()->id}}">
                                                <div class="form-group" >    
                                                    <label for="medioPago" > Medio de pago</label>
                                                    <select class="form-control" id="medioPago" name="medioPago">
                                                        <option value="1">Crédito</option>
                                                        <option value="2">Débito</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">    
                                                    <label for="numeroCuenta" > Numero de cuenta</label>
                                                    <input class="form-control" input="text" name="numeroCuenta" required>  
                                                </div>
                                            
                                                <div class="col text-center">
                                                    <button type="submit" class="btn btn-primary">Comprar</button>
                                                </div>        
                                            </form>
                            
                                        </div>
                                    </div>
                                </div>
                            </div>



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