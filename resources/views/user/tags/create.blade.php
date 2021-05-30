@extends('layouts.app')

@section('pageTitle')
	Crea un nuovo tag
@endsection

@section('content')

<div class="container">
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{route('user.tags.store')}}" method="POST">
		@csrf
		@method('POST')
		<div class="form-group">
			<label for="title">Nome</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Nome">
		</div>
		<div class="mt-3">
			<button type="submit" class="btn btn-primary">Crea</button>
		</div>
	</form>
</div>
	
@endsection