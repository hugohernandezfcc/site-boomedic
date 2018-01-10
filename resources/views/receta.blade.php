@extends('adminlte::master')
<style type="text/css">
    body{background-image: url('img/fondo-03.jpg');background-size: 100%}
</style>
@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    
    @yield('css')
@stop
<meta name="viewport" content="width=device-width, initial-scale=1">
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../" style="color: white;font-weight:200;letter-spacing:1px;font-size: 20px;">Boomedic</a>
    </div>
</nav>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('body')

    <div class="login-box">
        <!--<div class="box">-->

        <!-- /.login-logo -->
        <div class="box box-body login-box-body" style="">
            <p class="login-box-msg">Folio receta médica</p>
            <div class="form-group has-feedback" style="">
                <input name="folio" type="text" id="folio" class="form-control"  placeholder="Folio" oninput="buscar();" autocomplete="off" >
                <span class="glyphicon fa fa-list-alt form-control-feedback"></span>
            </div>
            <div id="menjError" style="color: #f56954"></div>
            <div class="modal-footer" >
            </div>
          <!-- /.box -->
            <div id="carga" class="box" style="border:none; width: 100%">
                <div id="carga2">
                </div>
            </div>
        </div>
    </div><!-- /.login-box -->



    <div class="modal fade" id="modal-default">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Receta médica</h4>
                </div>
                <div class="modal-body" style="display: inline-block;width: 100%">
                    <div style="width: 20%;text-align: right;display: inline-block;">
                        <label class="" style="display: block;">Médico :</label>
                        <label class="" style="display: block;">Paciente :</label>
                        <label class="" style="display: inline-block;">Fecha cita :</label>
                    </div>
                    <div style="width: 45%;text-align: left;display: inline-block;margin-left: 1em;">
                        <label class="" style="display: block;font-weight: normal;" id="doctor"></label>
                        <label class="" style="display: block;font-weight: normal;" id="patient"></label>
                        <label class="" style="display: inline-block;font-weight: normal;" id="date"></label>
                    </div>
                    <br><br>
                    <center>
                        <table id="example" class="table table-bordered table-hove" style="width: 90%">
                            <thead>
                                <tr>
                                    <th style="border-style: none;"></th>
                                    <th style="border-style: none;">Nombre</th>
                                    <th style="border-style: none;">Descripción</th>
                                    <th style="border-style: none;">Código</th>
                                </tr>
                            </thead>
          
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                    </center>
                </div>
                    <div class="modal-footer" >
                        <button type="button" class="btn btn-secondary" onclick="completado();">Receta Completa</button>
                    </div>
                    </center>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
        <!-- /.modal -->
        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style type="text/css">
    </style>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        var length;
        $(document).ready(function() {
            $('#myTable').DataTable( {
                "ordering": false,
                "info":     false,
                "dom": 'lrtip',
                "paginate": false
            } );

        } );
        function cerrar() {
                $('#modal-default').modal('hide');
            };
        function completado() {
            for(var i=0;i<length;i++){
                document.getElementById(i).checked=true;
            }
            document.getElementById("folio").value=null;
            setTimeout("$('#modal-default').modal('hide');", 1000);
        };
        
        function buscar() {
            var folio = document.getElementById("folio").value;
            var log=folio.length;
            var hora=parseInt(folio.substring(0,2));
            var dia=parseInt(folio.substring(2,4));
            if(log>=7){
                if(hora<25 && dia<32){
                    document.getElementById("carga2").className="overlay";
                    document.getElementById("carga2").innerHTML="<i class='fa fa-refresh fa-spin' id='imgCarga'></i>";
                    $.ajax({
                        url : "/medicines/"+folio,
                        type : "get",
                        error: function() {
                            $('#carga2').removeClass();
                            $('#imgCarga').remove();
                        },
                        success : function(response){
                            $('#carga2').removeClass();
                            $('#imgCarga').remove();
                            var doctor=response['doctor'];
                            var patient=response['patient'];
                            var recipe=response['recipe'];
                            var medicines=response['medicines'];
                            console.log(doctor);
                            console.log(patient);
                            console.log(recipe);
                            console.log(medicines);
                            document.getElementById("doctor").innerHTML = doctor[0]['name'];
                            document.getElementById("patient").innerHTML = patient[0]['name'];
                            document.getElementById("date").innerHTML = recipe[0]['date'];
                            $('#tableBody').empty();
                            length=medicines.length;
                            for(var i=0;i<medicines.length;i++){
                                var fila="<td><div class='checkbox' id=''><label><input id='"+i+"' type='checkbox'></label></div></td> <td>"+medicines[i]['name']+"</td><td>"+medicines[i]['description']+"</td><td>"+medicines[i]['code']+"</td>";
                                var btn = document.createElement("TR");
                                btn.innerHTML=fila;
                                document.getElementById("tableBody").appendChild(btn);
                            }
                            $('#modal-default').modal('show');
                        }
                    });
                }
            }else{
                if((hora>24 || dia>31) && folio.length>=4){
                    $("#menjError").html('<b>Error:</b> Folio inexistente');
                }
                if(folio.length<4){
                    $("#menjError").html('');
                }
            }
        }  
    </script>
    @yield('js')
@stop


