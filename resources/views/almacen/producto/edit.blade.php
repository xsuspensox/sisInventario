@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto : {{$producto->nombre}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>
						{{$error}}
					</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::model($producto,['method'=>'PATCH','route'=>['producto.update',$producto->idproducto]])!!}
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" required value="{{$producto->nombre}}"  name="nombre" class="form-control">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Categoria</label>
				<select name="idcategoria" class="form-control">
					@foreach ($categorias as $cat)
						@if ($cat->idcategoria==$producto->idcategoria)
						<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
						@else
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" required value="{{$producto->stock}}" name="stock" class="form-control">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Unidad de Medida</label>
				<select name="unidad_medida" class="form-control">
					@if ($producto->unidad_medida=='KG.')
					<option value="KG." selected>KG.</option>
					<option value="LTR.">LTR.</option>
					<option value="UNID.">UNID.</option>
					@elseif ($producto->unidad_medida=='LTR.')
					<option value="KG.">KG.</option>
					<option value="LTR." selected>LTR.</option>
					<option value="UNID.">UNID.</option>
					@else
					<option value="KG.">KG.</option>
					<option value="LTR.">LTR.</option>
					<option value="UNID." selected>UNID.</option>
					@endif
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" value="{{$producto->descripcion}}" name="descripcion" class="form-control" placeholder="descripcion del art...">
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>

			{!!Form::close()!!}

@endsection