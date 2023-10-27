<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>College Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
			
		<!-- Header -->
		<header id="header" class="transparent-nav">
			<div class="container">

				<div class="navbar-header">
                    <!-- {{ $clgtemplate }} -->
					<!-- Logo -->
					<div class="navbar-brand">
						<img src="{{ asset('/images/'.$clgtemplate->logo) }}" alt="logo">
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right">
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Courses</a></li>
						<li><a href="{{ url('/blogposts/'.$clgtemplate->slug) }}">Blog</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->

		<!-- Home -->
		<div id="home" class="hero-area">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('/images/'.$clgtemplate->first_section_background_img) }})"></div>
			<!-- /Backgound Image -->

			<div class="home-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h1 class="white-text">{{ $clgtemplate->first_section_title }}</h1>
                            <p class="lead white-text"><?php echo($clgtemplate->first_section_description) ?></p>
                            <a class="main-button icon-button" href="#">{{ $clgtemplate->first_section_button_text }}</a>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /Home -->

		<!-- About -->
		<div id="about" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="section-header">
                        <?php echo($clgtemplate->second_section_left_textarea) ?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="about-img">
							<img src="{{ asset('/images/'.$clgtemplate->second_section_right_image) }}">
						</div>
					</div>

				</div>
				<!-- row -->

			</div>
			<!-- container -->
		</div>
		<!-- /About -->

		<!-- Courses -->
		<div id="courses" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
					<div class="section-header text-center">
						<h2>{{ $clgtemplate->third_section_title }}</h2>
						<p class="lead">{{ $clgtemplate->third_section_subtitle }}</p>
					</div>
				</div>
				<!-- /row -->

				<!-- courses -->
				<div id="courses-wrapper">

					<!-- row -->
					<div class="row">
                        <?php 
                            $image = json_decode($clgtemplate->third_section_image); 
                            $text = json_decode($clgtemplate->third_section_image_txt);

                            for($i=0;$i<count($image);$i++){ ?>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="course">
                                    <img src="{{ asset('/images/'.$image[$i]) }}" height="200px" width="200px">
                                    <div>
                                        {{ $text[$i] }}
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
					<div class="row">
					<div class="center-btn">
						<a class="main-button icon-button" href="#">{{ $clgtemplate->third_section_button_txt }}</a>
					</div>
				</div>

			</div>
			<!-- container -->

		</div>
		<!-- /Courses -->

		<!-- Call To Action -->
		<div id="cta" class="section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('/images/'.$clgtemplate->fourth_section_background_img)}})"></div>
			<!-- /Backgound Image -->

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<div class="col-md-6">
						<h2 class="white-text">{{ $clgtemplate->fourth_section_title }}</h2>
					    <p class="lead white-text"><?php   echo($clgtemplate->fourth_section_description) ?></p>
						<a class="main-button icon-button" href="#">{{ $clgtemplate->fourth_section_button_txt }}</a>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Call To Action -->

		<!-- Why us -->
		<div id="why-us" class="section">

			<!-- container -->
			<div class="container">
				<div class="row">
					<div class="section-header text-center">
						<h2>{{ $clgtemplate->fifth_section_title }}</h2>
						<p class="lead">{{ $clgtemplate->fifth_section_subtitle }}</p>
						<?php echo($clgtemplate->fifth_section_textarea) ?> 
					</div>
				</div>
			</div>
			<!-- /container -->

		</div>
		

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- footer logo -->
					<div class="col-md-6">
						<div class="footer-logo">
							<img src="{{ asset('/images/'.$clgtemplate->logo) }}" alt="logo">
						</div>
					</div>
					<!-- footer logo -->

					<!-- footer nav -->
					<div class="col-md-6">
						<ul class="footer-nav">
							<li><a href="#">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Courses</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</div>
					<!-- /footer nav -->

				</div>
				<!-- /row -->

				<!-- row -->
				<div id="bottom-footer" class="row">

					<!-- social -->
					<div class="col-md-4 col-md-push-8">
						<ul class="footer-social">
						
							<li><a href="{{ $clgtemplate->last_section_fb_link }}" class="facebook"><i class="fa fa-facebook"></i></a></li>
						
						
							<li><a href="{{ $clgtemplate->last_section_twitter_link }}" class="twitter"><i class="fa fa-twitter"></i></a></li>
						
						
							<li><a href="{{ $clgtemplate->last_section_instagram_link }}" class="instagram"><i class="fa fa-instagram"></i></a></li>
						
						
							<li><a href="{{ $clgtemplate->last_section_linkedin_link }}" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
							
						</ul>
					</div>
					<!-- /social -->

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
						<div class="footer-copyright">
							<?php echo($clgtemplate->last_section_textarea) ?>
						</div>
					</div>
					<!-- /copyright -->

				</div>
				<!-- row -->

			</div>
			<!-- /container -->

		</footer>
		<!-- /Footer -->

		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

	</body>
</html>
