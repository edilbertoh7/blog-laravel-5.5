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
				{!! form::model($category,['route'=>['categories.update',$category->id],'method'=>'PUT']) !!}
				@include('admin.categories.partials.form')
				{!! form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
	@endsection
