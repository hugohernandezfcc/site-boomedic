@extends('adminlte::page')

@section('title', 'Boomedic')


@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3>Consultas</h3>
    </div>
    <div class="box-body">
    <center>
      <div style="width: 90%">
        <table id="example" class="table table-bordered table-hove" width="100%">
          <thead>
            <tr>
                <th>Detalles</th>
                <th>Médico</th>
                <th>Tarifa</th>
                <th>Consultorio</th>
                <th>Delegación</th>
                <th>Método de pago</th>
            </tr>
          </thead>
            <tfoot> 
              <tr>
                <th>Detalles</th>
                <th>Médico</th>
                <th>Tarifa</th>
                <th>Consultorio</th>
                <th>Delegación</th>
                <th>Método de pago</th>
              </tr>
            </tfoot>
            <tbody >
              @if(count($join)>0)
              @foreach ($join as $key => $citas)
                <tr>
                    <td>
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" onclick="datosmodal('5.0','{{$citas->name}}','{{$citas->email}}','{{$citas->specialty}}','{{$citas->latitude}}','{{$citas->longitude}}','3','{{$citas->profile_photo}}')">
                        Detalles
                      </button>
                    </td>
                    <td>{{$citas->name}}</td>
                    <td>1.0</td>
                    <td>{{$citas->workplace}}</td>
                    <td>{{$citas->delegation}}</td>
                    <td>PayPal</td>
                </tr>
              @endforeach
              @else
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </center>
    </div>
  </div>


  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalles de consulta</h4>
              </div>
              <div class="modal-body" style="display: inline-block;padding-right: 0px;padding-left: 0px;padding-top: 0px;">
                <center>
                  <img id="map" style="width: 100%;" />
                </center>
                <br>
                <div class="datos" style="vertical-align: top;">
                  <center>
                    <img id="photo" style="width: 70%;vertical-align: top;">
                  </center>
                </div>
                <div class="datosMedico">
                  <div style=" width: 30%;display: inline-block;text-align: right;">
                    <label class="label1" value="">Nombre :</label>
                    <label class="label1" value="">Email :</label>
                    <label class="label1" value="">Especialidad :</label>
                    <label class="label1">Monto : </label>
                    <label class="label1">Calificación:  </label>
                  </div>
                  <div style=" width: 60%;display: inline-block;text-align: left;">
                    <label class="label2" id="nombre"></label>
                    <label class="label2" id="email"></label>
                    <label class="label2" id="especialidad"></label>
                    <label class="label2" id="idlabelMonto"></label>
                    <form>
                        <scan class="clasificacion label2">
                          <input id="radio1" type="radio" name="estrellas" value="5"><!--
                          --><label class="labelEstrellas" for="radio1">★</label><!--
                          --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                          --><label class="labelEstrellas" for="radio2">★</label><!--
                          --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                          --><label class="labelEstrellas" for="radio3">★</label><!--
                          --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                          --><label class="labelEstrellas" for="radio4">★</label><!--
                          --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                          --><label class="labelEstrellas" for="radio5">★</label>
                        </scan>
                      </form>
                  </div>
                </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary">Guardar cambios</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
@stop

@section('css')
  <style type="text/css">
    .th{border-style: none;}
    input[type = "radio"]{ display:none;}
    .labelEstrellas:hover{color:orange;}
    .labelEstrellas:hover ~ label{color:orange;}
    input[type = "radio"]:checked ~ .labelEstrellas{color:orange;}
    .clasificacion{
      direction: rtl;/* right to left */
      unicode-bidi: bidi-override;/* bidi de bidireccional */
    }
    .datos{
      border: 1px;
      display: inline-block;
      width: 30%;
      margin: auto;
      font-size: 14px;
      margin-left: 2em;
    }
    .datosMedico{
      border: 1px;
      display: inline-block;
      width: 60%;
      margin: auto;
      font-size: 14px;
      margin-left: 1em;
    }
    .labelEstrellas{
      color:grey;
    }
    .label1{
      text-align: right;
      display: block;
    }
    .label2{
      font-weight: normal;
      text-align: left;
      display: block;
    }
  </style>
@stop

@section('js')
  
  <script>
    $(function () {
      $('#example').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'ordering'    : true,
        'autoWidth'   : false,
        'info'    : false,
        "language": {
          "search": "Buscar",
            "paginate": {
              "first":      "Primero",
              "last":       "Último",
              "next":       "Siguiente",
              "previous":   "Anterior"
          },
        }
      })
    });

    function datosmodal(monto,nombre,email,especialidad,latitude,longitude,valor5,photo) {
      document.getElementById("idlabelMonto").innerHTML=monto;
      document.getElementById("nombre").innerHTML=nombre;
      document.getElementById("email").innerHTML=email;
      document.getElementById("especialidad").innerHTML=especialidad;
      $("#photo").attr("src",photo);
      $("#map").attr("src", 'https://maps.googleapis.com/maps/api/staticmap?maptype=roadmap&center='+latitude+','+longitude+'&zoom=16&size=600x200&markers=color:black|'+latitude+','+longitude+'&key=AIzaSyDFFuMEwcwH3OpA8go3AVElVcocm6o5WBQ');

      if(valor5=='5'){
      document.getElementById("radio1").checked=1;
      document.getElementById("radio2").checked=1;
      document.getElementById("radio3").checked=1;
      document.getElementById("radio4").checked=1;
      document.getElementById("radio5").checked=1;
    }else if(valor5=='4'){
      document.getElementById("radio1").checked=1;
      document.getElementById("radio2").checked=1;
      document.getElementById("radio3").checked=1;
      document.getElementById("radio4").checked=1;
    }else if(valor5=='3'){
      document.getElementById("radio1").checked=1;
      document.getElementById("radio2").checked=1;
      document.getElementById("radio3").checked=1;
    }else if(valor5=='2'){
      document.getElementById("radio1").checked=1;
      document.getElementById("radio2").checked=1;
    }else if(valor5=='1'){
      document.getElementById("radio1").checked=1;
    }
    }
  </script>
@stop