<div class="form-group">
	{{ form::label('name','Nombre de la etiqueta') }}
	{{ form::text('name' ,null,['class'=>'form-control','id'=>'name', 'value'=>'4.50', 'required' => 'required']) }}
</div>
<div class="form-group">
	{{ form::label('slug','URL amigable') }}
	{{ form::text('slug',null,['class'=>'form-control','id'=>'slug']) }}
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
	<script type="text/javascript">
		$(document).ready(function() {
			// $("#$name,#slug").stringtoslug({
			// 	callback:function (text) {
			// 		$("#slug").val(text);
			// 	}
			// });
			$('#name').val("");
			$('#slug').val("");
			$('#name').keyup(function() {
			var slug = $('#name').val().toLowerCase();
				$('#slug').val(slug);
			});
			// $('#slug').val(slug);
		});
	</script>
@endsection