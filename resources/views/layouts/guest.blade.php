<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>@yield('pageTitle')</title>
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/guest.css')}}">
	</head>
	<body>
		<div class="container">

			<header class="blog-header py-3">
			  <div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-4 pt-1">
				  <a class="text-muted" href="#">Subscribe</a>
				</div>
				<div class="col-4 text-center">
				  <a class="blog-header-logo text-dark" href="{{route('guest.index')}}">Boolpress</a>
				</div>
				<div class="col-4 d-flex justify-content-end align-items-center">
				  <a class="text-muted" href="{{route('guest.search')}}">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
				  </a>
				  @guest
				  <a class="btn btn-sm btn-outline-secondary mr-2" href="{{ route('register') }}">Sign up</a>
				  <a class="btn btn-sm btn-outline-primary" href="{{ route('login') }}">Sign in</a>
				  @else
				  <a class="btn btn-sm btn-outline-primary" href="{{ route('user.home') }}">Dashboard</a>
				  @endguest
				</div>
			  </div>
			</header>
			{{-- search inza --}}
			<div class="search">
				
			</div>
	        {{-- fine search --}}
			<div class="nav-scroller py-1 mb-2">
			  <nav class="nav d-flex justify-content-between">
				@foreach ($tags as $tag)
				<a class="p-2 text-muted" href="{{route('guest.show-tag', ['slug' => $tag->slug])}}">{{$tag->name}}</a>
				@endforeach
			  </nav>
			</div>
		  </div>
	  
		  <main role="main" class="container">
			@yield('content')
		  </main><!-- /.container -->
	  
		  <footer class="blog-footer">
			<p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
			<p>
			  <a href="#">Back to top</a>
			</p>
		  </footer>
		  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		  @yield('js')
	</body>
</html>