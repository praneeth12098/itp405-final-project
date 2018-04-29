<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>@yield('title')</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="profile.css"> -->
		<style>
		
		img {
		  display: block;
		  max-width:300px;
		  max-height:300px;
		  width: auto;
		  height: auto;
		}

		</style>
	</head>
	<body>
		<div class="container">
			<ul class="nav">
				@if(Auth::check())
					<li class="nav-item">
						<a href="/profile" class="nav-link">My Profile</a>
					</li>
					<li class="nav-item">
						<a href="/receiveAlerts" class="nav-link">Receive Text Alerts</a>
					</li>
					<li class="nav-item">
						<a href="/searchArtists" class="nav-link">Subscribe to Artists</a>
					</li>
					<li class="nav-item">
						<a href="/logout" class="nav-link">Logout</a>
					</li>
				@else
					<li class="nav-item">
						<a href="/login" class="nav-link">Login</a>
					</li>
				@endif
			</ul>
			@yield('content')
		</div>
	</body>
</html>