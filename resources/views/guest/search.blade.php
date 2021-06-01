@extends('layouts.guest')

@section('pageTitle')
	Boolpress
@endsection

@section('content')

<div class="row">
  <div class="col-md-8 blog-main">
  <div id="app">
    <div>
        <input type="text" v-model="title"> 
        <button class="search" v-on:click='postsSearch'>cerca</button>
    </div>
    <div>
        <div v-for="post in posts">
            <h2>@{{post.title}}</h2>
            <p>@{{post.content}}</p>
        </div>
    </div>
    
  </div>
  
	
  </div><!-- /.blog-main -->

  <aside class="col-md-4 blog-sidebar">
	<div class="p-3 mb-3 bg-light rounded">
	  <h4 class="font-italic">About</h4>
	  <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
	</div>

	<div class="p-3">
	  <h4 class="font-italic">Archives</h4>
	  <ol class="list-unstyled mb-0">
		<li><a href="#">March 2014</a></li>
		<li><a href="#">February 2014</a></li>
		<li><a href="#">January 2014</a></li>
		<li><a href="#">December 2013</a></li>
	</div>
  </aside><!-- /.blog-sidebar -->

</div><!-- /.row -->

@endsection

@section('js')
    <script src="{{asset('js/search.js')}}"></script>
@endsection