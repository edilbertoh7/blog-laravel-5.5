@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Editar Categoria
					</div>

				<div class="panel-body">
				{!! form::model($post,['route'=>['posts.update',$post->id],'method'=>'PUT','file'=>true]) !!}
				@include('admin.posts.partials.form')
				{!! form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
	@endsection
