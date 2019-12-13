<div class="form-group">
	{{ form::label('name','Nombre de la etiqueta') }}
	{{ form::text('name',null,['class'=>'form-control','id'=>'name']) }}
</div>
<div class="form-group">
	{{ form::label('slug','URL amigable') }}
	{{ form::text('slug',null,['class'=>'form-control','id'=>'slug']) }}
</div>
<div class="form-group">
	{{ form::submit('Guardar',['class'=>'btn btn-sm btn-primary']) }}
</div>