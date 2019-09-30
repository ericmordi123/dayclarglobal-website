@extends('layout')
@section('w-title', $pageModel->name)

@section('menu')
	@parent
@endsection

@section('content')
	<!-- Banner -->
	<section class="banner full"
		id="banner-home">
		@foreach ($pageModel->bannerSlides as $slide)
			<article>
			 	<img src="{{$pageModel->baseUrl . $slide->slide_image_file->data->url}}" alt="{{$slide->slide_image_file->title}}" />
            <div class="inner">
                <header>
					 		<p>{{$slide->slide_title}}</p>
					 		<h2>{{$slide->slide_subtitle}}</h2>
                </header>
            </div>
        </article>
		@endforeach
	</section>

	<!-- One -->
	@if (!is_null($pageModel->sectionOneHeading) || !is_null($pageModel->sectionOneSubHeading))
	<section id="one" class="wrapper style2"
			style="background: url({{!is_null($pageModel->sectionOneBgImg) ? $pageModel->sectionOneBgImg->data->url : ''}})">
		<div class="inner" id="about">
			<div class="grid-style">
				<div class="about-us">
					<div class="box">
						<div class="content">
							<header class="align-center">
								<p>{{$pageModel->sectionOneSubHeading}}</p>
								<h2>{{$pageModel->sectionOneHeading}}</h2>
							</header>
							{{-- renders wysiwyg html --}}
							{!! $pageModel->about->about_us !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif

	@if (!is_null($pageModel->sectionTwoHeading) || !is_null($pageModel->sectionTwoSubHeading))
	<section id="two" class="wrapper style3 services-bg" 
		style="background: url({{!is_null($pageModel->sectionTwoBgImg) ? $pageModel->baseUrl . $pageModel->sectionTwoBgImg->data->url : ''}})">
		<div class="inner">
			<header class="align-center pb-4 container-fluid">
				<h2>{{$pageModel->sectionTwoSubHeading}}</h2>
			</header>
			<div class="container services-container">
				<div class="row text-center">
					@foreach ($pageModel->servicesOffered as $service)
						<div class="col-12 col-md-6 col-lg-3 mb-3">
							<header>
								<i class="{{$service->service_icon}}"
									aria-hidden="true"></i>
								<h3>{{$service->title}}</h3>
							</header>
							{{-- renders wysiwyg html --}}
							{!! $service->description !!}
						</div>
						<!---->
					@endforeach
					
				</div>
			</div>
		</div>
	</section>
	@endif

	@if (!is_null($pageModel->sectionThreeHeading) || !is_null($pageModel->sectionThreeSubHeading))
	<section id="three"
		class="wrapper style2 portfolio-section">
		<div class="inner" id="portfolio">
			<header class="align-center">
				<p class="special">{{$pageModel->sectionThreeSubHeading}}</p>
				<h2>{{$pageModel->sectionThreeHeading}}</h2>
			</header>
			<div class="gallery">
				@foreach ($pageModel->portfolio as $portfolioItem)
					@component(
						'components/properties/property_snippet_1.blade.php', 
						['portfolioItem' => $portfolioItem, 'baseUrl' => $pageModel->baseUrl]
					)
					@endcomponent
				@endforeach
			</div>
			
		</div>
	</section>
	@endif

@endsection

@section('footer')
	@parent
@endsection