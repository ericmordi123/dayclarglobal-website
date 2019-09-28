@extends('layout')
@section('w-title', 'Contact')

@section('menu')
	@parent
@endsection

@section('content')
	<!-- One -->
	<section id="One"
		class="wrapper style3 services-bg">
		<div class="inner">
			<header class="align-center">
				<p>Contact us for any for further information, we aim to respond to enquires within 24hours</p>
				<h2>Contact Us</h2>
			</header>
		</div>
	</section>

	<!-- Two -->
	<section id="two"
		class="wrapper style2">
		<div class="inner">
			<div class="row">
				<div class="content col-sm-6">
					<address class="text-center">
						<header class="align-center">
							<h2>Corporate Head Office</h2>
						</header>
						<b>Address:</b> <span>Plot 16B, Adebisi Oyenola Street,</br> Idado Estate, Lekki Lagos.</span></br>
						<b>Tel:</b> 08139397686, 08032013691</br>
						<b>DL:</b> 09069000030</br>
					</address>
				</div>



				<div class="content col-sm-6">
					<address class="text-center">
						<header class="align-center">
							<h2>USA Head Office</h2>
						</header>
						<b>Address:</b><span>3272, W.Lake Mary Blvd,</br>Suite 1830, Lake Mary FL. 32746</span></br>
						<b>Tel:</b> +17866737002</br>
					</address>
				</div>
			</div>
			<div class="pt-5 text-center">
				<header>
					<h3>E-mail</h3>
				</header>
				<p><b>CEO: <a href="mailto:ernest.abhulimen@dayclargroup.com">ernest.abhulimen@dayclargroup.com</a> </b></p>
				<p><b><a href="mailto:info@dayclargroup.com">info@dayclargroup.com</a></b></p>

			</div>
	</section>
@endsection

@section('footer')
	@parent
@endsection
