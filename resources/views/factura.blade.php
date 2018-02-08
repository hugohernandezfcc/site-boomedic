@extends('adminlte::page')
<meta name="viewport" content="width=device-width, initial-scale=1">
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
                <!--<th>Fecha</th>-->
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
                <!--<th>Fecha</th>-->
              </tr>
            </tfoot>
            <tbody >
              @if(count($join)>0)
              @foreach ($join as $key => $citas)
                <tr>
                  <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" onclick="datosmodal('{{$citas->general_amount}}','{{$citas->name}}','{{$citas->email}}','{{$citas->specialty}}','{{$citas->latitude}}','{{$citas->longitude}}','{{$citas->qualification}}','{{$citas->profile_photo}}','{{$citas->postalcode}}','{{$citas->id}}','{{$citas->invoiced}}')">
                      Detalles
                    </button>
                  </td>
                  <td>{{$citas->name}}</td>
                  <td>{{$citas->general_amount}}</td>
                  <td>{{$citas->workplace}}</td>
                  <td>{{$citas->delegation}}</td>
                  <td>PayPal</td>
                  <!--<td>{{$citas->when}}</td>-->
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
                  <!--<td></td>-->
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
        <div class="modal-body box" style="display: inline-block;padding-right: 0px;padding-left: 0px;padding-top: 0px;">
          <div id="alert"></div>
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
            <div style=" width: 45%;display: inline-block;text-align: right;">
              <label class="label1" value="">Nombre :</label>
              <label class="label1" value="">Email :</label>
              <label class="label1" value="">Especialidad :</label>
              <label class="label1">Monto : </label>
              <label class="label1">Calificación:  </label>
            </div>
            <div style=" width: 45%;display: inline-block;text-align: left;">
              <label class="label2" id="nombre"></label>
              <label class="label2" id="email"></label>
              <label class="label2" id="especialidad"></label>
              <label class="label2" id="idlabelMonto"></label>
              <form>
                <scan class="clasificacion label2">
                  <input id="radio1" type="radio" name="estrellas" value=""><!--
                  --><label class="labelEstrellas" for="radio1">★</label><!--
                  --><input id="radio2" type="radio" name="estrellas" value=""><!--
                  --><label class="labelEstrellas" for="radio2">★</label><!--
                  --><input id="radio3" type="radio" name="estrellas" value=""><!--
                  --><label class="labelEstrellas" for="radio3">★</label><!--
                  --><input id="radio4" type="radio" name="estrellas" value=""><!--
                  --><label class="labelEstrellas" for="radio4">★</label><!--
                  --><input id="radio5" type="radio" name="estrellas" value=""><!--
                  --><label class="labelEstrellas" for="radio5">★</label>
                </scan>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-default" onclick="timbrado();">Facturar</button>
            <button type="button" class="btn btn-secondary" onclick="qualification();">Guardar cambios</button>
          </div>

            <div id="carga2">
            </div>
        </div>
      </div>
    </div>
</div>
@stop

