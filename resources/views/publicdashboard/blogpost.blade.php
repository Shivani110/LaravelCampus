<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Posts</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js">
        </script>
    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">
							<img src="{{ asset('/images/'.$clgtemplate->logo) }}" alt="logo">
						</a>
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
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('/images/'.$clgtemplate->first_section_background_img) }})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">Home</a></li>
							<li>Blog</li>
						</ul>
						<h1 class="white-text">Blog Page</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Blog -->
		<div id="blog" class="section">
		<!-- {{ $clgtemplate->colleges->posts }} -->
		
		<!-- container -->
		<div class="container">

				<!-- row -->
				<div class="row">

					<!-- main blog -->
					<div id="main" class="col-md-9">
					<!-- row -->
						<div class="row">
							@foreach($posts as $post)
							
							<div class="col-md-6">
								<div class="single-blog">
									<div class="blog-img">
										<a href="blog-post.html">
											<img src="{{ asset('/images/'.$post->image) }}" alt="">
										</a>
									</div>
									<h4>{{ $post->text }}</h4>
									<div class="blog-meta">
										<?php 
										$like_id = $post->id;
										$likes = json_decode($post->likes);
										$userId = Auth::user()->id;
										$like_count = count($likes);
										
										if($likes != null){
											if(in_array($userId, $likes)){
											?>
											<div class="pull-left like" id="dislike={{ $post->id }}">
												<button class="fa fa-thumbs-down dislike-btn like{{ $post->id }}" d_likeid="{{ $post->id }}" onclick="likepost(postid={{ $post->id }})"><?php echo $like_count ?></button>
											</div>
										<?php }else{ ?>
											<div class="pull-left" id="like={{ $post->id }}">
												<button class="fa fa-thumbs-up like-btn like{{ $post->id }}" likeid="{{ $post->id }}" onclick="likepost(postid={{ $post->id }})"><?php echo $like_count ?></button>
												
											</div>
										<?php }
										}else{ ?>
											<div class="pull-left" id="like={{ $post->id }}">
												<button class="fa fa-thumbs-up like-btn like{{ $post->id }}" likeid="{{ $post->id }}" onclick="likepost(postid={{ $post->id }})"><?php echo $like_count ?></button>
											</div>
										<?php 
											}
										?>
										
										<div class="pull-right comment-box">
											<button class="blog-meta-comments comment" dataid="{{ $post->id }}"><i class="fa fa-comments"></i></button>
											<div id="comment{{ $post->id }}" style="display:none">
												<input type="text" name="cmnt" id="cmnt{{ $post->id }}">
												<button class="btn btn-primary" onclick="postcomment(id={{ $post->id }})">Comment</button>
											</div>
											<div id="showcomments{{ $post->id }}" style="display:none">
												@foreach($post->commentss as $cmnt)
													<?php   
														$usertype = $cmnt->users[0]->user_type;
														$comment_id = $cmnt->id;
													?>
													@if($cmnt->comment_type == 'comment') 
														@if($usertype == 1)
															<?php
																$stu = $cmnt->users[0]->students;
																$image = $stu[0]->pictures;
															?>
															<img src="{{ asset('/images/'.$image) }}" class="user-image">
															<p>{{ $cmnt->users[0]->realname }} : {{ $cmnt->comments }}</p>
														@elseif($usertype == 2)
															<?php
																$staf = $cmnt->users[0]->staff;
																$image = $staf[0]->pictures;
															?>
															<img src="{{ asset('/images/'.$image) }}" class="user-image">
															<p>{{ $cmnt->users[0]->realname }} : {{ $cmnt->comments }}</p>
														@elseif($usertype == 3)
															<?php
																$spon = $cmnt->users[0]->sponsor;
																$image = $spon[0]->pictures;
															?>
															<img src="{{ asset('/images/'.$image) }}" class="user-image">
															<p>{{ $cmnt->users[0]->realname }} : {{ $cmnt->comments }}</p>
														@elseif($usertype == 4)
															<?php
																$alu = $cmnt->users[0]->alumni;
																$image = $alu[0]->pictures;
															?>
															<img src="{{ asset('/images/'.$image) }}" class="user-image">
															<p>{{ $cmnt->users[0]->realname }} : {{ $cmnt->comments }}</p>
														@endif
														<button class="blog-meta-comments reply" replyid="{{ $cmnt->id }}"><i class="fa fa-reply"></i></button>
														<div id="reply{{ $cmnt->id }}" style="display:none">
															<input type="text" name="reply" id="rply{{ $cmnt->id }}">
															<button class="btn btn-primary" onclick="replycomment(id={{ $cmnt->id }},post_id={{ $post->id }})" >Reply</button>
														</div>
														<div id="showreply{{ $cmnt->id }}" style="display:none">
														@foreach($cmnt->reply as $reply)
															@if($usertype == 1)
																<?php
																	$stu = $cmnt->users[0]->students;
																	$image = $stu[0]->pictures;
																?>
																<img src="{{ asset('/images/'.$image) }}" class="user-image">
																<p>{{ $cmnt->users[0]->realname }} : {{ $reply->comments }}</p>
															@elseif($usertype == 2)
																<?php
																	$staff = $cmnt->users[0]->staff;
																	$image = $staff[0]->pictures;
																?>
																<img src="{{ asset('/images/'.$image) }}" class="user-image">
																<p>{{ $cmnt->users[0]->realname }} : {{ $reply->comments }}</p>
															@elseif($usertype == 3)
																<?php
																	$sponsor = $cmnt->users[0]->sponsor;
																	$image = $sponsor[0]->pictures;
																?>
																<img src="{{ asset('/images/'.$image) }}" class="user-image">
																<p>{{ $cmnt->users[0]->realname }} : {{ $reply->comments }}</p>
															@elseif($usertype == 4)
																<?php
																	$alumni = $cmnt->users[0]->alumni;
																	$image = $alumni[0]->pictures;
																?>
																<img src="{{ asset('/images/'.$image) }}" class="user-image">
																<p>{{ $cmnt->users[0]->realname }} : {{ $reply->comments }}</p>
															@endif

														@endforeach
														
														</div>
													@endif
												@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach	
							<!-- /single blog -->
                        </div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="post-pagination">
									{{ $posts->links() }}
								</div>
							</div>
						</div>
						<!-- /row -->
					</div>
					<!-- /main blog -->

					<!-- aside blog -->
					<div id="aside" class="col-md-3">

						<!-- search widget -->
						<div class="widget search-widget">
							<form>
								<input class="input" type="text" name="search">
								<button><i class="fa fa-search"></i></button>
							</form>
						</div>
						<!-- /search widget -->

						<!-- category widget -->
						<div class="widget category-widget">
							<h3>Categories</h3>
							<a class="category" href="#">Web <span>12</span></a>
							<a class="category" href="#">Css <span>5</span></a>
							<a class="category" href="#">Wordpress <span>24</span></a>
							<a class="category" href="#">Html <span>78</span></a>
							<a class="category" href="#">Business <span>36</span></a>
						</div>
						<!-- /category widget -->

						<!-- posts widget -->
						<div class="widget posts-widget">
							<h3>Recents Posts</h3>

							<!-- single posts -->
							<div class="single-post">
								<a class="single-post-img" href="blog-post.html">
									<img src="./img/post01.jpg" alt="">
								</a>
								<a href="blog-post.html">Pro eu error molestie deserunt.</a>
								<p><small>By : John Doe .18 Oct, 2017</small></p>
							</div>
							<!-- /single posts -->

							<!-- single posts -->
							<div class="single-post">
								<a class="single-post-img" href="blog-post.html">
									<img src="./img/post02.jpg" alt="">
								</a>
								<a href="blog-post.html">Pro eu error molestie deserunt.</a>
								<p><small>By : John Doe .18 Oct, 2017</small></p>
							</div>
							<!-- /single posts -->

							<!-- single posts -->
							<div class="single-post">
								<a class="single-post-img" href="blog-post.html">
									<img src="./img/post03.jpg" alt="">
								</a>
								<a href="blog-post.html">Pro eu error molestie deserunt.</a>
								<p><small>By : John Doe .18 Oct, 2017</small></p>
							</div>
							<!-- /single posts -->

						</div>
						<!-- /posts widget -->

						<!-- tags widget -->
						<div class="widget tags-widget">
							<h3>Tags</h3>
							<a class="tag" href="#">Web</a>
							<a class="tag" href="#">Photography</a>
							<a class="tag" href="#">Css</a>
							<a class="tag" href="#">Responsive</a>
							<a class="tag" href="#">Wordpress</a>
							<a class="tag" href="#">Html</a>
							<a class="tag" href="#">Website</a>
							<a class="tag" href="#">Business</a>
						</div>
						<!-- /tags widget -->

					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- footer logo -->
					<div class="col-md-6">
						<div class="footer-logo">
							<a class="logo" href="index.html">
								<img src="{{ asset('/images/'.$clgtemplate->logo) }}" alt="logo">
							</a>
						</div>
					</div>
					<!-- footer logo -->

					<!-- footer nav -->
					<div class="col-md-6">
						<ul class="footer-nav">
							<li><a href="index.html">Home</a></li>
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
							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
							<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
					<!-- /social -->

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
						<div class="footer-copyright">
							<span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com">Colorlib</a></span>
						</div>
					</div>
					<!-- /copyright -->

				</div>
			</div>
		</footer>

	<?php 
		$role = Auth::user()->user_type;
		$id = Auth::user()->id;
	?>
		@if($role == 1)
			@foreach(\App\Models\Student::where('user_id','=',$id)->get() as $student)
			<?php $profile =  $student->pictures; ?> 
			@endforeach
		@elseif($role == 2)
			@foreach(\App\Models\Staff::where('user_id','=',$id)->get() as $staff)
			<?php $profile = $staff->pictures; ?>
			@endforeach
		@elseif($role == 3)
			@foreach(\App\Models\Sponsor::where('user_id','=',$id)->get() as $sponsor)
			<?php $profile = $sponsor->pictures; ?>
			@endforeach
		@elseif($role == 4)
			@foreach(\App\Models\Sponsor::where('user_id','=',$id)->get() as $alumni)
			<?php $profile =  $alumni->pictures; ?>
			@endforeach
		@endif

	<script>
		function likepost(id){
			var data = {
				userid:{{ Auth::user()->id }},
				id:id,
				_token:"{{ csrf_token() }}"
			}
			$.ajax({
				url:'/likes',
				type: 'post',
				data: data,
				dataType: 'JSON',
				success:function(response){
					const array = response;
					var likes=parseInt($('button.like'+id).html());
					
					if(array.includes(data.userid)){
						$('.like'+id).removeClass('fa-thumbs-up like-btn');
						$('.like'+id).addClass('fa-thumbs-down dislike-btn');
						$('button.like'+id).html(likes+1);
					}else{
						$('.like'+id).removeClass('fa-thumbs-down dislike-btn');
						$('.like'+id).addClass('fa-thumbs-up like-btn');
						$('button.like'+id).html(likes-1);
					}
				}
			});
		}

		$('.comment').click(function(e){
			var id = $(this).attr('dataid');
			$('#comment'+id).toggle();
			$('#showcomments'+id).toggle();

		})

		function postcomment(id){
			var data={
				id: id,
				userid:{{ Auth::user()->id }},
				_token:"{{ csrf_token() }}",
				comment:$('#cmnt'+id).val(),
				type:"comment",
			}

			$.ajax({
				url:'/comments',
				type:'post',
				data:data,
				dataType:"JSON",
				success:function(response){
					var comment = data.comment;
					var username = "{{ Auth::user()->realname }}";
					var image = "{{ $profile }}";
					var html = '<div><img class="user-image" src="http://127.0.0.1:8000/images/'+image+'"><p>'+username+':'+comment+'</p></div>'; 

					$('#showcomments'+id).append(html);
					$('#cmnt'+id).val('');
				}
			})
		}

		$('.reply').click(function(e){
			var id = $(this).attr('replyid');
			$('#reply'+id).toggle();
			$('#showreply'+id).toggle();
		})

		function replycomment(id,postid){
			var data = {
				id: id,
				postid: postid,
				userid:{{ Auth::user()->id }},
				_token:"{{ csrf_token() }}",
				reply:$('#rply'+id).val(),
				type:"reply",
			}
			$.ajax({
				url:'/reply',
				type:"post",
				data:data,
				dataType:"json",
				success:function(response){
					console.log(response);
				}
			})
		}
		
	</script>

		<div id='preloader'><div class='preloader'></div></div>
		<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
		
	</body>
</html>
