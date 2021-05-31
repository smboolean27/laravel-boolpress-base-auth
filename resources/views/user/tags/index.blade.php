@extends('layouts.app')

@section('content')
<div class="container">
	<div class="mb-3 text-right">
		<a href="{{route('user.tags.create')}}"><button type="button" class="btn btn-success"><i class="fas fa-plus-square"></i> Aggiungi Tag</button></a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Name</th>
				<th scope="col">Slug</th>
				<th scope="col">Azioni</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($tags as $tag)
			<tr>
				<td>{{$tag->name}}</td>
				<td>{{$tag->slug}}</td>
				<td>
					<a href="{{route('user.tags.show', [ 'tag' => $tag->id ])}}"><button type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></a>
					<a href="{{route('user.tags.edit', [ 'tag' => $tag->id ])}}"><button type="button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button></a>
					<form action="{{route('user.tags.destroy', [ 'tag' => $tag->id ])}}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
					</form>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<h3>Crea un nuovo tag</h3>
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
@if (session('message'))
    <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 30px">
        {{ session('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
    </div>
@endif
@endsection