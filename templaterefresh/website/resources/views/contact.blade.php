
@extends('layout')
@section('w-title', $pageModel->name)

@section('menu')
	@parent
@endsection

@section('content')
	<!-- One -->
	@if (!is_null($pageModel->sectionOneHeading) || !is_null($pageModel->sectionOneSubHeading))
	<section id="one" class="wrapper style3 services-bg"
		 	style="background: url({{!is_null($pageModel->sectionOneBgImg) ? $pageModel->baseUrl . $pageModel->sectionOneBgImg->data->url : ''}})">
		<div class="inner">
			<header class="align-center">
				<p>{{$pageModel->sectionOneSubHeading}}</p>
				<h2>{{$pageModel->sectionOneHeading}}</h2>
			</header>
		</div>
	</section>
	@endif
	

	<!-- Two -->
	<section id="two"
		class="wrapper style2">
		<div class="inner">
			<div class="row">
				@foreach ($about->offices_operating as $office)
				<div class="content col-sm-6">
					<address class="text-center">
						<header class="align-center">
							<h2>{{$office->office_id->office_name}}</h2>
						</header>
						<b>Address:</b> <span>{{$office->office_id->office_address}}</span></br>
						<b>Tel:</b> {{$office->office_id->contact_numbers}}</br>
						{{-- <b>DL:</b> 09069000030</br> --}}
					</address>
				</div>
				@endforeach
		
			</div>
			<div class="pt-5 text-center">
				<header>
					<h3>E-mail</h3>
				</header>

				@if (!is_null($about->ceo_email))
					<p><b>CEO: <a href="mailto:{{$about->ceo_email}}">{{$about->ceo_email}}</a> </b></p>
				@endif
				
				<p><b><a href="mailto:{{$about->email}}">{{$about->email}}</a></b></p>

			</div>
	</section>
	
@endsection

@section('footer')
	@parent
@endsection
