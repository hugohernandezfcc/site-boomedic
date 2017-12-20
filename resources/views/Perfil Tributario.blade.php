@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Perfil tributario</h1>
@stop

@section('content')
	<div class="">
		<div class="container">
			<div id="">
				<div class="">
					<div >
						<form >
							<div >
								<label class="label">Empresa/nombre legal</label>
								<input type="text" id="empresa" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Calle</label>
								<input type="text" id="calle" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Número exterior</label>
								<input type="text" id="noExterior" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Número interior</label>
								<input type="text" id="noInterior" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Código postal</label>
								<input type="text" id="codigoPostal" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Colonia</label>
								<input type="text" id="colonia" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Delegación / Municipio</label>
								<input type="text" id="delegacion" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Ciudad</label>
								<input type="text" id="ciudad" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Estado</label>
								<input type="text" id="estado" class="text-input" value="" >
							</div>
							<div>
								<label  class="label">RFC</label>
								<input  type="text" id="rfc" class="text-input" value="" >
							</div>
							<div >
								<label class="label">Método de Pago</label>
								<div class="select">
									<select id="metodoPago" ></select>
								</div>
							</div>
							<div>
								<!--<label class="label"></label>
								<div class="select">
									<select id="field-on_demand_invoicing" >
										<option value="automatic">Facturación automática</option>
										<option value="on_demand">Facturación manual</option>
									</select>
								</div>
								<div class="form-caption form-caption--error"></div>
							</div>
							<div >
								<label class="label">email de cuenta adicional (cc)</label>
								<input type="text" id="field-invoice_cc_mail" class="text-input" value="" >
								<div class="form-caption form-caption--error"></div>
							</div>-->
							<hr >
							<div class="">
								<button class="btn btn-secundary"><!-- react-text: 71 -->Save<!-- /react-text --></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('css')
<style type="text/css">
	element.style {
}
input{width: 100%;height: 3em}
.container{width: 80%;}
.four-fifths{width:80%}
.text-input{
	padding:5px 8px;border:1px solid #e1e1e1;border-radius:3px;box-shadow:inset 0 0 2px 0; rgba(0,0,0,.1);font-size:15px;
}
.label{
	color: rgba(0,0,0,.7);;
	display: block;
	font:inherit;
	font-weight:700;
	font-size:14px;
	text-align: left;
}
</style>
@stop