@extends('layouts.app')

@section('content')
	<div class="container">
		<p><strong>Nome:</strong> {{$tag->name}}</p>
		<hr>
		@if ($tag->posts->isNotEmpty())
		<div class="mt-5">
			<h3>Lista Post a cui è associato questo tag</h3>
			<ul>
				@foreach ($tag->posts as $post)
					<li>
						<h5>{{$post->title}}</h5>
					</li>
				@endforeach
			</ul>
		</div>
		@endif
		<a href="{{route('user.tags.index')}}">Torna alla lista dei tags</a>
	</div>

	@if (session('message'))
    <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 30px">
        {{ session('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
    </div>
	@endif
@endsection