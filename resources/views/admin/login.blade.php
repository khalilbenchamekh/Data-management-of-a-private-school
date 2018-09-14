<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href=" {{ URL::asset('css/bootstrap.min.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/bulma.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/style.css') }} ">
		<link rel="stylesheet" href=" {{ URL::asset('css/font-awesome-4.5.0/css/font-awesome.min.css') }} ">
		<title>UMD - admin - login</title>
	</head>
	<body class="container-fluid login-container">
		<div class="columns">

			<form class="column is-offset-4 is-4 login-credentials" role="form" method="POST" action="{{ url('admin') }}">
				{!! csrf_field() !!}

					<img src="{{ asset('images/umd-logo.png') }}" alt="" />

					@if(session("error"))
						<article class="message is-danger">
						  <div class="message-header">
						    {{ session("error") }}
						  </div>
						</article>
					@endif

					<label class="label">nom d'utilisateur : </label>

					<p class="control">
						<input type="text" class="input" name="name" value="{{ old('name') }}">
					</p>

					<label class="label">mot de passe : </label>

					<p class="control">
						<input type="password" class="input" name="password">
					</p>

					<!-- <label class="checkbox">
						<input type="checkbox" name="remember"> Remember Me
					</label> -->
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="button is-primary pull-right">
							se connecter
						</button>

						<!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
					</div>
				</div>
			</form>
		</div>
		<script src="{{ asset('javascript/jquery-2.2.0.min.js') }}"></script>
	</body>
</html>
