<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href=" {{ URL::asset('css/bootstrap.min.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/bulma.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/style.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/font-awesome-4.5.0/css/font-awesome.min.css') }} ">
		<title>@yield('title')حزب الإتحاد المغربي للديمقراطية - </title>
	</head>
	<body dir="rtl">
		<section class="hero is-medium" id="hero">
			<div class="hero-header">
				<header class="header">
					<div class="container">
						<div class="header-left">
				        	<a class="header-item logo-item" href="{{ url('/') }}">
				            	<img src="{{ asset('images/umd-logo-inverted-3.png') }}" alt="Logo">
				        	</a>
				        </div>
						<span class="header-toggle" id="header-toggle">
				        	<span></span>
				        	<span></span>
				        	<span></span>
				        </span>
				        <div class="header-right header-menu" id="header-menu">
							<span class="header-item">
				            	<a href="{{ url('/') }}">الفضاء الاخباري</a>
				        	</span>
				        	<span class="header-item">
				            	<a href="{{ url('/الفضاء-المؤسساتي') }}">الفضاء المؤسساتي</a>
				        	</span>
				        	<span class="header-item">
				            	<a href="{{ url('/الفضاء-الجهوي') }}">الفضاء الجهوي</a>
				        	</span>
							<span class="header-item">
				            	<a href="{{ url('/فضاء-الحزب-بالخارج') }}">فضاء الحزب بالخارج</a>
				        	</span>
							<span class="header-item">
				            	<a href="{{ url('/tv') }}">قناة الحزب</a>
				        	</span>
				        	<span class="header-item">
				            	<a href="{{ url('/galerie') }}">رواق الصور</a>
				        	</span>
				        	<span class="header-item">
				            	<a href="{{ $fbLink }}">
									<span class="icon is-medium">
										<i class="fa fa-facebook"></i>
									</span>
								</a>
								<a href="{{ $twLink }}">
									<span class="icon is-medium">
										<i class="fa fa-twitter"></i>
									</span>
								</a>
								<a href="#">
									<span class="icon is-medium">
										<i class="fa fa-instagram"></i>
									</span>
								</a>
				        	</span>
				        </div>
					</div>
				</header>
			</div>
			@yield('hero-footer')
		</section>


		@yield('content')

		<div id="membership" class="container-fluid">
			<a class="button is-large is-primary is-outlined is-centered modal-button" data-target="#modal-membership">
				<span class="icon is-medium">
					<i class="fa fa-file-text-o"></i>
				</span>
				طلب العضوية
			</a>
			@if(session('message')!=null)
				<h3 class="title is-3 is-centered">
					{{ session('message') }}
				</h3>
			@endif
 			<div id="modal-membership" class="modal">
			  <div class="modal-background"></div>
			  <div class="modal-content">
				<div class="box">
				  <div class="content">
					<h1>طلب العضوية</h1>
					<form class="" action="{{ url('subscribe') }}" method="post">
						{!! csrf_field() !!}
						<p class="control">
						  <input class="input" dir="ltr" type="text" name="lname" placeholder="الاسم" required="required">
						</p>
						<p class="control">
						  <input class="input" dir="ltr" type="text" name="fname" placeholder="النسب" required="required">
						</p>
						<p class="control">
						  <input class="input" dir="ltr" type="text" name="city" placeholder="المدينة" required="required">
						</p>
						<p class="control">
						  <input class="input" dir="ltr" type="date" name="date" placeholder="تاريخ الازدياد" required="required">
						</p>
						<p class="control">
						  <input class="input" dir="ltr" type="text" name="job" placeholder="المهنة" required="required">
						</p>
						<p class="control">
						  <input class="input" dir="ltr" type="text" name="cin" placeholder="رقم البطاقة الوطنية" required="required">
						</p>
						<p class="control">
						  <input class="input" dir="ltr" type="text" name="phone" placeholder="رقم الهاتف" required="required">
						</p>
						<p class="control">
						  <input class="input" dir="ltr" type="email" name="email" placeholder="البريد الإلكتروني" required="required">
						</p>
						<p class="control">
							<button type="submit" class="button is-info">
							  تسجيل
							</button>
						</p>
					</form>
				  </div>
				</div>
			  </div>
			  <button class="modal-close"></button>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="columns is-multiline">
					<div class="column is-3">
						<p class="image is-square">
							<img src="{{ asset('images/umd-logo-inverted-2.png') }}" alt="" />
						</p>
					</div>
					<div class="column is-4">
						<h4 class="title is-4">روابط هامة</h4>
						<div class="menu">
							<ul class="menu-list links">
								@for($i = 3; $i <= 7; $i++)
									@if( $options[$i] != null)
										<li><a href="{{ $options[$i]->option_value }}">{{ $options[($i + 6)]->option_value }}</a></li>
									@endif
								@endfor
							</ul>
						</div>
					</div>
					<div class="column is-5">
						@if(session("contact"))
							<article class="message is-success">
							  <div class="message-header">
							    {{ session("contact") }}
							  </div>
							</article>
						@endif
						<h4 class="title is-4">اتصل بنا</h4>
						<form class="" action="{{ url('contactus') }}" method="post">
							{!! csrf_field() !!}
							<p class="control">
							  <input class="input" name="name" type="text" placeholder="الاسم" required="required">
							</p>
							<p class="control">
							  <input class="input" name="email" type="email" placeholder="البريد الالكتروني" required="required">
							</p>
							<p class="control">
							  <textarea class="textarea" name="message" placeholder="نص الرسالة" required="required"></textarea>
							</p>
							<button type="submit" class="button is-info">
							  ارسال
							</button>
						</form>
					</div>
				</div>
			</div>
		</footer>

		<script src=" {{ asset('javascript/jquery-2.2.0.min.js') }} "></script>
		<script src=" {{ asset('javascript/main.js') }} "></script>
		<script src=" {{ asset('javascript/bootstrap.min.js') }} "></script>

		@yield('script')
	</body>
</html>