@section('css')
  <style type="text/css">
    .th{border-style: none;}
    input[type = "radio"]{ display:none;}
    .labelEstrellas : hover{color:orange;}
    .labelEstrellas : hover ~ label{color:orange;}
    input[type = "radio"]:checked ~ .labelEstrellas{color:orange;}
    .clasificacion{
      direction : rtl;/* right to left */
      unicode-bidi : bidi-override;/* bidi de bidireccional */
    }
    .datos{
      border : 1px;
      display : inline-block;
      width : 30%;
      margin : auto;
      font-size : 14px;
      margin-left : 2em;
    }
    .datosMedico{
      border : 1px;
      display : inline-block;
      width : 60%;
      margin : auto;
      font-size : 14px;
      margin-left : 1em;
      text-overflow: ellipsis;
    }
    .labelEstrellas{
      color : grey;
    }
    .label1{
      text-align : right;
      display : block;
    }
    .label2{
      font-weight : normal;
      text-align : left;
      display : block;
      text-overflow: ellipsis;
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
        "language" : {
          "search" : "Buscar",
            "paginate" : {
              "first" :      "Primero",
              "last" :       "Último",
              "next" :       "Siguiente",
              "previous" :   "Anterior"
          },
        }
      })
    });

    var montoM;
    var codigoPostalM;
    var idappointment;
    var invoiced;
    function datosmodal(monto,nombre,email,especialidad,latitude,longitude,valor5,photo,codigoPostal,id,invo) {
      invoiced = invo;
      $("#alert").empty();
      idappointment = id;
      for (var i = 1; i <= 5; i++) {
        var idcheck = "radio"+i;
        document.getElementById(idcheck).checked = 0;
      }
      montoM = monto;
      codigoPostalM = codigoPostal;
      document.getElementById("idlabelMonto").innerHTML = monto;
      document.getElementById("nombre").innerHTML = nombre;
      document.getElementById("email").innerHTML = email;
      document.getElementById("especialidad").innerHTML = especialidad;
      $("#photo").attr("src",photo);
      $("#map").attr("src", 'https://maps.googleapis.com/maps/api/staticmap?maptype=roadmap&center='+latitude+','+longitude+'&zoom=16&size=600x200&markers=color:black|'+latitude+','+longitude+'&key=AIzaSyDFFuMEwcwH3OpA8go3AVElVcocm6o5WBQ');
      if(valor5 == 1) valor5 = 5;
      else if(valor5 == 2) valor5 = 4;
      else if(valor5 == 3) valor5 = 3;
      else if(valor5 == 4) valor5 = 2;
      else if(valor5 == 5) valor5 = 1;
      for (var i = 1; i <= valor5; i++) {
        var idcheck = "radio"+i;
        document.getElementById(idcheck).checked = 1;
      }
    };

    function qualification(){
      var qualification = 0;
      for (var i = 1; i <= 5; i++) {
        var idcheck = "radio"+i;
        if(document.getElementById(idcheck).checked == 1){
          qualification = i;
          break;
        }
      }
      if(qualification == 1) qualification = 5;
      else if(qualification == 2) qualification = 4;
      else if(qualification == 3) qualification = 3;
      else if(qualification == 4) qualification = 2;
      else if(qualification == 5) qualification = 1;
      var dat = {'qualification' : qualification};
      $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url : "/qualification/"+idappointment,
          type : "get",
          data : dat,
          error: function() {
            console.log('Error :c');
          },
          success : function(response){
            if(response == 'guardado'){
              console.log('Correcto retornaste: '+response);
              location.reload();
            }else{
              document.getElementById("alert").innerHTML = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>'+response+'.</div>';
            }
          }
      });
    };

    function timbrado(){
      if(!invoiced){
        var conceptos = [{'claveProdServ' : '01010101', 'cantidad' : 1, 'claveUnidad' : 'H87', 'tipoUnidad' : 'Pieza', 'descripcion' : 'Consulta en el área de '+document.getElementById("especialidad").innerHTML, 'valorUnitario' : montoM, 'importe' : montoM}];
        var dat = {'nombreEmisor' : 'EMISOR PRUEBA SA DE CV', 'rfcEmisor' : 'LAN7008173R5', 'regimenFiscal' : '601', 'subtotal' : document.getElementById("idlabelMonto").innerHTML, 'total' : montoM, 'lugarExpedicion' : codigoPostalM, 'formaPago' : '03', 'condicionesPago' : 'CONTADO', 'metodoPago' : 'PUE', 'conceptos' : conceptos, 'moneda' : 'MXN', 'idAppointment' : idappointment};

        document.getElementById("carga2").className = "overlay";
        document.getElementById("carga2").innerHTML = "<i class='fa fa-refresh fa-spin' id='imgCarga'></i>";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/timbrado",
            type : "get",
            data : dat,
            error: function() {
                $('#carga2').removeClass();
                $('#imgCarga').remove();
                console.log('Error :c');
                document.getElementById("alert").innerHTML = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>Ha ocurrido un error al facturar.</div>';
            },
            success : function(response){
                $('#carga2').removeClass();
                $('#imgCarga').remove();
                if(response != null && response != 'no tiene perfil tributario'){
                  document.getElementById("alert").innerHTML = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Factura Realizada!</h4>Se ha enviado un XML y PDF a su correo.</div>';
                  console.log("Correcto Response: " + response);
                  setTimeout("location.reload();", 1000);
                }else{
                    if(response == 'no tiene perfil tributario'){
                      document.getElementById("alert").innerHTML = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>No tiene perfil tributario.</div>';
                    }else{
                      document.getElementById("alert").innerHTML = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>Ha ocurrido un error al facturar.</div>';
                  }
                }
            }
        });
      
      }else{
        document.getElementById("alert").innerHTML = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Error!</h4>La cita ya ha sido facturada</div>';
      }
    }
  </script>
@stop