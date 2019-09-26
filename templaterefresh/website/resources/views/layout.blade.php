<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	
    <title>DayClarGlobalVentures</title>
	<meta charset="utf-8" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1" />
	<link rel="stylesheet"
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">
	<!-- Slick Carousel -->
	<link rel="stylesheet"
		type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
	<link rel="stylesheet"
		type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />


	<link rel="stylesheet"
		href="/assets/css/main.css" />
	<link rel="stylesheet"
		href="/assets/css/dayclar.css">
	
</head>

<body>

    <!-- Header -->
	<header id="header"
		class="alt">
		<div class="logo"></a></div>
		<a href="#menu">Menu</a>
	</header>

    @section('menu')
        <!-- Nav -->
        <nav id="menu">
            <ul class="links">
                <li><a href="index.html">Home</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    @show

    <template>
        @yield('content')
    </template>

    @section('footer')
            <!-- Footer -->
        <footer id="footer"
            class="custom-footer footer-distributed p-0 bg-transparent m-0">

            <div class="container-fluid p-0">
                <div class="row footer-distributed m-0">
                    <div class="col-12 col-lg-5">
                        <h3>DayClarGlobalVentures Limited</h3>

                        <p class="footer-links">
                            <a href="#">Home</a> ·
                            <a href="/#about">About</a> ·
                            <a href="/#portfolio">Portfolio</a> ·
                            <a href="/contact.html">Contact</a>
                        </p>

                        <p class="footer-company-name">DayClar Global Ventures Limited &copy; 2019</p>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div>
                            <i class="fa fa-map-marker"></i>
                            <p><span>16 B Adebisi Oyenola Street, Idado Lekki</span> Lagos, Nigeria</p>
                        </div>

                        <div>
                            <i class="fa fa-phone"></i>
                            <p>09069000030, 08139397686</p>
                        </div>

                        <div>
                            <i class="fa fa-envelope"></i>
                            <p><a href="mailto:info@dayclargroup.com">info@dayclargroup.com</a></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <p class="footer-company-about">
                            <span>About the company</span> DayClar Global Ventures is a company that specialises in all things
                            property
                            and aims to make every house a home.
                        </p>
                    </div>
                </div>
            </div>

        </footer>
    @show

	<!-- Scripts -->
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/jquery.scrollex.min.js"></script>
	<script src="/assets/js/skel.min.js"></script>
	<script src="/assets/js/util.js"></script>

	<script src="/data.js"></script>
	<script src="/assets/js/dayclar.js"></script>
	<script src="/assets/js/main.js"></script>


	<!-- Carousel -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
</body>

</html>