<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href=" {{ URL::asset('css/bootstrap.min.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/bulma.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/style.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/font-awesome-4.5.0/css/font-awesome.min.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/admin-style.css') }} ">
		<title>UMD - admin - @yield('title')</title>
	</head>
	<body class="container-fluid admin-container">
		<div class="columns">
			<div class="column is-3 admin-sidebar">
				<aside class="menu">
					<p class="menu-label image">
						<img src="{{ asset('images/umd-logo-inverted-3.png') }}" alt="" />
					</p>
					 <p class="menu-label">
					   Generale
					 </p>
					 <ul class="menu-list">
					 	<li><a class="{{ Request::is('admin') ? 'is-active' : '' }}" href="{{ url('admin') }}">profile</a></li>
						 @if($role == "admin")
		   				    <li><a class="{{ Request::is('admin/options') ? 'is-active' : '' }}" href="{{ url('admin/options') }}">Options</a></li>
		   					<li><a class="{{ Request::is('admin/members') ? 'is-active' : '' }}" href="{{ url('admin/members') }}">membres</a></li>
						 @endif
					 </ul>
				  <p class="menu-label">
				    Articles
				  </p>
				  <ul class="menu-list">
					<li><a class="{{ Request::is('admin/articles') ? 'is-active' : '' }}" href="{{ route('admin.articles.index') }}">tout les articles</a></li>
				    <li><a class="{{ Request::is('admin/articles/create') ? 'is-active' : '' }}" href="{{ route('admin.articles.create') }}">ajouter un article</a></li>
					@if($role == "admin" || $role == "manager")
						<li><a class="{{ Request::is('admin/comments') ? 'is-active' : '' }}" href="{{ route('admin.comments.index') }}">commentaires
							<span class="tag {{ $newComs == 0 ? "is-dark" : "is-warning" }}">{{ $newComs }}</span>
						</a></li>
					@endif
				  </ul>
				  @if($role == "admin" || $role == "manager")
					  <p class="menu-label">
					    Presse
					  </p>
					  <ul class="menu-list">
						<li><a class="{{ Request::is('admin/press') ? 'is-active' : '' }}" href="{{ route('admin.press.index') }}">tout les articles de presse</a></li>
					    <li><a class="{{ Request::is('admin/press/create') ? 'is-active' : '' }}" href="{{ route('admin.press.create') }}">ajouter un article de presse</a></li>
					  </ul>
					  <p class="menu-label">
					    Categories
					  </p>
					  <ul class="menu-list">
						<li><a class="{{ Request::is('admin/categories') ? 'is-active' : '' }}" href="{{ route('admin.categories.index') }}">tout les categories</a></li>
					    <li><a class="{{ Request::is('admin/categories/create') ? 'is-active' : '' }}" href="{{ route('admin.categories.create') }}">ajouter une categorie</a></li>
					  </ul>
					<p class="menu-label">
					  Evenements
					</p>
					<ul class="menu-list">
					  <li><a class="{{ Request::is('admin/events') ? 'is-active' : '' }}" href="{{ route('admin.events.index') }}">tout les evenements</a></li>
					  <li><a class="{{ Request::is('admin/events/create') ? 'is-active' : '' }}" href="{{ route('admin.events.create') }}">ajouter un evenemnent</a></li>
					</ul>
					<p class="menu-label">
					  Notifications
					</p>
					<ul class="menu-list">
					  <li><a class="{{ Request::is('admin/notifications') ? 'is-active' : '' }}" href="{{ route('admin.notifications.index') }}">toute les notifications</a></li>
					  <li><a class="{{ Request::is('admin/notifications/create') ? 'is-active' : '' }}" href="{{ route('admin.notifications.create') }}">ajouter une notification</a></li>
					</ul>
					<p class="menu-label">
					  Galerie
					</p>
					<ul class="menu-list">
					  <li><a class="{{ Request::is('admin/galerie') ? 'is-active' : '' }}" href="{{ route('admin.galerie.index') }}">toute les images</a></li>
					  <li><a class="{{ Request::is('admin/galerie/create') ? 'is-active' : '' }}" href="{{ route('admin.galerie.create') }}">ajouter une image</a></li>
					  <li><a class="{{ Request::is('admin/videos') ? 'is-active' : '' }}" href="{{ route('admin.videos.index') }}">tout les videos</a></li>
					  <li><a class="{{ Request::is('admin/videos/create') ? 'is-active' : '' }}" href="{{ route('admin.videos.create') }}">ajouter un video</a></li>
					</ul>
					
				  @endif
				  @if($role == "admin")
					  <p class="menu-label">
    				    Utilistaeurs
    				  </p>
    				  <ul class="menu-list">
    				    <li><a class="{{ Request::is('admin/users') ? 'is-active' : '' }}" href="{{ route('admin.users.index') }}">tout les utilisateurs</a></li>
    				    <li><a class="{{ Request::is('admin/users/create') ? 'is-active' : '' }}" href="{{ route('admin.users.create') }}">ajouter un utilisateur</a></li>
    				  </ul>
				  @endif

				  <p>
				  	<ul class="menu-list logout">
				  		<li><a class="button is-primary is-outlined" href="{{ url('/admin/logout') }}">deconnecter</a></li>
				  	</ul>
				  </p>
				</aside>
			</div>
			<div class="column is-9 admin-content">
				 @yield('content')
			</div>
		</div>
		<script src=" {{ asset('javascript/jquery-2.2.0.min.js')}}"></script>
		<script src="{{ asset('javascript/tinymce/tinymce.min.js') }}"></script>
		<script type="text/javascript">
			$('.modal-button').click(function() {
				var target = $(this).data('target');
				$('html').addClass('has-modal-open');
				$(target).addClass('is-active');
			});

			$('.modal-background, .modal-close').click(function() {
				$('html').removeClass('has-modal-open');
				$(this).parent().removeClass('is-active');
			});
			tinymce.init({
				selector:'.mce-textarea',
				directionality : 'rtl',
				setup: function (editor) {
		        	editor.on('change', function () {
			            editor.save();
			        });
			    }
			});
		</script>
	</body>
</html>
