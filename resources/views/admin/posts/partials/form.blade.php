{{-- se usa un campo oculto para alojar aqui el id del usuario logueado --}}
{{ form::hidden('user_id',auth()->user()->id) }}
<div class="form-group">
	{{ form::label('category_id','Categorias') }}
	{{ form::select('category_id',$categories,null,['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ form::label('name','Nombre de la etiqueta') }}
	{{ form::text('name' ,null,['class'=>'form-control','id'=>'name', 'value'=>'4.50', 'required' => 'required']) }}
</div>
<div class="form-group">
	{{ form::label('slug','URL amigable') }}
	{{ form::text('slug',null,['class'=>'form-control','id'=>'slug']) }}
</div>
<div class="form-group">
	{{ form::label('file','Image') }}
	{{ form::file('file') }}
</div>
<div class="form-group">
	{{ form::label('status','Estado') }}
	<label>
		{{ form::radio('status','PUBLISHED') }}Publicado
	</label>
	<label>
		{{ form::radio('status','DRAFT') }}Borrador
	</label>
</div>
<div class="form-group">
	{{ form::label('tags','Etiquetas') }}
	<div>
		@foreach ($tags as $tag)
		<label>
			{{ form::checkbox('tags[]',$tag->id) }} {{ $tag->name }}
		</label>
		@endforeach
	</div>
</div>
<div class="form-group">
	{{ form::label('excerpt','Extracto') }}
	{{ form::textarea('excerpt',null,['class'=>'form-control','rows'=>'2']) }}
</div>

<div class="form-group">
	{{ form::label('body','Descripcion') }}
	{{ form::textarea('body',null,['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ form::submit('Guardar',['class'=>'btn btn-sm btn-primary' ]) }}
</div>
@section('scripts')
	<script type="text/javascript" src="{{ asset('vendor/StringToSlug/jquery.stringtoslug.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		/*se usa el metodo keyup para que cuando se escriba en el campo name 
		se llene automaticamente el campo slug en minuscula usando toLowerCase()*/
			$('#name').keyup(function() {
			var slug = $('#name').val().toLowerCase();
				$('#slug').val(slug);
			});
		});
		/*codigo necesario para que funcione el editor de texto*/
		CKEDITOR.config.height = 400;
		CKEDITOR.config.width = 'auto';
		CKEDITOR.replace('body');
	</script>
@endsection