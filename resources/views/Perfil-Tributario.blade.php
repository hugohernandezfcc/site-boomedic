@extends('adminlte::page')

@section('title', 'Boomedic')


@section('content')
	<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Perfil tributario</h3>
    </div>
    @if (count($errors) > 0) 
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
    @if(count($perfil)>0)
          <!-- /.box-header -->
      <div class="box-body">
        <form action="/update/{{$user[0]->id}}" method="post">
        	{{ csrf_field() }}
          <!-- text input -->
         	<div class="form-group">
            	<label>Empresa/Nombre legal</label>
            	<input value="{{$perfil[0]->company_legalName}}" id="company_legalName" name="company_legalName" type="text" class="form-control" placeholder="Enter ..." name="" >
          </div>
          <div class="form-group">
            	<label>RFC</label>
            	<input value="{{$perfil[0]->rfc}}" id="rfc" name="rfc" type="text" class="form-control" placeholder="Enter ..." >
          </div>
          <div class="form-group">
          	<div class="checkbox">
                <label>
                  	<input id="copyDir" type="checkbox">
                  	¿Copiar dirección del perfil?
                </label>
            	</div>
            	<label>País</label>
            	<input value="{{$perfil[0]->country}}" id="country" type="text" class="form-control" placeholder="Enter ..." value="" name="country">
          </div>
          <div class="form-group">
            	<label>Estado</label>
            	<input value="{{$perfil[0]->state}}" id="state" type="text" class="form-control" placeholder="Enter ..." value="" name="state">
          </div>
          <div class="form-group">
            	<label>Delegación/Municipio</label>
            	<input value="{{$perfil[0]->delegation}}" id="delegation" type="text" class="form-control" placeholder="Enter ..." value="" name="delegation">
          </div>
          <div class="form-group">
            	<label>Colonia</label>
            	<input value="{{$perfil[0]->colony}}" id="colony" type="text" class="form-control" placeholder="Enter ..." value="" name="colony">
          </div>
          <div class="form-group">
            	<label>Calle</label>
            	<input value="{{$perfil[0]->street}}" id="street" name="street" type="text" class="form-control" placeholder="Enter ..." value="" >
          </div>
          <div class="form-group">
            	<label>Número exterior</label>
            	<input value="{{$perfil[0]->exteriorNumber}}" id="exteriorNumber" type="text" class="form-control" placeholder="Enter ..." value="" name="exteriorNumber">
          </div>
          <div class="form-group">
            	<label>Número interior</label>
            	<input value="{{$perfil[0]->interiorNumber}}" id="interiorNumber" type="text" class="form-control" placeholder="Enter ..." value="" name="interiorNumber">
          </div>
          <div class="form-group">
            	<label>Código postal</label>
            	<input value="{{$perfil[0]->postalCode}}" id="postalCode" type="text" class="form-control" placeholder="Enter ..." value="" name="postalCode">
          </div>
          
          <div class="box-footer">
          	<button type="submit" class="btn btn-secondary">Guardar</button>
        	</div>
        </form>
      </div>
    @else
      <div class="box-body">
        <form action="/update/{{$user[0]->id}}" method="post">
          {{ csrf_field() }}
          <!-- text input -->
          <div class="form-group">
            <label>Empresa/Nombre legal</label>
            <input id="company_legalName" name="company_legalName" type="text" class="form-control" placeholder="Enter ..." name="" >
          </div>
          <div class="form-group">
            <label>RFC</label>
            <input id="rfc" name="rfc" type="text" class="form-control" placeholder="Enter ..." >
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                  <input id="copyDir" type="checkbox">
                  ¿Copiar dirección del perfil?
              </label>
            </div>
            <label>País</label>
            <input id="country" type="text" class="form-control" placeholder="Enter ..." value="" name="country">
          </div>
          <div class="form-group">
            <label>Estado</label>
            <input id="state" type="text" class="form-control" placeholder="Enter ..." value="" name="state">
          </div>
          <div class="form-group">
            <label>Delegación/Municipio</label>
            <input id="delegation" type="text" class="form-control" placeholder="Enter ..." value="" name="delegation">
          </div>
          <div class="form-group">
            <label>Colonia</label>
            <input id="colony" type="text" class="form-control" placeholder="Enter ..." value="" name="colony">
          </div>
          <div class="form-group">
            <label>Calle</label>
            <input id="street" name="street" type="text" class="form-control" placeholder="Enter ..." value="" >
          </div>
          <div class="form-group">
            <label>Número exterior</label>
            <input id="exteriorNumber" type="text" class="form-control" placeholder="Enter ..." value="" name="exteriorNumber">
          </div>
          <div class="form-group">
            <label>Número interior</label>
            <input id="interiorNumber" type="text" class="form-control" placeholder="Enter ..." value="" name="interiorNumber">
          </div>
          <div class="form-group">
            <label>Código postal</label>
            <input id="postalCode" type="text" class="form-control" placeholder="Enter ..." value="" name="postalCode">
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-secondary">Guardar</button>
          </div>
        </form>
      </div>
    @endif
  </div>
@stop

@section('css')
@stop

@section('js')
	<script type="text/javascript">
  	$(document).on('change','input[type="checkbox"]' ,function(e) {
  	  if(this.id=="copyDir") {
  	    if(this.checked){
  	      document.getElementById("country").value='{{$user[0]->country}}';
  				document.getElementById("state").value='{{$user[0]->state}}';
  				document.getElementById("delegation").value='{{$user[0]->delegation}}';
  				document.getElementById("colony").value='{{$user[0]->colony}}';
  				document.getElementById("street").value='{{$user[0]->street}}';
  				document.getElementById("streetNumber").value='{{$user[0]->streetnumber}}';
  				document.getElementById("interiorNumber").value='{{$user[0]->interiornumber}}';
  				document.getElementById("codePostal").value='{{$user[0]->postalcode}}';
        }
      }    
  	});
	</script>
@stop